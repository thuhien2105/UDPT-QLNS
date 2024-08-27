package com.example.demo.employee;


import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.employee.config.JwtUtil;
import com.example.demo.employee.config.LoginResponse;

import java.util.List;
import java.util.Optional;
import org.springframework.security.crypto.password.PasswordEncoder;

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
            	 String token = jwtUtil.generateToken(employee.getId(), employee.getRole());
                 LoginResponse loginResponse = new LoginResponse(employee, token);
                 return Optional.of(loginResponse);
            }
        }
        return Optional.empty();
    }


    public void logout(String username) {

    }
    
    
    
    public List<Employee> getAllEmployees() {
        return employeeRepository.findAll();
    }

    public Optional<Employee> getEmployeeById(String id) {
        return employeeRepository.findById(id);
    }

    public Employee createEmployee(Employee employee) {
        return employeeRepository.save(employee);
    }

    public Employee updateEmployee(Employee employee) {
        if (employee.getId() == null || !employeeRepository.existsById(employee.getId())) {
            throw new IllegalArgumentException("Employee with ID " + employee.getId() + " does not exist.");
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

