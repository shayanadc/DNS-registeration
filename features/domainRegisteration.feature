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