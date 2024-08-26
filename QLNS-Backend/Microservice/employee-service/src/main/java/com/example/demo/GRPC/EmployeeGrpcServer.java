package com.example.demo.GRPC;

import io.grpc.Server;
import io.grpc.ServerBuilder;
import io.grpc.stub.StreamObserver;

import java.io.IOException;
import java.util.Optional;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;

import com.example.demo.GRPC.EmployeeProto.Employee;
import com.example.demo.GRPC.EmployeeProto.EmployeeRequest;
import com.example.demo.GRPC.EmployeeProto.EmployeeResponse;
import com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest;
import com.example.demo.employee.EmployeeService;
import com.example.demo.employee.config.ConnectionInterceptor;
import org.springframework.context.annotation.Bean;
import org.springframework.boot.CommandLineRunner;
import org.springframework.context.annotation.Configuration;

@Configuration
public class EmployeeGrpcServer {

    private final EmployeeService employeeService;

    @Autowired
    public EmployeeGrpcServer(EmployeeService employeeService) {
        this.employeeService = employeeService;
    }

    @Bean
    public Server grpcServer() {
        return ServerBuilder.forPort(9091)
                .addService(new EmployeeServiceImpl(employeeService))
                .intercept(new ConnectionInterceptor())
                .build();
    }

    @Bean
    public CommandLineRunner startServer(Server grpcServer) {
        return args -> {
            grpcServer.start();
            System.out.println("Server started on port " + 9091);
            Runtime.getRuntime().addShutdownHook(new Thread(() -> {
                System.err.println("Shutting down gRPC server since JVM is shutting down");
                grpcServer.shutdown();
                System.err.println("Server shut down");
            }));
        };
    }
}