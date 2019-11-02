Feature: Register New User Account

  In order to register account

  As a user

  I allowed to login as a member


  @6
  Scenario: Register A New Account

    Given a user
    And fake user token with "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFk"
    When open "/v1/users" form
    And fill the form with:
      """
       {
        "email" : "example@email.com",
        "password": "password"
      }
        """
    And submit the form
    Then receive ok
    And receive JSON response:
        """
        {
          "id" : 1,
          "email" : "example@email.com",
          "api_token": "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFk"
        }
        """