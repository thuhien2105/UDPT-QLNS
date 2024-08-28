package com.example.demo.employee;


import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.example.demo.employee.config.JwtUtil;
import com.example.demo.employee.config.LoginResponse;


import java.awt.print.Pageable;
import java.util.List;
import java.util.Map;
import java.util.Optional;
import org.springframework.security.crypto.password.PasswordEncoder;
import org.springframework.data.domain.Page;
import org.springframework.data.domain.PageRequest;
import java.util.List;
import java.util.Optional;
import java.text.Normalizer;
import java.util.regex.Pattern;
import java.util.stream.Collectors;
import java.util.UUID;
import com.example.demo.employee.EmployeeDTO;

import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.security.core.AuthenticationException;
import org.springframework.security.core.userdetails.UsernameNotFoundException;
import java.util.HashMap;


@Service
public class EmployeeService {

    private static final CharSequence DEFAULT_PASSWORD = "Password123";



	@Autowired
    private EmployeeRepository employeeRepository;



    @Autowired
    private PasswordEncoder passwordEncoder;
    
    @Autowired
    private JwtUtil jwtUtil;
    


    public Optional<LoginResponse> login(String username, String password) {
        System.out.println("Username: " + username + ", Password: " + password);
        Optional<Employee> employeeOpt = employeeRepository.findByUsername(username);
        if (employeeOpt.isPresent()) {
            Employee employee = employeeOpt.get();
            if (passwordEncoder.matches(password, employee.getPassword())) {
                String accessToken = jwtUtil.generateToken(employee.getEmployeeId(), employee.getRole());
                
                String refreshToken = jwtUtil.generateRefreshToken(employee.getEmployeeId());
                
                LoginResponse loginResponse = new LoginResponse(employee, accessToken, refreshToken);
                return Optional.of(loginResponse);
            }
        }
        return Optional.empty();
    }



    public void logout(String username) {

    }
    
    
    
    public Map<String, Object> getAllEmployees(String keyword, int page) {
        PageRequest pageable = PageRequest.of(page - 1, 10);
        Page<Employee> employeePage;

        if (keyword == null || keyword.trim().isEmpty()) {
            employeePage = employeeRepository.findAll(pageable);
        } else {
            employeePage = employeeRepository.findByNameContainingIgnoreCase(keyword, pageable);
        }

        List<EmployeeDTO> employeeDTOs = employeePage.getContent().stream()
                .map(this::convertToDTO)
                .collect(Collectors.toList());

        Map<String, Object> response = new HashMap<>();
        response.put("employees", employeeDTOs);
        response.put("totalPages", employeePage.getTotalPages());
        response.put("totalElements", employeePage.getTotalElements());

        return response;
    }

    
    
    public Optional<EmployeeDTO> getEmployeeById(String id) {
        return employeeRepository.findById(id)
                .map(this::convertToDTO);
    }

    private String generateUsernameFromName(String name) {
        if (name == null) {
            return "";
        }
        String normalizedName = Normalizer.normalize(name, Normalizer.Form.NFD);
        Pattern diacriticPattern = Pattern.compile("\\p{M}");
        String username = diacriticPattern.matcher(normalizedName).replaceAll("");
        username = username.replaceAll("[^a-zA-Z0-9]", "").toLowerCase();
        return username;
    }

    public Employee createEmployee(Employee employee) {
        String newId = UUID.randomUUID().toString();
        employee.setEmployeeId(newId);

        String username = generateUsernameFromName(employee.getName());
        employee.setUsername(username);

        String encodedPassword = passwordEncoder.encode(DEFAULT_PASSWORD);
        employee.setPassword(encodedPassword);

        return employeeRepository.save(employee);
    }

    public Employee updateEmployee(Employee employee) {
        if (employee.getEmployeeId() == null || !employeeRepository.existsById(employee.getEmployeeId())) {
            throw new IllegalArgumentException("Employee with ID " + employee.getEmployeeId() + " does not exist.");
        }

        return employeeRepository.save(employee);
    }

    public boolean deleteEmployee(String id) {
        if (employeeRepository.existsById(id)) {
            employeeRepository.deleteById(id);
            return true;
        }
        return false;
    }
    public ResponseEntity<String> changePassword(String employeeId, String oldPassword, String newPassword) {
        try {
            Optional<Employee> employeeOpt = employeeRepository.findById(employeeId);
            if (employeeOpt.isPresent()) {
                Employee employee = employeeOpt.get();
                if (passwordEncoder.matches(oldPassword, employee.getPassword())) {
                    String encodedNewPassword = passwordEncoder.encode(newPassword);
                    employee.setPassword(encodedNewPassword);
                    employeeRepository.save(employee);
                    return ResponseEntity.ok("Password changed successfully.");
                } else {
                    return ResponseEntity.status(HttpStatus.BAD_REQUEST).body("Old password is incorrect.");
                }
            } else {
                return ResponseEntity.status(HttpStatus.NOT_FOUND).body("Employee with ID " + employeeId + " not found.");
            }
        } catch (Exception e) {
            return ResponseEntity.status(HttpStatus.INTERNAL_SERVER_ERROR).body("An error occurred while changing the password.");
        }
    }
    
    public boolean existsById(String id) {
        return employeeRepository.existsById(id);
    }

    private EmployeeDTO convertToDTO(Employee employee) {
        EmployeeDTO dto = new EmployeeDTO();
        dto.setEmployee_id(employee.getEmployeeId());
        dto.setName(employee.getName());
        dto.setDob(employee.getDob());
        dto.setAddress(employee.getAddress());
        dto.setEmail(employee.getEmail());
        dto.setPosition(employee.getPosition());
        dto.setPhone_number(employee.getPhoneNumber());
        dto.setTax_code(employee.getTaxCode());
        dto.setBank_account(employee.getBankAccount());
        dto.setIdentity_card(employee.getIdentityCard());
        dto.setRole(employee.getRole()); 
        return dto;
    }

}
