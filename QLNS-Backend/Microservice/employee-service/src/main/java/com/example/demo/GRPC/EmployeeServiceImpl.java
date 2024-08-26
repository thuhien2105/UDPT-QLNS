package com.example.demo.GRPC;

import io.grpc.stub.StreamObserver;
import java.util.Optional;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import com.example.demo.GRPC.EmployeeProto.Employee;
import com.example.demo.GRPC.EmployeeProto.EmployeeRequest;
import com.example.demo.GRPC.EmployeeProto.EmployeeResponse;
import com.example.demo.employee.EmployeeService;

@Service
public class EmployeeServiceImpl extends EmployeeServiceGrpc.EmployeeServiceImplBase {
    
    private final EmployeeService employeeService;

    @Autowired
    public EmployeeServiceImpl(EmployeeService employeeService) {
        this.employeeService = employeeService;
    }

    @Override
    public void getEmployeeById(EmployeeRequest request, StreamObserver<EmployeeResponse> responseObserver) {
        String id = request.getEmployeeId();
        Optional<com.example.demo.employee.Employee> employee = employeeService.getEmployeeById(id);

        EmployeeResponse.Builder responseBuilder = EmployeeResponse.newBuilder();
        
        if (employee.isPresent()) {
            com.example.demo.GRPC.EmployeeProto.Employee empProto = com.example.demo.GRPC.EmployeeProto.Employee.newBuilder()
                .setEmployeeId(employee.get().getId())
                .setName(employee.get().getName())
                .build();
            
            responseBuilder.setEmployee(empProto);
        } else {
        }

        responseObserver.onNext(responseBuilder.build());
        responseObserver.onCompleted();
    }
}
