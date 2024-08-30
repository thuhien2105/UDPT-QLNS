package com.example.demo.employee.config;

import com.example.demo.employee.EmployeeDTO;

public class LoginResponse {
    private EmployeeDTO employee;
    private String token;

    public LoginResponse(EmployeeDTO employee, String token) {
        this.employee = employee;
        this.token = token;
    }

    public EmployeeDTO getEmployee() {
        return employee;
    }

    public void setEmployee(EmployeeDTO employee) {
        this.employee = employee;
    }

    public String getToken() {
        return token;
    }

    public void setToken(String token) {
        this.token = token;
    }
}
