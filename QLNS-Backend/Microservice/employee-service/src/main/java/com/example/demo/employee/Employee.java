package com.example.demo.employee;

import jakarta.persistence.Entity;
import jakarta.persistence.GeneratedValue;
import jakarta.persistence.GenerationType;
import jakarta.persistence.Id;
import jakarta.persistence.Column;
import jakarta.persistence.Table;

@Table(name = "employees")
@Entity
public class Employee {
	
	@Id
    @Column(name = "employee_id")
    private String employee_id;

    @Column(name = "name")
    private String name;
    @Column(name = "username")
    private String username;
    
    @Column(name = "password")
    private String password;
    
    @Column(name = "dob")
    private String dob;

    @Column(name = "address")
    private String address;

    @Column(name = "phone_number")
    private String phone_number;
    
    @Column(name = "role")
    private String role;

    
    public String getId() {
        return employee_id;
    }

    public void setId(String id) {
        this.employee_id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDob() {
        return dob;
    }

    public void setDob(String dob) {
        this.dob = dob;
    }

    public String getAddress() {
        return address;
    }

    public void setAddress(String address) {
        this.address = address;
    }

    public String getphone_number() {
        return phone_number;
    }

    public void setphone_number(String phone_number) {
        this.phone_number = phone_number;
    }
    
    public String getUsername() {
        return username;
    }

    public void setUsername(String username) {
        this.username = username;
    }

    public String getPassword() {
        return password;
    }

    public void setPassword(String password) {
        this.password = password;
    }
    public String getRole() {
        return role;
    }

    public void setRole(String type) {
        this.role = type;
    }
}
