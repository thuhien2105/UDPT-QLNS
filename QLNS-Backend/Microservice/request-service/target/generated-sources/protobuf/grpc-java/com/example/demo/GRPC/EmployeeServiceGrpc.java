package com.example.demo.GRPC;

import static io.grpc.MethodDescriptor.generateFullMethodName;

/**
 */
@javax.annotation.Generated(
    value = "by gRPC proto compiler (version 1.66.0)",
    comments = "Source: employee.proto")
@io.grpc.stub.annotations.GrpcGenerated
public final class EmployeeServiceGrpc {

  private EmployeeServiceGrpc() {}

  public static final java.lang.String SERVICE_NAME = "com.example.demo.GRPC.EmployeeService";

  // Static method descriptors that strictly reflect the proto.
  private static volatile io.grpc.MethodDescriptor<com.example.demo.GRPC.EmployeeProto.EmployeeRequest,
      com.example.demo.GRPC.EmployeeProto.EmployeeResponse> getGetEmployeeByIdMethod;

  @io.grpc.stub.annotations.RpcMethod(
      fullMethodName = SERVICE_NAME + '/' + "GetEmployeeById",
      requestType = com.example.demo.GRPC.EmployeeProto.EmployeeRequest.class,
      responseType = com.example.demo.GRPC.EmployeeProto.EmployeeResponse.class,
      methodType = io.grpc.MethodDescriptor.MethodType.UNARY)
  public static io.grpc.MethodDescriptor<com.example.demo.GRPC.EmployeeProto.EmployeeRequest,
      com.example.demo.GRPC.EmployeeProto.EmployeeResponse> getGetEmployeeByIdMethod() {
    io.grpc.MethodDescriptor<com.example.demo.GRPC.EmployeeProto.EmployeeRequest, com.example.demo.GRPC.EmployeeProto.EmployeeResponse> getGetEmployeeByIdMethod;
    if ((getGetEmployeeByIdMethod = EmployeeServiceGrpc.getGetEmployeeByIdMethod) == null) {
      synchronized (EmployeeServiceGrpc.class) {
        if ((getGetEmployeeByIdMethod = EmployeeServiceGrpc.getGetEmployeeByIdMethod) == null) {
          EmployeeServiceGrpc.getGetEmployeeByIdMethod = getGetEmployeeByIdMethod =
              io.grpc.MethodDescriptor.<com.example.demo.GRPC.EmployeeProto.EmployeeRequest, com.example.demo.GRPC.EmployeeProto.EmployeeResponse>newBuilder()
              .setType(io.grpc.MethodDescriptor.MethodType.UNARY)
              .setFullMethodName(generateFullMethodName(SERVICE_NAME, "GetEmployeeById"))
              .setSampledToLocalTracing(true)
              .setRequestMarshaller(io.grpc.protobuf.ProtoUtils.marshaller(
                  com.example.demo.GRPC.EmployeeProto.EmployeeRequest.getDefaultInstance()))
              .setResponseMarshaller(io.grpc.protobuf.ProtoUtils.marshaller(
                  com.example.demo.GRPC.EmployeeProto.EmployeeResponse.getDefaultInstance()))
              .setSchemaDescriptor(new EmployeeServiceMethodDescriptorSupplier("GetEmployeeById"))
              .build();
        }
      }
    }
    return getGetEmployeeByIdMethod;
  }

  private static volatile io.grpc.MethodDescriptor<com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest,
      com.example.demo.GRPC.EmployeeProto.EmployeeResponse> getUpdateEmployeeMethod;

