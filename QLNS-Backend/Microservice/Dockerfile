FROM openjdk:17-jdk-alpine

RUN apk add --no-cache maven

WORKDIR /usr/src/Java-Microservice

COPY Java-Microservice/pom.xml /usr/src/Java-Microservice/
COPY Java-Microservice/src /usr/src/Java-Microservice/src

RUN mvn clean install

CMD ["java", "-jar", "target/Java-Microservice-0.0.1-SNAPSHOT.jar"]

EXPOSE 8080
