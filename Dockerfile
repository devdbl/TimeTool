FROM openjdk:14-jdk-alpine
HEALTHCHECK --interval=10s --timeout=10s --start-period=10s --retries=3 \
CMD curl --fail localhost:8080/employeesfail || exit 1
RUN addgroup -S spring && adduser -S spring -G spring
USER spring:spring
ARG JAR_FILE=build/libs/*.jar
COPY ${JAR_FILE} app.jar
ENTRYPOINT ["java","-jar","/app.jar"]