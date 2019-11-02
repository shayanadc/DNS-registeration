Feature: Login

  In order to login

  As a member

  I allowed to access to api

  @5
  Scenario: successful login
    Given fake user token with "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFk"
    And user "azar@example.com" with password "valid_password" has already registered
    When open "/v1/login" form
    And fill the form with:
    """
      {
        "email" : "azar@example.com",
        "password" : "valid_password"
      }
     """
    And submit the form
    Then receive ok
    And receive JSON response:
    """
        {
          "token": "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFk"
        }
    """