package com.example.demo.employee;


import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.employee.config.JwtUtil;
import com.example.demo.employee.config.LoginResponse;

import java.awt.print.Pageable;
import java.util.List;
import java.util.Optional;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;


@Service
public class EmployeeService {

    @Autowired
    private EmployeeRepository employeeRepository;



    @Autowired
    private PasswordEncoder passwordEncoder;
    
    @Autowired
    private JwtUtil jwtUtil;
    


    public Optional<LoginResponse> login(String username, String password) {
        System.out.println("Username: " + username + ", Password: " + password);
        Optional<Employee> employeeOpt = employeeRepository.findByUsername(username);
        if (employeeOpt.isPresent()) {
            Employee employee = employeeOpt.get();
            if (password.equals(employee.getPassword())) {
            	 String token = jwtUtil.generateToken(employee.getEmployeeId(), employee.getRole());
                 LoginResponse loginResponse = new LoginResponse(employee, token);
                 return Optional.of(loginResponse);
            }
        }
        return Optional.empty();
    }


    public void logout(String username) {

    }
    
    
    
    public List<Employee> getAllEmployees(String keyword, int page) {
        PageRequest pageable = PageRequest.of(page - 1, 20); 

        Page<Employee> employeePage;
        if (keyword == null || keyword.trim().isEmpty()) {
            employeePage = employeeRepository.findAll(pageable);
        } else {
            employeePage = employeeRepository.findByNameContainingIgnoreCase(keyword, pageable);
        }

        return employeePage.getContent(); 
    }



    
    public Optional<Employee> getEmployeeById(String id) {
        return employeeRepository.findById(id);
    }

    public Employee createEmployee(Employee employee) {
        return employeeRepository.save(employee);
    }

    public Employee updateEmployee(Employee employee) {
        if (employee.getEmployeeId() == null || !employeeRepository.existsById(employee.getEmployeeId())) {
            throw new IllegalArgumentException("Employee with ID " + employee.getEmployeeId() + " does not exist.");
        }

        return employeeRepository.save(employee);
    }


    public boolean deleteEmployee(String id) {
        if (employeeRepository.existsById(id)) {
            employeeRepository.deleteById(id);
            return true;
        }
        return false;
    }
    public boolean existsById(String id) {
        return employeeRepository.existsById(id);
    }
}

