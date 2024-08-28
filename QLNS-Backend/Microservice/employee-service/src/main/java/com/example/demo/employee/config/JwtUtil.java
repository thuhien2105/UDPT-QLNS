package com.example.demo.employee.config;

import java.util.Date;
import javax.crypto.spec.SecretKeySpec;
import java.security.Key;

import org.springframework.stereotype.Component;

import com.example.demo.employee.Employee.Role;

import io.jsonwebtoken.Claims;
import io.jsonwebtoken.Jwts;
import io.jsonwebtoken.SignatureAlgorithm;

@Component
public class JwtUtil {

    private String secretKey = "ungdungphantan_hcmus_20clcbytranthuhien"; 
    private long validityInMilliseconds = 86400000; 

    public String generateToken(String idEmployee, Role role) {
        Claims claims = Jwts.claims().setSubject(idEmployee);
        claims.put("role", role);
        Date now = new Date();
        Date validity = new Date(now.getTime() + validityInMilliseconds);

        Key key = new SecretKeySpec(secretKey.getBytes(), SignatureAlgorithm.HS256.getJcaName());

        return Jwts.builder()
                .setClaims(claims)
                .setIssuedAt(now)
                .setExpiration(validity)
                .signWith(key)
                .compact();
    }

    public Claims parseToken(String token) {
        return Jwts.parserBuilder()
                .setSigningKey(secretKey.getBytes())
                .build()
                .parseClaimsJws(token)
                .getBody();
    }

    public boolean validateToken(String token) {
        Claims claims = parseToken(token);
        return claims.getExpiration().after(new Date());
    }

    public String getIdEmployeeFromToken(String token) {
        Claims claims = parseToken(token);
        return claims.getSubject();
    }
}
