package com.example.demo.request;

import com.example.demo.request.RequestService;
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
import org.springframework.web.bind.annotation.*;

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
            case "get_all":

                return toJson(requestService.getAllRequests());
            case "get":
                return getRequestById(messageMap);
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

        Optional<RequestEntity> request = requestService.getRequestById(id);

        ObjectNode responseNode = objectMapper.createObjectNode();
        responseNode.put("status", "Request retrieved");

        if (request.isPresent()) {
            JsonNode requestNode = objectMapper.valueToTree(request.get());
            responseNode.set("request", requestNode);
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

        RequestEntity request = fromJson(requestMap, RequestEntity.class);

        System.out.println("Request before save: " + request);

        request.setId(null);

        RequestEntity createdRequest = requestService.createRequest(request);
        System.out.println("Created request after save: " + createdRequest);

        return objectMapper.createObjectNode()
                .put("status", "Request created")
                .set("request", toJson(createdRequest));
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
