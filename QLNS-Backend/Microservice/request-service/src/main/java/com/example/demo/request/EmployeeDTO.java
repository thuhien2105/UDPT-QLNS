package com.example.demo.request;
import com.example.demo.GRPC.EmployeeProto.Employee;
import com.example.demo.GRPC.EmployeeProto.EmployeeResponse;

public class EmployeeDTO {
	private String employee_id;
    private String name;  
    public EmployeeDTO(EmployeeResponse employee) {
        this.employee_id = employee.getEmployee().getEmployeeId();
        this.name = employee.getEmployee().getName();
    }
    public String getEmployee_id() {
        return employee_id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public void setEmployee_id(String id) {
        this.employee_id = id;
    }
}
