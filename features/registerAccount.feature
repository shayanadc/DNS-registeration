Feature: Register New User Account

  In order to register account

  As a user

  I allowed to login as a member


  @7
  Scenario: Register A New Account

    Given a user
    When open "/v1/users" form
    And fill the form with:
      """
       {
        "email" : "example@email.com",
        "password: "password"
      }
        """
    And submit the form
    Then receive ok
    And receive JSON response:
        """
        {
          "email" : "example@email.com"
        }
        """