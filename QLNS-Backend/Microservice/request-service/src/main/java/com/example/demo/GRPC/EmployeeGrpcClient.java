package com.example.demo.GRPC;

import io.grpc.ManagedChannel;
import io.grpc.ManagedChannelBuilder;
import io.grpc.StatusRuntimeException;
import org.slf4j.Logger;
import org.slf4j.LoggerFactory;
import com.example.demo.GRPC.EmployeeProto.Employee;
import com.example.demo.GRPC.EmployeeProto.EmployeeRequest;
import com.example.demo.GRPC.EmployeeProto.EmployeeResponse;
import com.example.demo.GRPC.EmployeeServiceGrpc;

public class EmployeeGrpcClient {

    private static final String HOST = "localhost";
    private static final int PORT = 9091;

    public EmployeeResponse getEmployeeById(String employeeId) {
        ManagedChannel channel = ManagedChannelBuilder.forAddress(HOST, PORT)
                .usePlaintext()  
                .build();
        
        EmployeeServiceGrpc.EmployeeServiceBlockingStub blockingStub = EmployeeServiceGrpc.newBlockingStub(channel);

        EmployeeRequest request = EmployeeRequest.newBuilder().setEmployeeId(employeeId).build();
        
        EmployeeResponse response = null;
        
        try {
            response = blockingStub.getEmployeeById(request);
        
        } catch (Exception e) {
            e.printStackTrace();
        } finally {
            channel.shutdown();
        }

        return response ;
    }
}
