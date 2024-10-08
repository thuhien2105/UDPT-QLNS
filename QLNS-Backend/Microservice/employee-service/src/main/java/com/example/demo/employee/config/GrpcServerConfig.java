//package com.example.demo.employee.config;
//
//import org.springframework.beans.factory.annotation.Autowired;
//import org.springframework.context.annotation.Bean;
//import org.springframework.context.annotation.Configuration;
//
//import com.example.demo.GRPC.EmployeeServiceImpl;
//import com.example.demo.employee.config.ConnectionInterceptor;
//import io.grpc.Server;
//import io.grpc.ServerBuilder;
//import com.example.demo.employee.EmployeeService;
//
//@Configuration
//public class GrpcServerConfig {
//
//    @Autowired
//    private EmployeeService employeeService;
//
//    @Bean
//    public Server grpcServer() {
//        return ServerBuilder.forPort(9090)
//                .addService(new EmployeeServiceImpl(employeeService))
//                .intercept(new ConnectionInterceptor()) 
//
//                .build();
//    }
//}
