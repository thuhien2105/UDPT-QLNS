package com.example.demo.request;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import com.fasterxml.jackson.databind.node.ObjectNode;
import org.springframework.amqp.core.Message;
import org.springframework.amqp.core.MessageProperties;
import org.springframework.amqp.rabbit.annotation.RabbitListener;
import org.springframework.amqp.rabbit.core.RabbitTemplate;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Component;

import java.util.Map;
import java.util.Optional;
import java.util.UUID;
import java.util.concurrent.ConcurrentHashMap;

@Component
public class RequestController {

    @Autowired
    private RabbitTemplate rabbitTemplate;

    @Autowired
    private ObjectMapper objectMapper;

    private final Map<String, JsonNode> responseCache = new ConcurrentHashMap<>();

    @RabbitListener(queues = "topic-request")
    public void handleRequest(Message message) {
        try {
            JsonNode requestNode = objectMapper.readTree(message.getBody());
            String action = requestNode.get("action").asText();
            String correlationId = message.getMessageProperties().getCorrelationId();
            String replyTo = message.getMessageProperties().getReplyTo();

            JsonNode responseNode = handleAction(action, requestNode);

            sendResponse(responseNode, correlationId, replyTo);
        } catch (JsonProcessingException e) {
            e.printStackTrace();
        }
    }

    private JsonNode handleAction(String action, JsonNode requestNode) {
        switch (action) {
            case "get_all":
                return toJson(employeeService.getAllEmployees());
            case "get":
                return getEmployeeById(requestNode);
            case "create":
                return createEmployeeResponse(requestNode);
            case "update":
                return updateEmployeeResponse(requestNode);
            case "delete":
                return deleteEmployeeResponse(requestNode);
            default:
                return objectMapper.createObjectNode().put("status", "Unknown action: " + action);
        }
    }

    private JsonNode getEmployeeById(JsonNode requestNode) {
        Long id = requestNode.get("id").asLong();
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

    private JsonNode createEmployeeResponse(JsonNode requestNode) {
        JsonNode employeeNode = requestNode.get("employee");
        Employee employee = fromJson(employeeNode, Employee.class);
        employee.setId(null);
        Employee createdEmployee = employeeService.createEmployee(employee);

        return objectMapper.createObjectNode()
                .put("status", "Employee created")
                .set("employee", toJson(createdEmployee));
    }

    private JsonNode updateEmployeeResponse(JsonNode requestNode) {
        JsonNode employeeNode = requestNode.get("employee");
        Employee employee = fromJson(employeeNode, Employee.class);
        Employee updatedEmployee = employeeService.updateEmployee(employee);

        return objectMapper.createObjectNode()
                .put("status", "Employee updated")
                .set("employee", toJson(updatedEmployee));
    }

    private JsonNode deleteEmployeeResponse(JsonNode requestNode) {
        Long id = requestNode.get("id").asLong();
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

    private <T> T fromJson(JsonNode node, Class<T> clazz) {
        return objectMapper.convertValue(node, clazz);
    }
}
