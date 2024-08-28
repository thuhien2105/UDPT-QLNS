package com.example.demo.employee;

public class EmployeeDTO {
    private String employee_id;
    private String name;
    private String dob;
    private String address;
    private String email;
    private String position;
    private String phone_number;
    private String tax_code;
    private String bank_account;
    private String identity_card;
    private String role;

    public String getEmployeeId() {
        return employee_id;
    }

    public void setEmployeeId(String employeeId) {
        this.employee_id = employeeId;
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

    public String getPhoneNumber() {
        return phone_number;
    }

    public void setPhoneNumber(String phoneNumber) {
        this.phone_number = phoneNumber;
    }

    public String getTaxCode() {
        return tax_code;
    }

    public void setTaxCode(String taxCode) {
        this.tax_code = taxCode;
    }

    public String getBankAccount() {
        return bank_account;
    }

    public void setBankAccount(String bankAccount) {
        this.bank_account = bankAccount;
    }

    public String getIdentityCard() {
        return identity_card;
    }

    public void setIdentityCard(String identityCard) {
        this.identity_card = identityCard;
    }

    public String getRole() {
        return role;
    }

    public void setRole(String role) {
        this.role = role;
    }
}