  @io.grpc.stub.annotations.RpcMethod(
      fullMethodName = SERVICE_NAME + '/' + "UpdateEmployee",
      requestType = com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest.class,
      responseType = com.example.demo.GRPC.EmployeeProto.EmployeeResponse.class,
      methodType = io.grpc.MethodDescriptor.MethodType.UNARY)
  public static io.grpc.MethodDescriptor<com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest,
      com.example.demo.GRPC.EmployeeProto.EmployeeResponse> getUpdateEmployeeMethod() {
    io.grpc.MethodDescriptor<com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest, com.example.demo.GRPC.EmployeeProto.EmployeeResponse> getUpdateEmployeeMethod;
    if ((getUpdateEmployeeMethod = EmployeeServiceGrpc.getUpdateEmployeeMethod) == null) {
      synchronized (EmployeeServiceGrpc.class) {
        if ((getUpdateEmployeeMethod = EmployeeServiceGrpc.getUpdateEmployeeMethod) == null) {
          EmployeeServiceGrpc.getUpdateEmployeeMethod = getUpdateEmployeeMethod =
              io.grpc.MethodDescriptor.<com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest, com.example.demo.GRPC.EmployeeProto.EmployeeResponse>newBuilder()
              .setType(io.grpc.MethodDescriptor.MethodType.UNARY)
              .setFullMethodName(generateFullMethodName(SERVICE_NAME, "UpdateEmployee"))
              .setSampledToLocalTracing(true)
              .setRequestMarshaller(io.grpc.protobuf.ProtoUtils.marshaller(
                  com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest.getDefaultInstance()))
              .setResponseMarshaller(io.grpc.protobuf.ProtoUtils.marshaller(
                  com.example.demo.GRPC.EmployeeProto.EmployeeResponse.getDefaultInstance()))
              .setSchemaDescriptor(new EmployeeServiceMethodDescriptorSupplier("UpdateEmployee"))
              .build();
        }
      }
    }
    return getUpdateEmployeeMethod;
  }

  /**
   * Creates a new async stub that supports all call types for the service
   */
  public static EmployeeServiceStub newStub(io.grpc.Channel channel) {
    io.grpc.stub.AbstractStub.StubFactory<EmployeeServiceStub> factory =
      new io.grpc.stub.AbstractStub.StubFactory<EmployeeServiceStub>() {
        @java.lang.Override
        public EmployeeServiceStub newStub(io.grpc.Channel channel, io.grpc.CallOptions callOptions) {
          return new EmployeeServiceStub(channel, callOptions);
        }
      };
    return EmployeeServiceStub.newStub(factory, channel);
  }

  /**
   * Creates a new blocking-style stub that supports unary and streaming output calls on the service
   */
  public static EmployeeServiceBlockingStub newBlockingStub(
      io.grpc.Channel channel) {
    io.grpc.stub.AbstractStub.StubFactory<EmployeeServiceBlockingStub> factory =
      new io.grpc.stub.AbstractStub.StubFactory<EmployeeServiceBlockingStub>() {
        @java.lang.Override
        public EmployeeServiceBlockingStub newStub(io.grpc.Channel channel, io.grpc.CallOptions callOptions) {
          return new EmployeeServiceBlockingStub(channel, callOptions);
        }
      };
    return EmployeeServiceBlockingStub.newStub(factory, channel);
  }

  /**
   * Creates a new ListenableFuture-style stub that supports unary calls on the service
   */
  public static EmployeeServiceFutureStub newFutureStub(
      io.grpc.Channel channel) {
    io.grpc.stub.AbstractStub.StubFactory<EmployeeServiceFutureStub> factory =
      new io.grpc.stub.AbstractStub.StubFactory<EmployeeServiceFutureStub>() {
        @java.lang.Override
        public EmployeeServiceFutureStub newStub(io.grpc.Channel channel, io.grpc.CallOptions callOptions) {
          return new EmployeeServiceFutureStub(channel, callOptions);
        }
      };
    return EmployeeServiceFutureStub.newStub(factory, channel);
  }

  /**
   */
  public interface AsyncService {

    /**
     */
    default void getEmployeeById(com.example.demo.GRPC.EmployeeProto.EmployeeRequest request,
        io.grpc.stub.StreamObserver<com.example.demo.GRPC.EmployeeProto.EmployeeResponse> responseObserver) {
      io.grpc.stub.ServerCalls.asyncUnimplementedUnaryCall(getGetEmployeeByIdMethod(), responseObserver);
    }

    /**
     */
    default void updateEmployee(com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest request,
        io.grpc.stub.StreamObserver<com.example.demo.GRPC.EmployeeProto.EmployeeResponse> responseObserver) {
      io.grpc.stub.ServerCalls.asyncUnimplementedUnaryCall(getUpdateEmployeeMethod(), responseObserver);
    }
  }

  /**
   * Base class for the server implementation of the service EmployeeService.
   */
  public static abstract class EmployeeServiceImplBase
      implements io.grpc.BindableService, AsyncService {

    @java.lang.Override public final io.grpc.ServerServiceDefinition bindService() {
      return EmployeeServiceGrpc.bindService(this);
    }
  }

