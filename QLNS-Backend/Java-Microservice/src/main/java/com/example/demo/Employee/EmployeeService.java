package com.example.demo.Employee;


import com.example.demo.Employee.Employee;
import com.example.demo.Employee.EmployeeRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class EmployeeService {

    @Autowired
    private EmployeeRepository employeeRepository;

    public List<Employee> getAllEmployees() {
        return employeeRepository.findAll();
    }

    public Optional<Employee> getEmployeeById(Long id) {
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


    public boolean deleteEmployee(Long id) {
        if (employeeRepository.existsById(id)) {
            employeeRepository.deleteById(id);
            return true;
        }
        return false;
    }
    public boolean existsById(Long id) {
        return employeeRepository.existsById(id);
    }
}

