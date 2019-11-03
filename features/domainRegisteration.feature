Feature: Register New Domain

  In order to register new domain

  As a user

  I allowed to save data in storage


  @1
  Scenario: Register A New Domain

    Given user "azar@example.com" with password "valid_password" has already registered
    And authenticate "azar@example.com"
    When open "/v1/domains" form
    And fill the form with:
      """
        {
         "name" : "example.com",
         "approved" : true
        }
      """
    And submit the form
    Then receive ok
    And receive JSON response:
      """
        {
         "name": "example.com",
         "user_id" : 1,
         "approved" : false
        }
      """

  @11
  Scenario: Does not Allow To Domains
    Given user "babak@example.com" with password "valid_password" has already registered
    When open "/v1/domains" form
    And fill the form with:
      """
        {
         "name" : "example.com"
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