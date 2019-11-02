Feature: Register New User Account

  In order to register account

  As a user

  I allowed to login as a member


  @6
  Scenario: Register A New Account

    Given fake user token with "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFk"
    When open "/v1/users" form
    And fill the form with:
      """
       {
        "email" : "azar@email.com",
        "password": "password",
        "password_confirmation" : "password"
      }
        """
    And submit the form
    Then receive ok
    And receive JSON response:
        """
        {
          "id" : 1,
          "email" : "azar@email.com",
          "api_token": "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFk"
        }
        """

  @61
  Scenario: Does not Allow to Register A New Account

    Given fake user token with "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFk"
    And user "parisa@example.com" with password "valid_password" has already registered
    When open "/v1/users" form
    And fill the form with:
      """
       {
        "email" : "parisa@example.com",
        "password": "password1",
        "password_confirmation" : "password2"
      }
        """
    And submit the form
    Then receive not ok
    And receive JSON response:
        """
          {
        "errors": [
            {
             "title": "The email has already been taken.",
            "source": {
            "parameter": "email"
            }
            },
           {
           "title": "The password confirmation does not match.",
            "source": {
              "parameter": "password"
              }
          }
          ]
        }
        """