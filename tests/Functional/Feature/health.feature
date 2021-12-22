Feature:
  In order to prove that the status of the MS

  Scenario: It receives a success response from status endpoint
    When I call "GET" "/health"
    Then the status code should be 200
