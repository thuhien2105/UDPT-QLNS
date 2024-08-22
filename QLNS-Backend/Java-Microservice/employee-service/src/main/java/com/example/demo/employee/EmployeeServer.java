//package com.example.demo.employee;
//
//import io.grpc.Server;
//import io.grpc.ServerBuilder;
//
//public class EmployeeServer {
//    public static void main(String[] args) throws Exception {
//        Server server = ServerBuilder.forPort(50051)
//                .addService(new EmployeeServiceImpl())
//                .build()
//                .start();
//        System.out.println("Employee service started on port 50051");
//        server.awaitTermination();
//    }
//}
