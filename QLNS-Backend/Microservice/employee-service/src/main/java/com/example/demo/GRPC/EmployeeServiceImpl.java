//package com.example.demo.GRPC;
//
//import org.springframework.stereotype.Service;
//import com.example.demo.GRPC.EmployeeProto.EmployeeResponse;
//import com.example.demo.GRPC.EmployeeProto.EmployeeRequest;
//import com.example.demo.GRPC.EmployeeServiceGrpc;
//import com.example.demo.GRPC.EmployeeProto.Employee; 
//import io.grpc.stub.StreamObserver;
//
//@Service
//public class EmployeeServiceImpl extends EmployeeServiceGrpc.EmployeeServiceImplBase {
//
//    @Override
//    public void getEmployeeById(EmployeeRequest request, StreamObserver<EmployeeResponse> responseObserver) {
//        Employee employee = Employee.newBuilder()
//            .setId(Long.toString(request.getId()))
//            .setName("John Doe")
//            .build();
//        EmployeeResponse response = EmployeeResponse.newBuilder()
//            .setEmployee(employee)
//            .build();
//        responseObserver.onNext(response);
//        responseObserver.onCompleted();
//    }
//
////    @Override
////    public void updateEmployee(UpdateEmployeeRequest request, StreamObserver<EmployeeResponse> responseObserver) {
////        EmployeeResponse response = EmployeeResponse.newBuilder()
////            .setEmployee(request.getEmployee())
////            .build();
////        responseObserver.onNext(response);
////        responseObserver.onCompleted();
////    }
//}
