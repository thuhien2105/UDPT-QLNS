FROM maven:3.8.4-openjdk-17 AS build

WORKDIR /app

COPY Microservice/employee-service/pom.xml .
COPY Microservice/employee-service/src ./src

RUN mvn clean package

FROM openjdk:17-jdk-slim

WORKDIR /app

COPY --from=build /app/target/employee-service-0.0.1-SNAPSHOT.jar app.jar

EXPOSE 8080

ENTRYPOINT ["java", "-jar", "app.jar"]
