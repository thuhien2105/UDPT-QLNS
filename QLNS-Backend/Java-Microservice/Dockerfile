FROM openjdk:17-jdk-alpine

RUN apk add --no-cache maven

COPY . /usr/src/myapp

WORKDIR /usr/src/myapp

RUN mvn clean install

CMD ["java", "-jar", "target/myapp.jar"]

EXPOSE 8080
