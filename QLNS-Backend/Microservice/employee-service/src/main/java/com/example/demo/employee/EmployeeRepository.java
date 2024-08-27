package com.example.demo.employee;

import org.springframework.data.domain.Page;
import org.springframework.data.domain.Pageable;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;
import java.util.Optional;

@Repository
public interface EmployeeRepository extends JpaRepository<Employee, String> {
    Optional<Employee> findByUsername(String username);

    List<Employee> findByNameContainingIgnoreCase(String keyword);
    
    Page<Employee> findByNameContainingIgnoreCase(String keyword, Pageable pageable);
}
