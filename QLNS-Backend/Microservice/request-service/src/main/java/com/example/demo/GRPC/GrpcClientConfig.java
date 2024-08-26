package com.example.demo.GRPC;

import com.example.demo.GRPC.EmployeeGrpcClient;
import io.grpc.ManagedChannel;
import io.grpc.ManagedChannelBuilder;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;

@Configuration
public class GrpcClientConfig {

    @Bean
    public ManagedChannel managedChannel() {
        return ManagedChannelBuilder.forAddress("localhost", 9091)
            .usePlaintext()
            .build();
    }

    @Bean
    public EmployeeGrpcClient employeeGrpcClient() {
        return new EmployeeGrpcClient();    }
}
