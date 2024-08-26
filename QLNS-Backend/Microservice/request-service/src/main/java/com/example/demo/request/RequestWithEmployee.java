package com.example.demo.request;

import com.example.demo.GRPC.EmployeeProto.Employee;
import com.fasterxml.jackson.annotation.JsonIdentityInfo;
import com.fasterxml.jackson.annotation.ObjectIdGenerators;
import com.fasterxml.jackson.annotation.JsonManagedReference;
import com.fasterxml.jackson.annotation.JsonBackReference;

import com.example.demo.GRPC.EmployeeProto.Employee;
import com.fasterxml.jackson.annotation.JsonIgnore;
import com.example.demo.GRPC.EmployeeProto.EmployeeResponse;

public class RequestWithEmployee {

    private int id; 
    private RequestEntity request;

    private EmployeeResponse employee;

    public RequestWithEmployee() {
    }

    public RequestWithEmployee( int id, RequestEntity request, EmployeeResponse employee) {
        this.id = id;
        this.request= request;
        this.employee = employee;
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public RequestEntity getRequest() {
        return request;
    }

    public void setRequest(RequestEntity request) {
        this.request = request;
    }


    public EmployeeResponse getEmployee() {
        return employee;
    }

    public void setEmployee(EmployeeResponse employee) {
        this.employee = employee;
    }
}
