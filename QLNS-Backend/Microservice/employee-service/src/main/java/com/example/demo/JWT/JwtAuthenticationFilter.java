package com.example.demo.JWT;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.core.context.SecurityContextHolder;
import org.springframework.security.authentication.UsernamePasswordAuthenticationToken;
import org.springframework.web.filter.OncePerRequestFilter;

import javax.servlet.FilterChain;
import javax.servlet.ServletException;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import java.io.IOException;
import java.util.ArrayList;
import io.jsonwebtoken.Claims;

import com.example.demo.employee.config.JwtUtil;

public class JwtAuthenticationFilter extends OncePerRequestFilter {

    @Autowired
    private JwtUtil jwtUtil;

    private String getTokenFromRequest(jakarta.servlet.http.HttpServletRequest request) {
        String header = request.getHeader("Authorization");
        if (header != null && header.startsWith("Bearer ")) {
            return header.substring(7); 
        }
        return null;
    }

	@Override
	protected void doFilterInternal(jakarta.servlet.http.HttpServletRequest request,
			jakarta.servlet.http.HttpServletResponse response, jakarta.servlet.FilterChain filterChain)
			throws jakarta.servlet.ServletException, IOException {
		  try {
		        String token = getTokenFromRequest(request);

		        if (token != null && jwtUtil.validateToken(token)) {
		            Claims claims = jwtUtil.parseToken(token);
		            String idEmployee = claims.getSubject();
		            String role = (String) claims.get("role"); 

		            UsernamePasswordAuthenticationToken authentication = new UsernamePasswordAuthenticationToken(
		                    idEmployee, null, new ArrayList<>());
		            SecurityContextHolder.getContext().setAuthentication(authentication);
		        }

		        filterChain.doFilter(request, response);

		    } catch (Exception e) {
		        e.printStackTrace();

		        response.setStatus(HttpServletResponse.SC_UNAUTHORIZED);
		        response.getWriter().write("Unauthorized: Invalid or missing token");
		        response.getWriter().flush();
		    }
		}
}