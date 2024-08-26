package com.example.demo.GRPC;

import com.example.demo.GRPC.EmployeeProto.Employee;
import com.example.demo.GRPC.EmployeeProto.EmployeeRequest;
import com.example.demo.GRPC.EmployeeServiceGrpc.EmployeeServiceBlockingStub;
import io.grpc.ManagedChannel;

public class RequestService {

    private final EmployeeGrpcClient employeeGrpcClient;

    public RequestService(EmployeeGrpcClient employeeGrpcClient) {
        this.employeeGrpcClient = employeeGrpcClient;
    }
//
//    public void printEmployeeDetails(String employeeId) {
//        Employee employee = employeeGrpcClient.getEmployeeById(employeeId); 
//        System.out.println("Employee Details: ");
//        System.out.println("ID: " + employee.getEmployeeId());
//        System.out.println("Name: " + employee.getName());
//        System.out.println("Date of Birth: " + employee.getDob());
//        System.out.println("Address: " + employee.getAddress());
//        System.out.println("Phone Number: " + employee.getPhoneNumber());
//    }
}
