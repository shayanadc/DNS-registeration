Feature: get current user
  In order to see my profile
  As a member
  I want to see the current user info
  @4
Scenario: fetch current user info successfully
  Given fake user token with "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFkBohA223"
  And user "azar@example.com" with password "valid_password" has already registered
  And authenticate "azar@example.com"
  And a domain with name "example.com"
  And a record with content "hash"
  And a domain with name "example2.com"
  When open "/v1/users/current" form
  And submit the page
  Then receive ok
  And receive JSON response:
        """
        {
          "id" : 1,
          "email" : "azar@example.com",
          "api_token": "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFkBohA223",
          "domains" : [{"id" :1, "name" : "example.com", "approved": false, "user_id" :1}]
        }
       """

  @41
  Scenario: fetch current user info unsuccessfully
    Given fake user token with "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFkBohA223"
    And user "azar@example.com" with password "valid_password" has already registered
    When open "/v1/users/current" form
    And submit the page
    Then receive not ok
    And receive JSON response:
        """
         {
            "errors": [{"title": "Unauthorized"} ]
         }
       """

  @42
  Scenario: fetch current user with empty domains
    Given fake user token with "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFkBohA223"
    And user "azar@example.com" with password "valid_password" has already registered
    And authenticate "azar@example.com"
    When open "/v1/users/current" form
    And submit the page
    Then receive ok
    And receive JSON response:
        """
        {
          "id" : 1,
          "email" : "azar@example.com",
          "api_token": "QeEgasgWAFdsbGFSUOq48QC0AJK0XlVqYxCIPFkBohA223",
          "domains" : []
        }
       """