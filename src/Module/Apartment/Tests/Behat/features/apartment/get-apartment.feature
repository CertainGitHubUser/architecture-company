@get_apartment
Feature: API should return apartment by id

  Background:
    Given Addresses with ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      c4d6c866-7130-7da9-6646-41b5cd4d5e20
      d91b0d9a-0083-f483-aa12-d81ba8aa339f
      244a4ed1-85b2-9dc4-2926-11c886de6a80
      7cddf877-ea6e-8c60-3b05-3ccf7cc4c105
      """

  Scenario: Apartment with rooms
    Given apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5" and following config:
    """
    {
      "rooms": [
          {
              "room_type": "LivingRoom",
              "square": 15,
              "exposed_id": "244a4ed1-85b2-9dc4-2926-11c886de6a80"
          },
          {
              "room_type": "Bedroom",
              "square": 25,
              "exposed_id": "39a26a59-310f-d5e6-1c3f-1bd5f9816f9b"
          },
          {
              "room_type": "Kitchen",
              "square": 35,
              "exposed_id": "63b8885e-54c3-80db-1952-a0f74e0caf35"
          }
      ],
      "addresses": [
          "c4d6c866-7130-7da9-6646-41b5cd4d5e20",
          "d91b0d9a-0083-f483-aa12-d81ba8aa339f",
          "244a4ed1-85b2-9dc4-2926-11c886de6a80"
      ]
    }
    """
    When I ask for apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"
    Then I receive apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"

  Scenario: Apartment without rooms
    Given apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5" and following config:
    """
    {
      "addresses": [
          "c4d6c866-7130-7da9-6646-41b5cd4d5e20",
          "d91b0d9a-0083-f483-aa12-d81ba8aa339f",
          "244a4ed1-85b2-9dc4-2926-11c886de6a80"
      ]
    }
    """
    When I ask for apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"
    Then I receive apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"

  Scenario: Asking for not existing apartment
    When I ask for apartment with id "122e8215-c7b0-9326-edb1-e6cf8f38c058"
    Then I receive not found exception