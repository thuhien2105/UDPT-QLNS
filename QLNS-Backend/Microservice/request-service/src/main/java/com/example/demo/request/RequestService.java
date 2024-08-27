package com.example.demo.request;

import com.example.demo.GRPC.EmployeeGrpcClient;
import com.example.demo.GRPC.EmployeeProto.Employee;
import com.example.demo.GRPC.EmployeeProto.EmployeeResponse;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.data.domain.PageRequest;
import org.springframework.stereotype.Service;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import org.springframework.data.domain.Pageable;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Optional;
import java.util.stream.Collectors;

@Service
public class RequestService {

    private final RequestRepository requestRepository;
    private final ObjectMapper objectMapper;
    private final EmployeeGrpcClient employeeGrpcClient;
    private static final int PAGE_SIZE = 20;

    @Autowired
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

    public List<Map<String, Object>> getAllRequests() {
        List<RequestEntity> requests = (List<RequestEntity>) requestRepository.findAll();

        return requests.stream().map(request -> {
            EmployeeDTO employeeDto = null;
            try {
                EmployeeResponse employee = employeeGrpcClient.getEmployeeById(request.getEmployeeId());
                employeeDto = new EmployeeDTO(employee);
            } catch (Exception e) {
                e.printStackTrace();
            }

            Map<String, Object> result = new HashMap<>();
            result.put("request", request);
            result.put("employee", employeeDto);

            return result;
        }).collect(Collectors.toList());
    }

    public List<Map<String, Object>> getRequestByEmployeeId(String employeeId, int month, int year, int page) {
        LocalDateTime startDate = LocalDate.of(year, month, 1).atStartOfDay();
        LocalDateTime endDate = startDate.plusMonths(1).minusNanos(1);

        Pageable pageable = PageRequest.of(page, PAGE_SIZE);
        Page<RequestEntity> requestPage = requestRepository.findByEmployeeIdAndRequestDateBetween(employeeId, startDate, endDate, pageable);

        return requestPage.getContent().stream()
                .filter(request -> !RequestEntity.RequestType.CHECK_IN.equals(request.getRequestType())
                        && !RequestEntity.RequestType.CHECK_OUT.equals(request.getRequestType()))
                .sorted((r1, r2) -> r1.getRequestDate().compareTo(r2.getRequestDate()))
                .map(request -> {
                    EmployeeDTO employeeDto = null;
                    try {
                        EmployeeResponse employee = employeeGrpcClient.getEmployeeById(request.getEmployeeId());
                        employeeDto = new EmployeeDTO(employee);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }

                    Map<String, Object> result = new HashMap<>();
                    result.put("request", request);
                    result.put("employee", employeeDto);

                    return result;
                }).collect(Collectors.toList());
    }

    public List<Map<String, Object>> getTimeSheetByEmployeeId(String employeeId, int month, int year, int page) {
        LocalDateTime startDate = LocalDate.of(year, month, 1).atStartOfDay();
        LocalDateTime endDate = startDate.plusMonths(1).minusNanos(1);

        Pageable pageable = PageRequest.of(page, PAGE_SIZE);
        Page<RequestEntity> requestPage = requestRepository.findByEmployeeIdAndRequestTypeInAndRequestDateBetween(
                employeeId,
                List.of(RequestEntity.RequestType.CHECK_IN, RequestEntity.RequestType.CHECK_OUT),
                startDate,
                endDate,
                pageable
        );

        return requestPage.getContent().stream()
                .sorted((r1, r2) -> r1.getRequestDate().compareTo(r2.getRequestDate()))
                .map(request -> {
                    EmployeeDTO employeeDto = null;
                    try {
                        EmployeeResponse employee = employeeGrpcClient.getEmployeeById(request.getEmployeeId());
                        employeeDto = new EmployeeDTO(employee);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }

                    Map<String, Object> result = new HashMap<>();
                    result.put("request", request);
                    result.put("employee", employeeDto);

                    return result;
                }).collect(Collectors.toList());
    }
    
    public RequestEntity checkIn(String employeeId) {
        LocalDateTime now = LocalDateTime.now();
        Optional<RequestEntity> optionalRequest = requestRepository.findByEmployeeIdAndRequestDate(employeeId, now.toLocalDate().atStartOfDay());

        RequestEntity request;
        if (optionalRequest.isPresent()) {
            request = optionalRequest.get();
            if (request.getRequestDate() == null) {
                request.setRequestDate(now);
                return requestRepository.save(request);
            } else {
                throw new IllegalStateException("Already checked in today.");
            }
        } else {
            request = new RequestEntity();
            request.setEmployeeId(employeeId);
            request.setRequestType(RequestEntity.RequestType.CHECK_IN);
            request.setRequestDate(now);
            request.setCreatedAt(now);
            request.setUpdatedAt(now);
            return requestRepository.save(request);
        }
    }


    public RequestEntity checkOut(String employeeId) {
        LocalDateTime now = LocalDateTime.now();
        Optional<RequestEntity> optionalRequest = requestRepository.findByEmployeeIdAndRequestDate(employeeId, now.toLocalDate().atStartOfDay());

        if (optionalRequest.isPresent()) {
            RequestEntity request = optionalRequest.get();
            if (request.getRequestDate() != null && request.getEndTime() == null) {
                request.setEndTime(now);
                request.setUpdatedAt(now);
                return requestRepository.save(request);
            } else {
                throw new IllegalStateException("Cannot check out without checking in or already checked out.");
            }
        } else {
            throw new IllegalArgumentException("No check-in record found for today.");
        }
    }


    public Optional<Map<String, Object>> getRequestById(Integer requestId) {
        Optional<RequestEntity> requestOpt = requestRepository.findById(requestId);

        if (requestOpt.isPresent()) {
            RequestEntity request = requestOpt.get();
            EmployeeDTO employeeDto = null;
            try {
                EmployeeResponse employee = employeeGrpcClient.getEmployeeById(request.getEmployeeId());
                employeeDto = new EmployeeDTO(employee);
            } catch (Exception e) {
                e.printStackTrace();
            }

            Map<String, Object> result = new HashMap<>();
            result.put("request", request);
            result.put("employee", employeeDto);

            return Optional.of(result);
        } else {
            return Optional.empty();
        }
    }

    public RequestEntity saveRequest(String action, JsonNode payload) {
        RequestEntity requestEntity = new RequestEntity();

        return requestRepository.save(requestEntity);
    }

    public void updateResponse(Integer requestId, JsonNode response) {
        RequestEntity requestEntity = requestRepository.findById(requestId)
            .orElseThrow(() -> new RuntimeException("Request not found"));
        requestRepository.save(requestEntity);
    }
}
