@delete_apartment
Feature: API should delete apartment by id

  Background:
    Given Addresses with ids:
      """
      4c2ec2f3-ddba-22cb-7f55-a76ac154ad1f
      c4d6c866-7130-7da9-6646-41b5cd4d5e20
      d91b0d9a-0083-f483-aa12-d81ba8aa339f
      244a4ed1-85b2-9dc4-2926-11c886de6a80
      7cddf877-ea6e-8c60-3b05-3ccf7cc4c105
      bedb4a88-4883-20a6-00c6-cd79dd7ab1a0
      49fa067f-c9e3-cd70-6737-e60ead448914
      9507cd3a-c9c6-c11f-2bc0-f5ce74a12d67
      """
  Scenario: Delete apartment with rooms
    Given apartment with following config:
    """
    {
      "apartment": {
          "id": 1,
          "exposed_id": "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5",
          "square": "75",
          "floor": "1",
          "built_in": "2009-06-15",
          "user_id": "123",
          "price": "1231232",
          "apartment_type": "RegularApartment",
          "heating_type": "HeatPump",
          "rental_price": "1111",
          "currency": "USD",
          "has_gas": true,
          "has_water": true,
          "has_hood": true,
          "title": "title",
          "description": "description"
      },
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
    When I try to remove this apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"
    Then I ensure that all apartment data with id 1 was removed

  Scenario: Delete apartment without rooms
    Given apartment with following config:
    """
    {
      "apartment": {
          "id": 1,
          "exposed_id": "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5",
          "square": "75",
          "floor": "1",
          "built_in": "2009-06-15",
          "user_id": "123",
          "price": "1231232",
          "apartment_type": "RegularApartment",
          "heating_type": "HeatPump",
          "rental_price": "1111",
          "currency": "USD",
          "has_gas": true,
          "has_water": true,
          "has_hood": true,
          "title": "title",
          "description": "description"
      },
      "rooms": [],
      "addresses": [
          "c4d6c866-7130-7da9-6646-41b5cd4d5e20",
          "d91b0d9a-0083-f483-aa12-d81ba8aa339f",
          "244a4ed1-85b2-9dc4-2926-11c886de6a80"
      ]
    }
    """
    When I try to remove this apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"
    Then I ensure that all apartment data with id 1 was removed

  Scenario: Trying to delete not existing apartment
    When I try to remove this apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"
    Then response with status code should be "400"