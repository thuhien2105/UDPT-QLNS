package com.example.demo.request;

import com.example.demo.GRPC.EmployeeGrpcClient;
import com.example.demo.GRPC.EmployeeProto.Employee;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;
import java.util.stream.Collectors;

@Service
public class RequestService {

    private final RequestRepository requestRepository;
    private final ObjectMapper objectMapper;
    private final EmployeeGrpcClient employeeGrpcClient;

    public RequestService(RequestRepository requestRepository,
                          ObjectMapper objectMapper,
                          EmployeeGrpcClient employeeGrpcClient) {
        this.requestRepository = requestRepository;
        this.objectMapper = objectMapper;
        this.employeeGrpcClient = employeeGrpcClient;
    }

    public RequestEntity createRequest(RequestEntity requestEntity) {
        return requestRepository.save(requestEntity);
    }

    public RequestEntity updateRequest(RequestEntity requestEntity) {
        if (!requestRepository.existsById(requestEntity.getId())) {
            throw new RuntimeException("Request not found");
        }
        return requestRepository.save(requestEntity);
    }

    public void deleteRequest(Integer requestId) {
        if (!requestRepository.existsById(requestId)) {
            throw new RuntimeException("Request not found");
        }
        requestRepository.deleteById(requestId);
    }

    public List<RequestWithEmployee> getAllRequests() {
        List<RequestEntity> requests = (List<RequestEntity>) requestRepository.findAll();

        return requests.stream().map(request -> {
            Employee employee = employeeGrpcClient.getEmployeeById(request.getEmployeeId());
            return new RequestWithEmployee(request, employee);
        }).collect(Collectors.toList());
    }

    public Optional<RequestEntity> getRequestById(Integer requestId) {
        return requestRepository.findById(requestId);
    }

    public RequestEntity saveRequest(String action, JsonNode payload) {
        RequestEntity requestEntity = new RequestEntity();
        requestEntity.setAction(action);
        requestEntity.setPayload(payload.toString());
        return requestRepository.save(requestEntity);
    }

    public void updateResponse(Integer requestId, JsonNode response) {
        RequestEntity requestEntity = requestRepository.findById(requestId)
            .orElseThrow(() -> new RuntimeException("Request not found"));
        requestEntity.setResponse(response.toString());
        requestRepository.save(requestEntity);
    }
}
