Feature: Delete Record Type

  In order to delete record type

  As a member

  I delete item from record type


  @7
  Scenario: Delete Record Type

    Given user "azar@example.com" with password "valid_password" has already registered
    And authenticate "azar@example.com"
    And a domain with name "example.com"
    And a record with content "hash"
    When open "/v1/records/1" form
    And delete the form
    Then receive ok
    And receive JSON response:
        """
          {
           "message" : "deleted"
          }
        """

  @71
  Scenario: Not Allowed to Delete Record Type

    Given user "azar@example.com" with password "valid_password" has already registered
    When open "/v1/records/1" form
    And delete the form
    Then receive not ok
    And receive JSON response:
      """
          {
            "errors": [{"title": "Unauthorized"} ]
         }
      """