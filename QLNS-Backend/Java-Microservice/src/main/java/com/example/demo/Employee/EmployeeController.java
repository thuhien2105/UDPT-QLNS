package com.example.demo.Employee;

import com.fasterxml.jackson.core.JsonProcessingException;
import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
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

@RestController
@RequestMapping("/employees")
public class EmployeeController {

    @Autowired
    private EmployeeService employeeService;

    @Autowired
    private RabbitTemplate rabbitTemplate;

    @Autowired
    private ObjectMapper objectMapper;

    @RabbitListener(queues = "topic-employees")
    public void handleResponse(Message message, @Header(AmqpHeaders.CORRELATION_ID) String correlationId,
                               @Header(AmqpHeaders.REPLY_TO) String replyTo) {
        try {
            Map<String, Object> messageMap = extractMessageMap(message);
            String action = (String) messageMap.get("action");

            JsonNode responseNode = handleAction(action, messageMap);
            sendResponse(responseNode, correlationId, replyTo);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }

    private JsonNode handleAction(String action, Map<String, Object> messageMap) {
        switch (action) {
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
    private JsonNode getEmployeeById(Map<String, Object> messageMap) {
        Long id = ((Integer) messageMap.get("id")).longValue();
        
        Optional<Employee> employee = employeeService.getEmployeeById(id);
        
        return objectMapper.createObjectNode()
                .put("status", "Employee retrieved")
                .set("employee", toJson(employee));
    }

    private JsonNode createEmployeeResponse(Map<String, Object> messageMap) {
        Employee employee = fromJson((Map<String, Object>) messageMap.get("employee"), Employee.class);
        Employee createdEmployee = employeeService.createEmployee(employee);
        return objectMapper.createObjectNode()
                .put("status", "Employee created")
                .set("employee", toJson(createdEmployee));
    }

    private JsonNode updateEmployeeResponse(Map<String, Object> messageMap) {
        Long id = ((Integer) messageMap.get("id")).longValue();
        Employee employee = fromJson((Map<String, Object>) messageMap.get("employee"), Employee.class);
        employee.setEmployeeId(id);
        Employee updatedEmployee = employeeService.updateEmployee(id, employee);
        return objectMapper.createObjectNode()
                .put("status", "Employee updated")
                .set("employee", toJson(updatedEmployee));
    }

    private JsonNode deleteEmployeeResponse(Map<String, Object> messageMap) {
        Long id = ((Integer) messageMap.get("id")).longValue();

        employeeService.deleteEmployee(id);
        return objectMapper.createObjectNode().put("status", "Employee deleted");
    }

    
    
    private Map<String, Object> extractMessageMap(Message message) {
        try {
            return objectMapper.readValue(new String(message.getBody()), Map.class);
        } catch (Exception e) {
            throw new RuntimeException("Failed to parse message", e);
        }
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
