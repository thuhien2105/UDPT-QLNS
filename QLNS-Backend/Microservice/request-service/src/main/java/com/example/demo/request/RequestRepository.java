package com.example.demo.request;

import org.springframework.data.repository.CrudRepository;
import org.springframework.data.domain.Pageable;
import org.springframework.data.domain.Page;

import java.time.LocalDateTime;
import java.util.List;
import java.util.Optional;


public interface RequestRepository extends CrudRepository<RequestEntity, Integer> {
    List<RequestEntity> findByEmployeeId(String employeeId);
    Optional<RequestEntity> findByEmployeeIdAndRequestDate(String employeeId, LocalDateTime requestDate);
    Page<RequestEntity> findByEmployeeIdAndRequestDateBetween(String employeeId, LocalDateTime startDate, LocalDateTime endDate, Pageable pageable);

    Page<RequestEntity> findByEmployeeIdAndRequestTypeInAndRequestDateBetween(String employeeId, List<RequestEntity.RequestType> requestTypes, LocalDateTime startDate, LocalDateTime endDate, Pageable pageable);
}
