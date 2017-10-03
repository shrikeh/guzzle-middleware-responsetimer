Feature: logging response times
  In order to gauge the performance of my application
  As a developer
  I need to record response times for outbound HTTP requests

  Scenario: Logging response times for a single call
    Given that I have an external service
    When I make an outbound HTTP request to it
    Then the response time duration is logged to the logger