  /**
   * A stub to allow clients to do asynchronous rpc calls to service EmployeeService.
   */
  public static final class EmployeeServiceStub
      extends io.grpc.stub.AbstractAsyncStub<EmployeeServiceStub> {
    private EmployeeServiceStub(
        io.grpc.Channel channel, io.grpc.CallOptions callOptions) {
      super(channel, callOptions);
    }

    @java.lang.Override
    protected EmployeeServiceStub build(
        io.grpc.Channel channel, io.grpc.CallOptions callOptions) {
      return new EmployeeServiceStub(channel, callOptions);
    }

    /**
     */
    public void getEmployeeById(com.example.demo.GRPC.EmployeeProto.EmployeeRequest request,
        io.grpc.stub.StreamObserver<com.example.demo.GRPC.EmployeeProto.EmployeeResponse> responseObserver) {
      io.grpc.stub.ClientCalls.asyncUnaryCall(
          getChannel().newCall(getGetEmployeeByIdMethod(), getCallOptions()), request, responseObserver);
    }

    /**
     */
    public void updateEmployee(com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest request,
        io.grpc.stub.StreamObserver<com.example.demo.GRPC.EmployeeProto.EmployeeResponse> responseObserver) {
      io.grpc.stub.ClientCalls.asyncUnaryCall(
          getChannel().newCall(getUpdateEmployeeMethod(), getCallOptions()), request, responseObserver);
    }
  }

  /**
   * A stub to allow clients to do synchronous rpc calls to service EmployeeService.
   */
  public static final class EmployeeServiceBlockingStub
      extends io.grpc.stub.AbstractBlockingStub<EmployeeServiceBlockingStub> {
    private EmployeeServiceBlockingStub(
        io.grpc.Channel channel, io.grpc.CallOptions callOptions) {
      super(channel, callOptions);
    }

    @java.lang.Override
    protected EmployeeServiceBlockingStub build(
        io.grpc.Channel channel, io.grpc.CallOptions callOptions) {
      return new EmployeeServiceBlockingStub(channel, callOptions);
    }

    /**
     */
    public com.example.demo.GRPC.EmployeeProto.EmployeeResponse getEmployeeById(com.example.demo.GRPC.EmployeeProto.EmployeeRequest request) {
      return io.grpc.stub.ClientCalls.blockingUnaryCall(
          getChannel(), getGetEmployeeByIdMethod(), getCallOptions(), request);
    }

    /**
     */
    public com.example.demo.GRPC.EmployeeProto.EmployeeResponse updateEmployee(com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest request) {
      return io.grpc.stub.ClientCalls.blockingUnaryCall(
          getChannel(), getUpdateEmployeeMethod(), getCallOptions(), request);
    }
  }

  /**
   * A stub to allow clients to do ListenableFuture-style rpc calls to service EmployeeService.
   */
  public static final class EmployeeServiceFutureStub
      extends io.grpc.stub.AbstractFutureStub<EmployeeServiceFutureStub> {
    private EmployeeServiceFutureStub(
        io.grpc.Channel channel, io.grpc.CallOptions callOptions) {
      super(channel, callOptions);
    }

    @java.lang.Override
    protected EmployeeServiceFutureStub build(
        io.grpc.Channel channel, io.grpc.CallOptions callOptions) {
      return new EmployeeServiceFutureStub(channel, callOptions);
    }

    /**
     */
    public com.google.common.util.concurrent.ListenableFuture<com.example.demo.GRPC.EmployeeProto.EmployeeResponse> getEmployeeById(
        com.example.demo.GRPC.EmployeeProto.EmployeeRequest request) {
      return io.grpc.stub.ClientCalls.futureUnaryCall(
          getChannel().newCall(getGetEmployeeByIdMethod(), getCallOptions()), request);
    }

    /**
     */
    public com.google.common.util.concurrent.ListenableFuture<com.example.demo.GRPC.EmployeeProto.EmployeeResponse> updateEmployee(
        com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest request) {
      return io.grpc.stub.ClientCalls.futureUnaryCall(
          getChannel().newCall(getUpdateEmployeeMethod(), getCallOptions()), request);
    }
  }

  private static final int METHODID_GET_EMPLOYEE_BY_ID = 0;
  private static final int METHODID_UPDATE_EMPLOYEE = 1;

