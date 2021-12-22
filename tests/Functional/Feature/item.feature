Feature:
  In order to prove that the status of the MS

  Scenario: Should create a valid item
    When I call "POST" "/api/v1/items" with body:
    """
    {
        "id" : "bf8cce2b-cda1-4237-9989-1f77c94df4f0",
        "image" : "http://test.test/image.jpg",
        "title" : "Title",
        "author" : "Author",
        "price"  : 10.00
    }
    """
    Then the status code should be 201

  Scenario: Should throw conflict exception when try create a valid item
    When I call "POST" "/api/v1/items" with body:
    """
    {
        "id" : "bf8cce2b-cda1-4237-9989-1f77c94df4f0",
        "image" : "http://test.test/image.jpg",
        "title" : "Title Title",
        "author" : "Author",
        "price"  : 10.00
    }
    """
    Then the status code should be 409

  Scenario: Should throw invalid argument exception when try create a valid item
    When I call "POST" "/api/v1/items" with body:
    """
    {
        "image" : "http://test.test/image.jpg",
        "title" : "Title Title",
        "author" : "Author",
        "price"  : 10.00
    }
    """
    Then the status code should be 400

  Scenario: Should get a items
    When I call "GET" "/api/v1/items"
    Then the status code should be 200

  Scenario: Should get a item
    When I call "GET" "/api/v1/items/bf8cce2b-cda1-4237-9989-1f77c94df4f0"
    Then the status code should be 200

  Scenario: Should throw exception when try get item
    When I call "GET" "/api/v1/items/bf8cce2b-cda1-4237-9989-1f77c94df4f1"
    Then the status code should be 404
