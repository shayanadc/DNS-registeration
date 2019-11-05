Feature: Register New DNS Record

  In order to register new dns record

  As a user

  I allowed to save data for each


  @2
  Scenario: Register A New Record Type
    Given user "azar@example.com" with password "valid_password" has already registered
    And authenticate "azar@example.com"
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
    And dispatch an event from class "DomainResolverJob"

  @21
  Scenario: Does not Allow To Domains
    Given user "babak@example.com" with password "valid_password" has already registered
    When open "/v1/records" form
    And fill the form with:
      """
        {
          "domain_id": 1,
          "content" : "hash"
        }
      """
    And submit the form
    Then receive not ok
    And receive JSON response:
      """
         {
            "errors": [{"title": "Unauthorized"} ]
         }
      """

  @22
  Scenario: Register Duplicate Record Type For Domain
    Given user "babak@example.com" with password "valid_password" has already registered
    And authenticate "babak@example.com"
    And a domain with name "example.com"
    And a record with content "text1"
    When open "/v1/records" form
    And fill the form with:
      """
        {
          "domain_id": 1,
          "content" : "text1"
        }
      """
    And submit the form
    Then receive not ok
    And receive JSON response:
      """
         {
            "errors": [{"title": "Your Content For This Domain Is Not Unique."} ]
         }
      """