  private static final class MethodHandlers<Req, Resp> implements
      io.grpc.stub.ServerCalls.UnaryMethod<Req, Resp>,
      io.grpc.stub.ServerCalls.ServerStreamingMethod<Req, Resp>,
      io.grpc.stub.ServerCalls.ClientStreamingMethod<Req, Resp>,
      io.grpc.stub.ServerCalls.BidiStreamingMethod<Req, Resp> {
    private final AsyncService serviceImpl;
    private final int methodId;

    MethodHandlers(AsyncService serviceImpl, int methodId) {
      this.serviceImpl = serviceImpl;
      this.methodId = methodId;
    }

    @java.lang.Override
    @java.lang.SuppressWarnings("unchecked")
    public void invoke(Req request, io.grpc.stub.StreamObserver<Resp> responseObserver) {
      switch (methodId) {
        case METHODID_GET_EMPLOYEE_BY_ID:
          serviceImpl.getEmployeeById((com.example.demo.GRPC.EmployeeProto.EmployeeRequest) request,
              (io.grpc.stub.StreamObserver<com.example.demo.GRPC.EmployeeProto.EmployeeResponse>) responseObserver);
          break;
        case METHODID_UPDATE_EMPLOYEE:
          serviceImpl.updateEmployee((com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest) request,
              (io.grpc.stub.StreamObserver<com.example.demo.GRPC.EmployeeProto.EmployeeResponse>) responseObserver);
          break;
        default:
          throw new AssertionError();
      }
    }

    @java.lang.Override
    @java.lang.SuppressWarnings("unchecked")
    public io.grpc.stub.StreamObserver<Req> invoke(
        io.grpc.stub.StreamObserver<Resp> responseObserver) {
      switch (methodId) {
        default:
          throw new AssertionError();
      }
    }
  }

  public static final io.grpc.ServerServiceDefinition bindService(AsyncService service) {
    return io.grpc.ServerServiceDefinition.builder(getServiceDescriptor())
        .addMethod(
          getGetEmployeeByIdMethod(),
          io.grpc.stub.ServerCalls.asyncUnaryCall(
            new MethodHandlers<
              com.example.demo.GRPC.EmployeeProto.EmployeeRequest,
              com.example.demo.GRPC.EmployeeProto.EmployeeResponse>(
                service, METHODID_GET_EMPLOYEE_BY_ID)))
        .addMethod(
          getUpdateEmployeeMethod(),
          io.grpc.stub.ServerCalls.asyncUnaryCall(
            new MethodHandlers<
              com.example.demo.GRPC.EmployeeProto.UpdateEmployeeRequest,
              com.example.demo.GRPC.EmployeeProto.EmployeeResponse>(
                service, METHODID_UPDATE_EMPLOYEE)))
        .build();
  }

  private static abstract class EmployeeServiceBaseDescriptorSupplier
      implements io.grpc.protobuf.ProtoFileDescriptorSupplier, io.grpc.protobuf.ProtoServiceDescriptorSupplier {
    EmployeeServiceBaseDescriptorSupplier() {}

    @java.lang.Override
    public com.google.protobuf.Descriptors.FileDescriptor getFileDescriptor() {
      return com.example.demo.GRPC.EmployeeProto.getDescriptor();
    }

    @java.lang.Override
    public com.google.protobuf.Descriptors.ServiceDescriptor getServiceDescriptor() {
      return getFileDescriptor().findServiceByName("EmployeeService");
    }
  }

  private static final class EmployeeServiceFileDescriptorSupplier
      extends EmployeeServiceBaseDescriptorSupplier {
    EmployeeServiceFileDescriptorSupplier() {}
  }

  private static final class EmployeeServiceMethodDescriptorSupplier
      extends EmployeeServiceBaseDescriptorSupplier
      implements io.grpc.protobuf.ProtoMethodDescriptorSupplier {
    private final java.lang.String methodName;

    EmployeeServiceMethodDescriptorSupplier(java.lang.String methodName) {
      this.methodName = methodName;
    }

    @java.lang.Override
    public com.google.protobuf.Descriptors.MethodDescriptor getMethodDescriptor() {
      return getServiceDescriptor().findMethodByName(methodName);
    }
  }

  private static volatile io.grpc.ServiceDescriptor serviceDescriptor;

  public static io.grpc.ServiceDescriptor getServiceDescriptor() {
    io.grpc.ServiceDescriptor result = serviceDescriptor;
    if (result == null) {
      synchronized (EmployeeServiceGrpc.class) {
        result = serviceDescriptor;
        if (result == null) {
          serviceDescriptor = result = io.grpc.ServiceDescriptor.newBuilder(SERVICE_NAME)
              .setSchemaDescriptor(new EmployeeServiceFileDescriptorSupplier())
              .addMethod(getGetEmployeeByIdMethod())
              .addMethod(getUpdateEmployeeMethod())
              .build();
        }
      }
    }
    return result;
  }
}
