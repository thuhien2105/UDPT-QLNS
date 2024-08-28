package com.example.demo.employee.config;

import com.example.demo.employee.Employee;

public class LoginResponse {
    private Employee employee;
    private String accessToken;
    private String refreshToken;

    public LoginResponse(Employee employee, String accessToken, String refreshToken) {
        this.employee = employee;
        this.accessToken = accessToken;
        this.refreshToken = refreshToken;
    }

    public Employee getEmployee() {
        return employee;
    }

    public void setEmployee(Employee employee) {
        this.employee = employee;
    }

    public String getAccessToken() {
        return accessToken;
    }

    public void setAccessToken(String accessToken) {
        this.accessToken = accessToken;
    }

    public String getRefreshToken() {
        return refreshToken;
    }

    public void setRefreshToken(String refreshToken) {
        this.refreshToken = refreshToken;
    }
}
