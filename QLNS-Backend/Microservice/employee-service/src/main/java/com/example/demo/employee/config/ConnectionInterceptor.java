package com.example.demo.employee.config;
import io.grpc.*;
import io.grpc.ServerCall.Listener;

public class ConnectionInterceptor implements ServerInterceptor {

    @Override
    public <ReqT, RespT> Listener<ReqT> interceptCall(
            ServerCall<ReqT, RespT> call, Metadata headers, ServerCallHandler<ReqT, RespT> next) {
        System.out.println("Client connected: " + call.getAttributes());

        return next.startCall(call, headers);
    }
}
