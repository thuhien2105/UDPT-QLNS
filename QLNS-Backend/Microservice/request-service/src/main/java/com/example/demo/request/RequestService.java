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
import java.time.LocalTime;

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

    public Map<String, Object> getAllRequests(int page) {
        Pageable pageable = PageRequest.of(page-1, PAGE_SIZE);
        Page<RequestEntity> requestPage = requestRepository.findAll(pageable);
    	System.out.println("requestPage.getContent Response: " + requestPage.getContent());

        List<Map<String, Object>> requests = requestPage.getContent().stream().map(request -> {
            EmployeeDTO employeeDto = null;
          
            try {                
            	System.out.println("request Response: " + request);

                EmployeeResponse employee = employeeGrpcClient.getEmployeeById(request.getEmployee_id());
                System.out.println("Employee Response: " + employee);
                employeeDto = new EmployeeDTO(employee);
            } catch (Exception e) {
                e.printStackTrace();
            }

            Map<String, Object> result = new HashMap<>();
            result.put("request", request);
            result.put("employee", employeeDto);

            System.out.println("Mapped Request: " + result);
            return result;
        }).collect(Collectors.toList());


        Map<String, Object> result = new HashMap<>();
        result.put("requests", requests);
        result.put("currentPage", page);
        result.put("totalPages", requestPage.getTotalPages());

        return result;
    }

    
    public Map<String, Object> getRequestByEmployeeId(String employeeId, int month, int year, int page) {
        LocalDateTime startDate = LocalDate.of(year, month, 1).atStartOfDay();
        LocalDateTime endDate = startDate.plusMonths(1).minusNanos(1);

        Pageable pageable = PageRequest.of(page - 1, PAGE_SIZE);

        Page<RequestEntity> requestPage = requestRepository.findByEmployeeIdAndRequestDateBetweenAndExcludedTypes(
                employeeId,
                startDate,
                endDate,
                List.of(RequestEntity.RequestType.CHECK_IN, RequestEntity.RequestType.CHECK_OUT),
                pageable
        );

        List<Map<String, Object>> requests = requestPage.getContent().stream()
                .filter(request -> !RequestEntity.RequestType.CHECK_IN.equals(request.getRequest_type())
                        && !RequestEntity.RequestType.CHECK_OUT.equals(request.getRequest_type()))
                .sorted((r1, r2) -> r1.getRequest_date().compareTo(r2.getRequest_date()))
                .map(request -> {
                    EmployeeDTO employeeDto = null;
                    try {
                        EmployeeResponse employee = employeeGrpcClient.getEmployeeById(request.getEmployee_id());
                        employeeDto = new EmployeeDTO(employee);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }

                    Map<String, Object> result = new HashMap<>();
                    result.put("request", request);
                    result.put("employee", employeeDto);

                    return result;
                }).collect(Collectors.toList());

        Map<String, Object> result = new HashMap<>();
        result.put("requests", requests);
        result.put("currentPage", page);
        result.put("totalPages", requestPage.getTotalPages());
        result.put("totalRequests", requestPage.getTotalElements());

        return result;
        
    }



    public Map<String, Object> getTimeSheetByEmployeeId(String employeeId, int month, int year, int page) {
        Pageable pageable = PageRequest.of(page - 1, PAGE_SIZE);

        Page<RequestEntity> requestPage = requestRepository.findByEmployeeIdAndRequestTypesAndMonthAndYear(
                employeeId,
                List.of(RequestEntity.RequestType.CHECK_IN, RequestEntity.RequestType.CHECK_OUT),
                month,
                year,
                pageable
        );

        List<Map<String, Object>> requests = requestPage.getContent().stream()
                .sorted((r1, r2) -> r1.getRequest_date().compareTo(r2.getRequest_date()))
                .map(request -> {
                    EmployeeDTO employeeDto = null;
                    try {
                        EmployeeResponse employee = employeeGrpcClient.getEmployeeById(request.getEmployee_id());
                        employeeDto = new EmployeeDTO(employee);
                    } catch (Exception e) {
                        e.printStackTrace();
                    }

                    Map<String, Object> result = new HashMap<>();
                    result.put("request", request);
                    result.put("employee", employeeDto);

                    return result;
                }).collect(Collectors.toList());

        Map<String, Object> result = new HashMap<>();
        result.put("requests", requests);
        result.put("currentPage", page);
        result.put("totalPages", requestPage.getTotalPages());
        result.put("totalRequests", requestPage.getTotalElements());

        return result;
    }


    
    public RequestEntity checkIn(String employeeId) {
        LocalDateTime now = LocalDateTime.now();
        LocalDate currentDate = now.toLocalDate();

        List<RequestEntity> checkInsToday = requestRepository.findCheckInsForToday(employeeId, currentDate);

        if (!checkInsToday.isEmpty()) {
            throw new IllegalStateException("Already checked in today.");
        }

        RequestEntity request = new RequestEntity();
        request.setEmployee_id(employeeId);
        request.setRequest_type(RequestEntity.RequestType.CHECK_IN);
        request.setRequest_date(now);
        request.setCreated_at(now);
        request.setUpdated_at(now);

        return requestRepository.save(request);
    }

    public RequestEntity checkOut(String employeeId) {
        LocalDateTime now = LocalDateTime.now();
        LocalDate currentDate = now.toLocalDate();

        List<RequestEntity> checkInsToday = requestRepository.findCheckInsForToday(employeeId, currentDate);

        if (checkInsToday.isEmpty()) {
            throw new IllegalArgumentException("No check-in record found for today.");
        }

        List<RequestEntity> checkOutsToday = requestRepository.findByEmployeeIdAndRequestTypeAndRequestDate(
                employeeId,
                RequestEntity.RequestType.CHECK_OUT,
                LocalDateTime.of(currentDate, LocalTime.MIN),
                LocalDateTime.of(currentDate, LocalTime.MAX)
        );

        if (!checkOutsToday.isEmpty()) {
            throw new IllegalStateException("Check-out already recorded for today.");
        }

        RequestEntity request = new RequestEntity();
        request.setEmployee_id(employeeId);
        request.setRequest_type(RequestEntity.RequestType.CHECK_OUT);
        request.setRequest_date(now);
        request.setCreated_at(now);
        request.setUpdated_at(now);

        return requestRepository.save(request);
    }





    public Optional<Map<String, Object>> getRequestById(Integer requestId) {
        Optional<RequestEntity> requestOpt = requestRepository.findById(requestId);

        if (requestOpt.isPresent()) {
            RequestEntity request = requestOpt.get();
            EmployeeDTO employeeDto = null;
            try {
                EmployeeResponse employee = employeeGrpcClient.getEmployeeById(request.getEmployee_id());
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
