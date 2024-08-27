package com.example.demo.employee;

import com.example.demo.employee.EmployeeService;
import com.example.demo.employee.config.LoginResponse;
import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ObjectNode;

import org.springframework.amqp.core.Message;
import org.springframework.amqp.core.MessageProperties;
import org.springframework.amqp.rabbit.annotation.RabbitListener;
import org.springframework.amqp.rabbit.core.RabbitTemplate;
import org.springframework.amqp.support.AmqpHeaders;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.messaging.handler.annotation.Header;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.Map;
import java.util.Optional;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.RequestParam;

import java.util.HashMap;


@RestController
@RequestMapping("/employees")
public class EmployeeController {

    @Autowired
    private EmployeeService employeeService;

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
    
    
    @RabbitListener(queues = "topic-employees")
    public void handleResponse(Message message, @Header(AmqpHeaders.CORRELATION_ID) String correlationId,
                               @Header(AmqpHeaders.REPLY_TO) String replyTo) {
        try {
            Map<String, Object> messageMap = extractMessageMap(message);
            String action = (String) messageMap.get("action");
            System.out.println( action);

            JsonNode responseNode = handleAction(action, messageMap);
            sendResponse(responseNode, correlationId, replyTo);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private JsonNode handleAction(String action, Map<String, Object> messageMap) {

        switch (action) {
   
        case "login":
            return loginEmployee(messageMap);
        case "logout":
            return logoutEmployee(messageMap);
        		
            case "get_all":
                return toJson(employeeService.getAllEmployees());
            case "get":
                return getEmployeeById(messageMap);
            case "create":
                return createEmployeeResponse(messageMap);
            case "update":
                return updateEmployeeResponse(messageMap);
            case "delete":
                return deleteEmployeeResponse(messageMap);
            default:
                return objectMapper.createObjectNode().put("status", "Unknown action: " + action);
        }
    }

    private JsonNode loginEmployee(Map<String, Object> messageMap) {
        String username = (String) messageMap.get("username");
        String password = (String) messageMap.get("password");

        Optional<LoginResponse> employeeOpt = employeeService.login(username, password);

        if (employeeOpt.isPresent()) {
            return objectMapper.createObjectNode()
                    .put("status", "Login successful")
                    .set("employee", toJson(employeeOpt.get()));
        } else {
            return objectMapper.createObjectNode().put("status", "Invalid credentials");
        }
    }

    private JsonNode logoutEmployee(Map<String, Object> messageMap) {
        String username = (String) messageMap.get("username");
        employeeService.logout(username);
        return objectMapper.createObjectNode().put("status", "Logout successful");
    }
    
    private JsonNode getEmployeeById(Map<String, Object> messageMap) {
        Object idValue = messageMap.get("id");

        String id;
        if (idValue instanceof String) {
            id = (String) idValue;
        } else {
            throw new IllegalArgumentException("Invalid type for id: " + idValue.getClass().getName());
        }

        Optional<Employee> employee = employeeService.getEmployeeById(id);

        ObjectNode responseNode = objectMapper.createObjectNode();
        responseNode.put("status", "Employee retrieved");
        
        if (employee.isPresent()) {
            JsonNode employeeNode = objectMapper.valueToTree(employee.get());
            responseNode.set("employee", employeeNode);
        } else {
            responseNode.put("status", "Employee not found");
        }
        
        return responseNode;
    }

    
    
    
    
    private JsonNode createEmployeeResponse(Map<String, Object> messageMap) {
        System.out.println("Message map: " + messageMap);

        Map<String, Object> employeeMap = (Map<String, Object>) messageMap.get("employee");

        System.out.println("Employee map: " + employeeMap);

        Employee employee = fromJson(employeeMap, Employee.class);

        System.out.println("Employee before save: " + employee);

        employee.setId(null);

        Employee createdEmployee = employeeService.createEmployee(employee);
        System.out.println("Created employee after save: " + createdEmployee);

        return objectMapper.createObjectNode()
                .put("status", "Employee created")
                .set("employee", toJson(createdEmployee));
    }

    
    
    private JsonNode updateEmployeeResponse(Map<String, Object> messageMap) {
        System.out.println("Message map: " + messageMap);

        Map<String, Object> employeeMap = (Map<String, Object>) messageMap.get("employee");

        System.out.println("Employee map: " + employeeMap);

        Employee employee = fromJson(employeeMap, Employee.class);

        System.out.println("Employee before update: " + employee);

        Employee updatedEmployee = employeeService.updateEmployee(employee);

        return objectMapper.createObjectNode()
                .put("status", "Employee updated")
                .set("employee", toJson(updatedEmployee));
    }


    private JsonNode deleteEmployeeResponse(Map<String, Object> messageMap) {
        Object idValue = messageMap.get("id");

        String id;
        if (idValue instanceof String) {
            id = (String) idValue;
        } else {
            throw new IllegalArgumentException("Invalid type for id: " + idValue.getClass().getName());
        }

        employeeService.deleteEmployee(id);
        return objectMapper.createObjectNode().put("status", "Employee deleted");
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
