package com.example.demo.GRPC;


import com.example.demo.GRPC.EmployeeGrpcClient;
import com.example.demo.GRPC.EmployeeProto.Employee;
import io.grpc.ManagedChannel;
import io.grpc.ManagedChannelBuilder;

public class RequestService {

    private final EmployeeGrpcClient employeeGrpcClient;

    public RequestService() {
        ManagedChannel channel = ManagedChannelBuilder.forAddress("localhost", 9090)
                .usePlaintext()
                .build();
        this.employeeGrpcClient = new EmployeeGrpcClient(channel);
    }

    public void printEmployeeDetails(long employeeId) {
        Employee employee = employeeGrpcClient.getEmployeeById(employeeId);
        System.out.println("Employee Details: ");
        System.out.println("ID: " + employee.getId());
        System.out.println("Name: " + employee.getName());
        System.out.println("Date of Birth: " + employee.getDob());
        System.out.println("Address: " + employee.getAddress());
        System.out.println("Phone Number: " + employee.getPhoneNumber());
    }
}
