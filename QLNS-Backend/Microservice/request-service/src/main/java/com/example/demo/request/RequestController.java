package com.example.demo.request;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ArrayNode;
import com.fasterxml.jackson.databind.node.ObjectNode;
import org.springframework.amqp.core.Message;
import org.springframework.amqp.core.MessageProperties;
import org.springframework.amqp.rabbit.annotation.RabbitListener;
import org.springframework.amqp.rabbit.core.RabbitTemplate;
import org.springframework.amqp.support.AmqpHeaders;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.handler.annotation.Header;
import org.springframework.web.bind.annotation.*;

import java.time.LocalDateTime;
import java.util.List;
import java.util.Map;
import java.util.Optional;

@RestController
@RequestMapping("/requests")
public class RequestController {

    @Autowired
    private RequestService requestService;

    @Autowired
    private RabbitTemplate rabbitTemplate;

    @Autowired
    private ObjectMapper objectMapper;

    private Map<String, Object> extractMessageMap(Message message) {
        try {
            return objectMapper.readValue(new String(message.getBody()), Map.class);
        } catch (Exception e) {
            throw new RuntimeException("Failed to parse message", e);
        }
    }

    @RabbitListener(queues = "topic-requests")
    public void handleResponse(Message message, @Header(AmqpHeaders.CORRELATION_ID) String correlationId,
                               @Header(AmqpHeaders.REPLY_TO) String replyTo) {
        try {
            Map<String, Object> messageMap = extractMessageMap(message);
            String action = (String) messageMap.get("action");
            System.out.println(action);

            JsonNode responseNode = handleAction(action, messageMap);
            sendResponse(responseNode, correlationId, replyTo);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private JsonNode handleAction(String action, Map<String, Object> messageMap) {
        switch (action) {
            case "get_all_request":

                return getAllRequest(messageMap);
            case "get_all_timesheet":

                return getAllTimesheet(messageMap);
            case "get_by_id":
                return getRequestById(messageMap);
            case "get_time_sheet_by_employee":
                return getTimeSheetByEmployee(messageMap);
            case "get_request_by_employee":
                return getRequestByEmployee(messageMap);
            case "approve":
                return approve(messageMap);

            case "check-in":
                return checkInResponse(messageMap);
            case "check-out":
                return checkOutResponse(messageMap);
            	
            case "create":
                return createRequestResponse(messageMap);
            case "update":
                return updateRequestResponse(messageMap);
            case "delete":
                return deleteRequestResponse(messageMap);
            default:
                return objectMapper.createObjectNode().put("status", "Unknown action: " + action);
        }
    }
    
    private JsonNode getAllRequest(Map<String, Object> messageMap) { 

    	 int month = Integer.parseInt((String) messageMap.get("month"));
         int year = Integer.parseInt((String) messageMap.get("year"));
         int page = Integer.parseInt((String) messageMap.get("page"));
         

        return toJson(requestService.getAllRequests(month, year, page));
    }
    
    private JsonNode getAllTimesheet(Map<String, Object> messageMap) { 
    	 int month = Integer.parseInt((String) messageMap.get("month"));
         int year = Integer.parseInt((String) messageMap.get("year"));
         int page = Integer.parseInt((String) messageMap.get("page"));
         
        return toJson(requestService.getAllTimesheet(month, year, page));
    }
    
    
    
    private JsonNode approve(Map<String, Object> messageMap) {
        try {
            String managerId = (String) messageMap.get("manager_id");
            Integer id = null;
            if (messageMap.get("id") instanceof Integer) {
                id = (Integer) messageMap.get("id");
            } else if (messageMap.get("id") instanceof String) {
                try {
                    id = Integer.valueOf((String) messageMap.get("id"));
                } catch (NumberFormatException e) {
                    return createErrorResponse("Invalid ID format");
                }
            } else {
                return createErrorResponse("ID is required and must be an integer");
            }

            String status = (String) messageMap.get("status");
            if (status == null || status.isEmpty()) {
                return createErrorResponse("Status is required");
            }

            RequestEntity requestEntity = requestService.approve(id, managerId, status);

            if (requestEntity == null) {
                return createErrorResponse("Failed to approve request. Request not found.");
            }

            return objectMapper.convertValue(requestEntity, JsonNode.class);
            
        } catch (Exception e) {
            return createErrorResponse("An error occurred: " + e.getMessage());
        }
    }

    private JsonNode createErrorResponse(String errorMessage) {
        return objectMapper.createObjectNode()
                .put("status", "error")
                .put("message", errorMessage);
    }


    
    
    
 
    
    
    private JsonNode checkInResponse(Map<String, Object> messageMap) {
        String employeeId = (String) messageMap.get("employee_id");

        try {
            RequestEntity updatedRequest = requestService.checkIn(employeeId);
            return objectMapper.createObjectNode()
                    .put("status", "Checked in successfully")
                    .set("request", toJson(updatedRequest));
        } catch (IllegalStateException | IllegalArgumentException e) {
            return objectMapper.createObjectNode()
                    .put("status", "Check-in failed")
                    .put("message", e.getMessage());
        }
    }

    private JsonNode checkOutResponse(Map<String, Object> messageMap) {
        String employeeId = (String) messageMap.get("employee_id");

        try {
            RequestEntity updatedRequest = requestService.checkOut(employeeId);
            return objectMapper.createObjectNode()
                    .put("status", "Checked out successfully")
                    .set("request", toJson(updatedRequest));
        } catch (IllegalStateException | IllegalArgumentException e) {
            return objectMapper.createObjectNode()
                    .put("status", "Check-out failed")
                    .put("message", e.getMessage());
        }
    }

    private JsonNode getTimeSheetByEmployee(Map<String, Object> messageMap) {
        String employeeId = (String) messageMap.get("employee_id");
        int month = Integer.parseInt((String) messageMap.get("month"));
        int year = Integer.parseInt((String) messageMap.get("year"));
        int page = Integer.parseInt((String) messageMap.get("page"));

        Map<String, Object> resultMap = requestService.getTimeSheetByEmployeeId(employeeId, month, year, page);

        ObjectNode responseNode = objectMapper.createObjectNode();

        int currentPage = (Integer) resultMap.get("currentPage");
        int totalPages = (Integer) resultMap.get("totalPages");
        long totalRequests = (Long) resultMap.get("totalRequests");

        List<Map<String, Object>> requests = (List<Map<String, Object>>) resultMap.get("requests");

        responseNode.put("status", requests.isEmpty() ? "No requests found for the given employee ID" : "Requests retrieved");
        responseNode.put("currentPage", currentPage);
        responseNode.put("totalPages", totalPages);

        if (requests != null && !requests.isEmpty()) {
            ArrayNode requestsArrayNode = objectMapper.createArrayNode();

            for (Map<String, Object> requestMap : requests) {
                ObjectNode requestNode = objectMapper.createObjectNode();
                requestNode.set("request", objectMapper.valueToTree(requestMap.get("request")));
                requestNode.set("employee", objectMapper.valueToTree(requestMap.get("employee")));
                requestsArrayNode.add(requestNode);
            }
            responseNode.put("status", "Requests retrieved");
            responseNode.set("requests", requestsArrayNode);
            responseNode.put("currentPage", currentPage);
            responseNode.put("totalPages", totalPages);
        } else {
        	ArrayNode requestsArrayNode = objectMapper.createArrayNode();
            responseNode.set("requests", requestsArrayNode);
            responseNode.put("currentPage", currentPage);
            responseNode.put("totalPages", totalPages);
        }

        return responseNode;
    }

    
    private JsonNode getRequestByEmployee(Map<String, Object> messageMap) {
        String employeeId = (String) messageMap.get("employee_id");
        int month = Integer.parseInt((String) messageMap.get("month"));
        int year = Integer.parseInt((String) messageMap.get("year"));
        int page = Integer.parseInt((String) messageMap.get("page"));

        Map<String, Object> resultMap = requestService.getRequestByEmployeeId(employeeId, month, year, page);

        ObjectNode responseNode = objectMapper.createObjectNode();

        List<Map<String, Object>> requests = (List<Map<String, Object>>) resultMap.get("requests");
        int currentPage = (Integer) resultMap.get("currentPage");
        int totalPages = (Integer) resultMap.get("totalPages");

        if (requests != null && !requests.isEmpty()) {
            ArrayNode requestsArrayNode = objectMapper.createArrayNode();

            for (Map<String, Object> requestMap : requests) {
                ObjectNode requestNode = objectMapper.createObjectNode();
                requestNode.set("request", objectMapper.valueToTree(requestMap.get("request")));
                requestNode.set("employee", objectMapper.valueToTree(requestMap.get("employee")));
                requestsArrayNode.add(requestNode);
            }

            responseNode.put("status", "Requests retrieved");
            responseNode.set("requests", requestsArrayNode);
            responseNode.put("currentPage", currentPage);
            responseNode.put("totalPages", totalPages);
        } else {
            ArrayNode requestsArrayNode = objectMapper.createArrayNode();

            responseNode.set("requests", requestsArrayNode);
            responseNode.put("currentPage", currentPage);
            responseNode.put("totalPages", totalPages);
        }

        return responseNode;
    }


    
    
    private JsonNode getRequestById(Map<String, Object> messageMap) {
        Object idValue = messageMap.get("id");

        Integer id;
        if (idValue instanceof Integer) {
            id = (Integer) idValue; 
        } else if (idValue instanceof String) {
            id = Integer.parseInt((String) idValue); 
        } else {
            throw new IllegalArgumentException("Invalid type for id: " + idValue.getClass().getName());
        }

        Optional<Map<String, Object>> requestOptional = requestService.getRequestById(id);

        ObjectNode responseNode = objectMapper.createObjectNode();

        if (requestOptional.isPresent()) {
            Map<String, Object> requestMap = requestOptional.get();

            JsonNode requestNode = objectMapper.valueToTree(requestMap.get("request"));
            JsonNode employeeNode = objectMapper.valueToTree(requestMap.get("employee"));

            responseNode.put("status", "Request retrieved");
            responseNode.set("request", requestNode);
            responseNode.set("employee", employeeNode);
        } else {
            responseNode.put("status", "Request not found");
        }

        return responseNode;
    }



    private JsonNode createRequestResponse(Map<String, Object> messageMap) {
        System.out.println("Message map: " + messageMap);

        @SuppressWarnings("unchecked")
        Map<String, Object> requestMap = (Map<String, Object>) messageMap.get("request");

        System.out.println("Request map: " + requestMap);

        RequestEntity request;
        try {
            request = fromJson(requestMap, RequestEntity.class);

            System.out.println("Request before save: " + request);

            request.setId(null);

            request.setStatus(RequestEntity.Status.PENDING);

            request.setApprover_id(null);
   
     

            request.setRequest_date(LocalDateTime.now());

            RequestEntity createdRequest = requestService.createRequest(request);
            System.out.println("Created request after save: " + createdRequest);

            return objectMapper.createObjectNode()
                    .put("status", "Request created")
                    .set("request", toJson(createdRequest));
        } catch (Exception e) {
            e.printStackTrace();
            
            return objectMapper.createObjectNode()
                    .put("status", "error")
                    .put("message", "Failed to create request: " + e.getMessage());
        }
    }



    private JsonNode updateRequestResponse(Map<String, Object> messageMap) {
        System.out.println("Message map: " + messageMap);

        @SuppressWarnings("unchecked")
        Map<String, Object> requestMap = (Map<String, Object>) messageMap.get("request");

        System.out.println("Request map: " + requestMap);

        RequestEntity request = fromJson(requestMap, RequestEntity.class);

        System.out.println("Request before update: " + request);

        RequestEntity updatedRequest = requestService.updateRequest(request);

        return objectMapper.createObjectNode()
                .put("status", "Request updated")
                .set("request", toJson(updatedRequest));
    }

    private JsonNode deleteRequestResponse(Map<String, Object> messageMap) {
        Object idValue = messageMap.get("id");

        Integer id;
        if (idValue instanceof Integer) {
            id = (Integer) idValue;
        } else if (idValue instanceof String) {
            id = Integer.parseInt((String) idValue);
        } else {
            throw new IllegalArgumentException("Invalid type for id: " + idValue.getClass().getName());
        }

        requestService.deleteRequest(id);
        return objectMapper.createObjectNode().put("status", "Request deleted");
    }


    private void sendResponse(JsonNode responseNode, String correlationId, String replyTo) throws JsonProcessingException {
        MessageProperties properties = new MessageProperties();
        properties.setCorrelationId(correlationId);
        Message responseMessage = new Message(objectMapper.writeValueAsBytes(responseNode), properties);
        rabbitTemplate.send(replyTo, responseMessage);
    }

    private JsonNode toJson(Object object) {
        return objectMapper.valueToTree(object);
    }

    private <T> T fromJson(Map<String, Object> map, Class<T> clazz) {
        return objectMapper.convertValue(map, clazz);
    }
}