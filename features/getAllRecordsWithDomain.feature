Feature: Get All Domains

  In order to see all domains

  As a user

  I allowed to see grid view

  @8
  Scenario: Get All Records

    Given user "azar@example.com" with password "valid_password" has already registered
    And authenticate "azar@example.com"
    And a domain with name "example.com"
    And a record with content "hash"
    And a domain with name "example2.com"
    And a record with content "text1"
    And a record with content "text2"
    And a domain with name "example3.com"
    When open "/v1/records" form
    And submit the page
    Then receive ok
    And receive JSON response:
      """
      [{"id":1,"domain_id":"1","content":"hash",
      "domain":
      {"id":1,"name":"example.com","user_id":1,"approved":false}},
      {"id":2,"domain_id":"2","content":"text1",
      "domain":
      {"id":2,"name":"example2.com","user_id":1,"approved":false}},
      {"id":3,"domain_id":"2","content":"text2","domain":{"id":2,"name":"example2.com","user_id":1,"approved":false}}]

      """
  @81
  Scenario: Does not Allow To Domains
    Given user "babak@example.com" with password "valid_password" has already registered
    When open "/v1/records" form
    And submit the page
    Then receive not ok
    And receive JSON response:
      """
        {
          "errors": [
                {"title": "Unauthorized" }
              ]
            }
      """