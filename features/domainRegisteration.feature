Feature: Register New Domain

  In order to register new domain

  As a user

  I allowed to save data in storage


  @1
  Scenario: Register A New Domain

    Given a user
    When open "/v1/domains" form
    And fill the form with:
      """
        {
         "name" : "example.com"
        }
      """
    And submit the form
    Then receive ok
    And receive JSON response:
      """
        {
         "name": "example.com"
        }
      """

  @3
  Scenario: Get All Domain

    Given a user
    And a domain with name "example.com"
    And a record with content "hash"
    And a domain with name "example2.com"
    And a record with content "text1"
    And a record with content "text2"
    When open "/v1/domains" form
    And submit the page
    Then receive ok
    And receive JSON response:
      """
        [{
          "id":1,"name":"example.com","approved" : false,
          "records":
            [{"id":1,"domain_id":"1","content":"hash"}]
         },
          {
          "id":2,"name":"example2.com", "approved" : false,
          "records":
            [
            {"id":2,"domain_id":"2","content":"text1"},
            {"id":3,"domain_id":"2","content":"text2"}
            ]
         }
         ]
      """