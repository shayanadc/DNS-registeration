Feature: Register New DNS Record

  In order to register new dns record

  As a user

  I allowed to save data for each


  @2
  Scenario: Register A New Record Type

    Given a user
    And a domain with name "example.com"
    When open "/v1/records" form
    And fill the form with:
      """
        {
          "domain_id": 1,
          "content" : "hash"
        }
      """
    And submit the form
    Then receive ok
    And receive JSON response:
      """
        {
         "domain_id" : 1,
         "content": "hash"
        }
      """