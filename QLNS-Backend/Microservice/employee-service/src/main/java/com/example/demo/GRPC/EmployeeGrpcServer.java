//package com.example.demo.GRPC;
//
//import io.grpc.Server;
//import io.grpc.ServerBuilder;
//import io.grpc.stub.StreamObserver;
//
//import java.io.IOException;
//
//import com.example.demo.GRPC.EmployeeProto.Employee;
//import com.example.demo.GRPC.EmployeeProto.EmployeeRequest;
//import com.example.demo.GRPC.EmployeeProto.EmployeeResponse;
//import com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest;
//
//public class EmployeeGrpcServer {
//
//    private final Server server;
//
//    public EmployeeGrpcServer() {
//        this.server = ServerBuilder.forPort(9090) 
//                .addService(new EmployeeServiceImpl())
//                .build();
//    }
//
//    public void start() throws IOException {
//        server.start();
//        System.out.println("Server started on port " + 9090);
//        Runtime.getRuntime().addShutdownHook(new Thread(() -> {
//            System.err.println("Shutting down gRPC server since JVM is shutting down");
//            EmployeeGrpcServer.this.stop();
//            System.err.println("Server shut down");
//        }));
//    }
//
//    public void stop() {
//        if (server != null) {
//            server.shutdown();
//        }
//    }
//
//    public static void main(String[] args) throws IOException, InterruptedException {
//        final EmployeeGrpcServer server = new EmployeeGrpcServer();
//        server.start();
//        server.blockUntilShutdown();
//    }
//
//    private void blockUntilShutdown() throws InterruptedException {
//        if (server != null) {
//            server.awaitTermination();
//        }
//    }
//
//    static class EmployeeServiceImpl extends EmployeeServiceGrpc.EmployeeServiceImplBase {
//        @Override
//        public void getEmployeeById(EmployeeRequest request, StreamObserver<EmployeeResponse> responseObserver) {
//            EmployeeResponse response = EmployeeResponse.newBuilder()
//                    .setEmployee(Employee.newBuilder()
//                            .setId(Long.toString(request.getId()))
//                            .setName("John Doe")
//                            .setDob("1990-01-01")
//                            .setAddress("123 Main St")
//                            .setPhoneNumber("123-456-7890")
//                            .build())
//                    .build();
//            responseObserver.onNext(response);
//            responseObserver.onCompleted();
//        }
//
//
//    }
//}
