package com.example.demo.request;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.repository.query.Param;

import java.time.LocalDate;
import java.time.LocalDateTime;
import java.util.List;
import java.util.Optional;

public interface RequestRepository extends JpaRepository<RequestEntity, Integer> {
	
	@Query("SELECT r FROM RequestEntity r WHERE r.employee_id = :employeeId ")
    List<RequestEntity> findByEmployee_id(        
    		@Param("employeeId") String employeeId
);


    @Query("SELECT r FROM RequestEntity r WHERE r.employee_id = :employeeId " +
           "AND FUNCTION('MONTH', r.request_date) = :month " +
           "AND FUNCTION('YEAR', r.request_date) = :year " +
           "AND r.request_type IN :requestTypes " +
           "ORDER BY r.request_date ASC")
    Page<RequestEntity> findByEmployeeIdAndRequestTypesAndMonthAndYear(
        @Param("employeeId") String employeeId,
        @Param("requestTypes") List<RequestEntity.RequestType> requestTypes,
        @Param("month") int month,
        @Param("year") int year,
        Pageable pageable
    );

    @Query("SELECT r FROM RequestEntity r WHERE r.employee_id = :employeeId " +
           "AND r.request_date BETWEEN :startDate AND :endDate " +
           "AND r.request_type NOT IN :excludedTypes " +
           "ORDER BY r.request_date ASC")
    Page<RequestEntity> findByEmployeeIdAndRequestDateBetweenAndExcludedTypes(
        @Param("employeeId") String employeeId,
        @Param("startDate") LocalDateTime startDate,
        @Param("endDate") LocalDateTime endDate,
        @Param("excludedTypes") List<RequestEntity.RequestType> excludedTypes,
        Pageable pageable
    );

    @Query("SELECT r FROM RequestEntity r WHERE r.employee_id = :employeeId " +
           "AND r.request_type = 'CHECK_IN' " +
           "AND DATE(r.request_date) = DATE(:currentDate)")
    List<RequestEntity> findCheckInsForToday(
        @Param("employeeId") String employeeId,
        @Param("currentDate") LocalDate currentDate
    );

    @Query("SELECT r FROM RequestEntity r WHERE r.employee_id = :employeeId " +
           "AND r.request_type = :requestType " +
           "AND r.request_date BETWEEN :startDate AND :endDate")
    List<RequestEntity> findByEmployeeIdAndRequestTypeAndRequestDate(
        @Param("employeeId") String employeeId,
        @Param("requestType") RequestEntity.RequestType requestType,
        @Param("startDate") LocalDateTime startDate,
        @Param("endDate") LocalDateTime endDate
    );
}
