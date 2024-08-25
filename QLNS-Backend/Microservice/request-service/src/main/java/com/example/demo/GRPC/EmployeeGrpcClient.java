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

    private static final Logger logger = LoggerFactory.getLogger(EmployeeGrpcClient.class);
    private final EmployeeServiceGrpc.EmployeeServiceBlockingStub blockingStub;

    public EmployeeGrpcClient(ManagedChannel channel) {
        this.blockingStub = EmployeeServiceGrpc.newBlockingStub(channel);
    }
    public Employee getEmployeeById(int id) {
        EmployeeRequest request = EmployeeRequest.newBuilder().setEmployeeId(id).build();
        try {
            EmployeeResponse response = blockingStub.getEmployeeById(request);
            return response.getEmployee();
        } catch (StatusRuntimeException e) {
            logger.error("gRPC error fetching employee with ID {}: Status: {}, Message: {}", id, e.getStatus().getCode(), e.getMessage());
            throw new RuntimeException("Error fetching employee", e);
        } catch (Exception e) {
            logger.error("Unexpected error fetching employee with ID {}: {}", id, e.getMessage());
            throw new RuntimeException("Unexpected error fetching employee", e);
        }
    }
}
