package com.example.demo.request;

import com.fasterxml.jackson.databind.JsonNode;
import com.fasterxml.jackson.databind.ObjectMapper;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

@Service
public class RequestService {

    @Autowired
    private RequestRepository requestRepository;

    @Autowired
    private ObjectMapper objectMapper;

    public RequestEntity saveRequest(String action, JsonNode payload) {
        RequestEntity requestEntity = new RequestEntity();
        requestEntity.setAction(action);
        requestEntity.setPayload(payload.toString());
        return requestRepository.save(requestEntity);
    }

    public void updateResponse(Long requestId, JsonNode response) {
        RequestEntity requestEntity = requestRepository.findById(requestId).orElseThrow(() -> new RuntimeException("Request not found"));
        requestEntity.setResponse(response.toString());
        requestRepository.save(requestEntity);
    }

}
