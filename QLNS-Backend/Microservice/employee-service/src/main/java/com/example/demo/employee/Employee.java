package com.example.demo.employee;

import jakarta.persistence.Entity;
import jakarta.persistence.Column;
import jakarta.persistence.Id;
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

    @Column(name = "email")
    private String email;

    @Column(name = "position")
    private String position;

    @Column(name = "tax_code")
    private String tax_code;

    @Column(name = "bank_account")
    private String bank_account;

    @Column(name = "identity_card")
    private String identity_card;

    @Column(name = "created_at")
    private java.sql.Timestamp created_at;

    @Column(name = "role")
    private String role;

    public String getEmployeeId() {
        return employee_id;
    }

    public void setEmployeeId(String employee_id) {
        this.employee_id = employee_id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
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

    public String getPhoneNumber() {
        return phone_number;
    }

    public void setPhoneNumber(String phone_number) {
        this.phone_number = phone_number;
    }

    public String getEmail() {
        return email;
    }

    public void setEmail(String email) {
        this.email = email;
    }

    public String getPosition() {
        return position;
    }

    public void setPosition(String position) {
        this.position = position;
    }

    public String getTaxCode() {
        return tax_code;
    }

    public void setTaxCode(String tax_code) {
        this.tax_code = tax_code;
    }

    public String getBankAccount() {
        return bank_account;
    }

    public void setBankAccount(String bank_account) {
        this.bank_account = bank_account;
    }

    public String getIdentityCard() {
        return identity_card;
    }

    public void setIdentityCard(String identity_card) {
        this.identity_card = identity_card;
    }

    public java.sql.Timestamp getCreatedAt() {
        return created_at;
    }

    public void setCreatedAt(java.sql.Timestamp created_at) {
        this.created_at = created_at;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }
}
