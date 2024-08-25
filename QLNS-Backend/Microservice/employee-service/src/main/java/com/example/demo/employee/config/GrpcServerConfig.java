//package com.example.demo.employee.config;
//
//import org.springframework.beans.factory.annotation.Autowired;
//import org.springframework.context.annotation.Bean;
//import org.springframework.context.annotation.Configuration;
//
//import com.example.demo.GRPC.EmployeeServiceImpl;
//
//import io.grpc.Server;
//import io.grpc.ServerBuilder;
//
//@Configuration
//public class GrpcServerConfig {
//
//    @Autowired
//    private EmployeeServiceImpl employeeService;
//
//    @Bean
//    public Server grpcServer() {
//        return ServerBuilder.forPort(9090)
//                .addService(employeeService)
//                .build();
//    }
//}
