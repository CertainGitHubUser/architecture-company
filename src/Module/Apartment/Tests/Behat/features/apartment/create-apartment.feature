@create_apartment
Feature: API should create apartment

  Background:
    Given Addresses with ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      c4d6c866-7130-7da9-6646-41b5cd4d5e20
      d91b0d9a-0083-f483-aa12-d81ba8aa339f
      244a4ed1-85b2-9dc4-2926-11c886de6a80
      7cddf877-ea6e-8c60-3b05-3ccf7cc4c105
      """

  Scenario: Creating apartment with rooms
    Given apartment will have id "b8dbb89a-38be-481b-e104-32e0323d6013"
    And apartment will have total square 75
    And apartment will have rooms:
    """
    {
      "rooms": [
          {
              "room_type": "LivingRoom",
              "square": 15
          },
          {
              "room_type": "Bedroom",
              "square": 25
          },
          {
              "room_type": "Kitchen",
              "square": 35
          }
      ]
    }
    """
    And apartment will have address ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      c4d6c866-7130-7da9-6646-41b5cd4d5e20
      d91b0d9a-0083-f483-aa12-d81ba8aa339f
      244a4ed1-85b2-9dc4-2926-11c886de6a80
      """
    When I try to create this apartment
    Then response with status code should be "201"

  Scenario: Creating apartment with rooms where total rooms square is greater than apartment square
    Given apartment will have id "b8dbb89a-38be-481b-e104-32e0323d6013"
    And apartment will have total square 70
    And apartment will have rooms:
    """
    {
      "rooms": [
          {
              "room_type": "LivingRoom",
              "square": 15
          },
          {
              "room_type": "Bedroom",
              "square": 25
          },
          {
              "room_type": "Kitchen",
              "square": 35
          }
      ]
    }
    """
    And apartment will have address ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      c4d6c866-7130-7da9-6646-41b5cd4d5e20
      d91b0d9a-0083-f483-aa12-d81ba8aa339f
      244a4ed1-85b2-9dc4-2926-11c886de6a80
      """
    When I try to create this apartment
    Then response with status code should be "400"

  Scenario: Creating apartment without rooms
    Given apartment will have id "b8dbb89a-38be-481b-e104-32e0323d6013"
    And apartment will have total square 73
    And apartment will have address ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      c4d6c866-7130-7da9-6646-41b5cd4d5e20
      d91b0d9a-0083-f483-aa12-d81ba8aa339f
      244a4ed1-85b2-9dc4-2926-11c886de6a80
      """
    When I try to create this apartment
    Then response with status code should be "201"


  Scenario: Creating apartment without addresses
    Given apartment will have id "b8dbb89a-38be-481b-e104-32e0323d6013"
    And apartment will have total square 73
    When I try to create this apartment
    Then response with status code should be "400"

  Scenario: Creating apartment with more than 4 addresses
    Given apartment will have id "b8dbb89a-38be-481b-e104-32e0323d6013"
    And apartment will have total square 73
    And apartment will have address ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      c4d6c866-7130-7da9-6646-41b5cd4d5e20
      d91b0d9a-0083-f483-aa12-d81ba8aa339f
      244a4ed1-85b2-9dc4-2926-11c886de6a80
      7cddf877-ea6e-8c60-3b05-3ccf7cc4c105
      """
    When I try to create this apartment
    Then response with status code should be "400"

  Scenario: Creating apartment with 2 existing and 2 not existing addresses
    Given apartment will have id "b8dbb89a-38be-481b-e104-32e0323d6013"
    And apartment will have total square 73
    And apartment will have address ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      c4d6c866-7130-7da9-6646-41b5cd4d5e20
      0ae36810-ea79-3aa9-d39e-32727f36c99e
      190f044b-8964-97db-866d-2204849ceffb
      """
    #Where "0ae36810-ea79-3aa9-d39e-32727f36c99e", "190f044b-8964-97db-866d-2204849ceffb" are not existing addresses
    When I try to create this apartment
    Then response with status code should be "400"

  Scenario: Creating apartment with address that was already taken
    Given apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5" and addresses with ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      7cddf877-ea6e-8c60-3b05-3ccf7cc4c105
      """
    Given apartment will have id "b8dbb89a-38be-481b-e104-32e0323d6013"
    And apartment will have total square 73
    And apartment will have address ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      """
    When I try to create this apartment
    Then response with status code should be "400"

  Scenario: Creating apartment with available address
    Given apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"
    And Addresses with ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      7cddf877-ea6e-8c60-3b05-3ccf7cc4c105
      """
    Given apartment will have id "b8dbb89a-38be-481b-e104-32e0323d6013"
    And apartment will have total square 73
    And apartment will have address ids:
      """
      d91b0d9a-0083-f483-aa12-d81ba8aa339f
      c4d6c866-7130-7da9-6646-41b5cd4d5e20
      """
    When I try to create this apartment
    Then response with status code should be "201"