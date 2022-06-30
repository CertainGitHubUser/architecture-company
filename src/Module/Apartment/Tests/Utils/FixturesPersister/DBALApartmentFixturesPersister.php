<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Utils\FixturesPersister;

use App\Module\Apartment\Tests\Utils\RequestDataGenerator\AddressDataGenerator;
use App\Module\Apartment\Tests\Utils\RequestDataGenerator\ApartmentAddressDataGenerator;
use App\Module\Apartment\Tests\Utils\RequestDataGenerator\ApartmentDataGenerator;
use Doctrine\DBAL\Connection;

final class DBALApartmentFixturesPersister
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function addApartmentWithId(string $apartmentId): void
    {
        $requestData = ApartmentDataGenerator::generate(['exposedId' => $apartmentId]);
        $this->connection->insert('apartment', $requestData);

        $addresses = AddressDataGenerator::generateAnyAddresses(3);
        $this->addAddresses($addresses);

        $this->addApartmentAddresses(ApartmentAddressDataGenerator::generate($requestData['id'], $addresses));
    }

    public function addAddresses(array $addresses): void
    {
        foreach ($addresses as $address) {
            $this->connection->insert('address', $address);
        }
    }

    public function addApartmentAddresses(array $apartmentAddresses)
    {
        foreach ($apartmentAddresses as $apartmentAddress) {
            $this->connection->insert('apartment_address', $apartmentAddress);
        }
    }

    public function cleanUp(): void
    {
        $this->connection->executeQuery("DELETE FROM apartment");
        $this->connection->executeQuery("DELETE FROM address");
        $this->connection->executeQuery("DELETE FROM apartment_address");

    }
}