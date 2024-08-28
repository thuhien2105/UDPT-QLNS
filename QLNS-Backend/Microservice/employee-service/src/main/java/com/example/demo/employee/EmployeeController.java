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
import java.util.List;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;

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
            System.out.println(action);

            JsonNode responseNode = handleAction(action, messageMap);
            sendResponse(responseNode, correlationId, replyTo);
        } catch (Exception e) {
            e.printStackTrace();
            try {
                sendErrorResponse(e, correlationId, replyTo);
            } catch (JsonProcessingException jsonEx) {
                jsonEx.printStackTrace();
            }
        }
    }

    private JsonNode handleAction(String action, Map<String, Object> messageMap) {
        switch (action) {
            case "login":
                return loginEmployee(messageMap);
            case "logout":
                return logoutEmployee(messageMap);
            case "change-password":
                return changePassword(messageMap);
            case "get_all":
                return getEmployees(messageMap);
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

    private JsonNode changePassword(Map<String, Object> messageMap) {
        String employeeId = (String) messageMap.get("employee_id");
        String oldPassword = (String) messageMap.get("old_password");
        String newPassword = (String) messageMap.get("new_password");

        try {
        	ResponseEntity<String> response = employeeService.changePassword(employeeId, oldPassword, newPassword);
            if (response.getStatusCode() == HttpStatus.OK) {
                return objectMapper.createObjectNode()
                        .put("status", "Password changed successfully");
            } else {
                return objectMapper.createObjectNode()
                        .put("status", "Failed to change password")
                        .put("error", response.getBody());
            }
        } catch (Exception e) {
            return objectMapper.createObjectNode()
                    .put("status", "Error")
                    .put("error", e.getMessage());
        }
    }

    private JsonNode getEmployees(Map<String, Object> messageMap) {
        String keyword = (String) messageMap.get("keyword");
        String pageStr = messageMap.get("page").toString();
        int page = Integer.parseInt(pageStr);

        try {
            Map<String, Object> employeeData = employeeService.getAllEmployees(keyword, page);

            ObjectNode responseNode = objectMapper.createObjectNode();
            responseNode.put("status", "Employees retrieved");
            responseNode.set("employees", toJson(employeeData.get("employees")));
            responseNode.put("totalPages", (Integer) employeeData.get("totalPages"));
            responseNode.put("totalElements", (Long) employeeData.get("totalElements"));

            return responseNode;
        } catch (Exception e) {
            return objectMapper.createObjectNode()
                    .put("status", "Error retrieving employees")
                    .put("error", e.getMessage());
        }
    }


    private JsonNode loginEmployee(Map<String, Object> messageMap) {
        String username = (String) messageMap.get("username");
        String password = (String) messageMap.get("password");

        try {
            Optional<LoginResponse> employeeOpt = employeeService.login(username, password);

            if (employeeOpt.isPresent()) {
                return objectMapper.createObjectNode()
                        .put("status", "Login successful")
                        .set("employee", toJson(employeeOpt.get()));
            } else {
                return objectMapper.createObjectNode().put("status", "Invalid credentials").put("error", "Invalid credentials");
            }
        } catch (Exception e) {
            return objectMapper.createObjectNode()
                    .put("status", "Error during login")
                    .put("error", e.getMessage());
        }
    }

    private JsonNode logoutEmployee(Map<String, Object> messageMap) {
        String username = (String) messageMap.get("username");

        try {
            employeeService.logout(username);
            return objectMapper.createObjectNode().put("status", "Logout successful");
        } catch (Exception e) {
            return objectMapper.createObjectNode()
                    .put("status", "Error during logout")
                    .put("error", e.getMessage());
        }
    }

    private JsonNode getEmployeeById(Map<String, Object> messageMap) {
        Object idValue = messageMap.get("employee_id");

        String id;
        if (idValue instanceof String) {
            id = (String) idValue;
        } else {
            return objectMapper.createObjectNode()
                    .put("status", "Error")
                    .put("error", "Invalid type for id: " + idValue.getClass().getName());
        }

        try {
            Optional<EmployeeDTO> employee = employeeService.getEmployeeById(id);
            ObjectNode responseNode = objectMapper.createObjectNode().put("status", "Employee retrieved");

            if (employee.isPresent()) {
                JsonNode employeeNode = objectMapper.valueToTree(employee.get());
                responseNode.set("employee", employeeNode);
            } else {
                responseNode.put("status", "Employee not found");
            }

            return responseNode;
        } catch (Exception e) {
            return objectMapper.createObjectNode()
                    .put("status", "Error retrieving employee")
                    .put("error", e.getMessage());
        }
    }

    private JsonNode createEmployeeResponse(Map<String, Object> messageMap) {
        System.out.println("Message map: " + messageMap);

        Map<String, Object> employeeMap = (Map<String, Object>) messageMap.get("employee");
        System.out.println("Employee map: " + employeeMap);

        try {
            Employee employee = fromJson(employeeMap, Employee.class);
            System.out.println("Employee before save: " + employee);

            employee.setEmployeeId(null);
            Employee createdEmployee = employeeService.createEmployee(employee);
            System.out.println("Created employee after save: " + createdEmployee);

            return objectMapper.createObjectNode()
                    .put("status", "Employee created")
                    .set("employee", toJson(createdEmployee));
        } catch (Exception e) {
            return objectMapper.createObjectNode()
                    .put("status", "Error creating employee")
                    .put("error", e.getMessage());
        }
    }

    private JsonNode updateEmployeeResponse(Map<String, Object> messageMap) {
        System.out.println("Message map: " + messageMap);

        Map<String, Object> employeeMap = (Map<String, Object>) messageMap.get("employee");
        System.out.println("Employee map: " + employeeMap);

        try {
            Employee employee = fromJson(employeeMap, Employee.class);
            System.out.println("Employee before update: " + employee);

            Employee updatedEmployee = employeeService.updateEmployee(employee);
            return objectMapper.createObjectNode()
                    .put("status", "Employee updated")
                    .set("employee", toJson(updatedEmployee));
        } catch (Exception e) {
            return objectMapper.createObjectNode()
                    .put("status", "Error updating employee")
                    .put("error", e.getMessage());
        }
    }

    private JsonNode deleteEmployeeResponse(Map<String, Object> messageMap) {
        Object idValue = messageMap.get("employee_id");

        String id;
        if (idValue instanceof String) {
            id = (String) idValue;
        } else {
            return objectMapper.createObjectNode()
                    .put("status", "Error")
                    .put("error", "Invalid type for id: " + idValue.getClass().getName());
        }

        try {
            employeeService.deleteEmployee(id);
            return objectMapper.createObjectNode().put("status", "Employee deleted");
        } catch (Exception e) {
            return objectMapper.createObjectNode()
                    .put("status", "Error deleting employee")
                    .put("error", e.getMessage());
        }
    }

    private void sendResponse(JsonNode responseNode, String correlationId, String replyTo) throws JsonProcessingException {
        MessageProperties properties = new MessageProperties();
        properties.setCorrelationId(correlationId);
        Message responseMessage = new Message(objectMapper.writeValueAsBytes(responseNode), properties);
        rabbitTemplate.send(replyTo, responseMessage);
    }

    private void sendErrorResponse(Exception e, String correlationId, String replyTo) throws JsonProcessingException {
        ObjectNode errorNode = objectMapper.createObjectNode()
                .put("status", "Error")
                .put("error", e.getMessage());

        MessageProperties properties = new MessageProperties();
        properties.setCorrelationId(correlationId);
        Message responseMessage = new Message(objectMapper.writeValueAsBytes(errorNode), properties);
        rabbitTemplate.send(replyTo, responseMessage);
    }

    private JsonNode toJson(Object object) {
        return objectMapper.valueToTree(object);
    }

    private <T> T fromJson(Map<String, Object> map, Class<T> clazz) {
        return objectMapper.convertValue(map, clazz);
    }
}
