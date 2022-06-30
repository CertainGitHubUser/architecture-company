Feature:
  Get apartment by id

  Scenario: Apartment with id exists
    Given apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"
    When I ask for apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"
    Then I receive apartment with id "e4388052-2fc9-9d1e-b9f0-077b17eb0cd5"