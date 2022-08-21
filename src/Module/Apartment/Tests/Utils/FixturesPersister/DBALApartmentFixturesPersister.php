<?php
declare(strict_types=1);

namespace App\Module\Apartment\Tests\Utils\FixturesPersister;

use App\Module\Apartment\Tests\Utils\RequestDataGenerator\AddressDataGenerator;
use App\Module\Apartment\Tests\Utils\RequestDataGenerator\ApartmentAddressDataGenerator;
use App\Module\Apartment\Tests\Utils\RequestDataGenerator\ApartmentDataGenerator;
use App\Module\Apartment\Tests\Utils\RequestDataGenerator\RoomDataGenerator;
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
        $apartment = $this->createApartmentByExposedId($apartmentId);

        $addresses = $this->createRandomAddresses(3);

        $this->addApartmentAddresses(ApartmentAddressDataGenerator::generate($apartment['id'], $addresses));
    }

    public function addApartmentWithIdAndAddressIds(string $apartmentId, array $exposedAddressIds): void
    {
        $apartment = $this->createApartmentByExposedId($apartmentId);
        $this->createApartmentAddresses($apartment['id'], $exposedAddressIds);
    }

    /**
     * @param string $apartmentId
     * @param array $config <[rooms, (rooms config)], [addresses, (exposed address ids)]>
     * @return void
     */
    public function addApartmentWithIdAndConfig(string $apartmentId, array $config): void
    {
        $apartment = $this->createApartmentByExposedId($apartmentId);

        if (!empty($config['rooms'])) {
            $this->createApartmentRoomByConfigAndApartmentId($apartment['id'], $config['rooms']);
        }

        $this->createApartmentAddresses($apartment['id'], $config['addresses']);
    }

    public function addApartmentWithConfig(array $config): void
    {
        $this->addApartment($config['apartment']);

        if (!empty($config['rooms'])) {
            $this->createApartmentRoomByConfigAndApartmentId($config['apartment']['id'], $config['rooms']);
        }

        $this->createApartmentAddresses($config['apartment']['id'], $config['addresses']);
    }

    public function addAddressesWithIds(array $addressIds): void
    {
        $this->addAddresses(AddressDataGenerator::generateAnyAddressesWithIds($addressIds));
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

    public function addApartment(array $apartment): void
    {
        $this->connection->insert('apartment', $apartment);
    }

    public function assertAllApartmentDataWasRemoved(int $apartmentId): bool
    {
        if (!$this->apartmentAddressesExist($apartmentId)
            || !$this->apartmentRoomsExist($apartmentId)
            || !$this->apartmentExist($apartmentId)
        ) {
            return true;
        }

        return false;
    }

    public function createApartmentRoomByConfigAndApartmentId(int $apartmentId, array $config): void
    {
        RoomDataGenerator::fromApartmentConfigAndApartmentId($apartmentId, $config);
        $result = [];
        foreach ($config as $item) {
            $item['id'] = mt_rand(1, 3_000_000);
            $item['apartment_id'] = $apartmentId;
            $result[] = $item;
        }
        $this->addApartmentRooms($result);
    }

    public function addApartmentRooms(array $apartmentRooms): void
    {
        foreach ($apartmentRooms as $apartmentRoom) {
            $this->connection->insert('room', $apartmentRoom);
        }
    }

    public function getAddressIdsByExposedIds(array $exposedAddressIds): array
    {
        return $this->connection
            ->executeQuery(
                'SELECT id FROM address WHERE exposed_id IN (?)',
                [$exposedAddressIds],
                [Connection::PARAM_STR_ARRAY]
            )->fetchAllAssociative();
    }

    public function apartmentAddressesExist(int $apartmentId): bool
    {
        $result = $this->connection
            ->executeQuery(
                'SELECT apartment_id FROM apartment_address WHERE apartment_id = :apartmentId',
                ['apartmentId' => $apartmentId]
            )->fetchAllAssociative();

        return (!empty($result[0]['apartment_id']));
    }

    public function apartmentRoomsExist(int $apartmentId): bool
    {
        $result = $this->connection
            ->executeQuery(
                'SELECT apartment_id FROM room WHERE apartment_id = :apartmentId',
                ['apartmentId' => $apartmentId]
            )->fetchAllAssociative();

        return (!empty($result[0]['apartment_id']));
    }

    public function apartmentExist(int $apartmentId): bool
    {
        $result = $this->connection
            ->executeQuery(
                'SELECT id FROM apartment WHERE id = :apartmentId',
                ['apartmentId' => $apartmentId]
            )->fetchAllAssociative();

        return (!empty($result[0]['id']));
    }

    public function cleanUp(): void
    {
        $this->connection->executeQuery("DELETE FROM apartment");
        $this->connection->executeQuery("DELETE FROM address");
        $this->connection->executeQuery("DELETE FROM apartment_address");
        $this->connection->executeQuery("DELETE FROM room");
    }

    private function createRandomAddresses(int $addressesAmount): array
    {
        $addresses = AddressDataGenerator::generateAnyAddresses($addressesAmount);
        $this->addAddresses($addresses);

        return $addresses;
    }

    private function createApartmentAddresses(int $apartmentId, array $exposedAddressIds)
    {
        $addressIds = $this->getAddressIdsByExposedIds($exposedAddressIds);
        $this->addApartmentAddresses(ApartmentAddressDataGenerator::generate($apartmentId, $addressIds));
    }

    private function createApartmentByExposedId(string $apartmentId): array
    {
        $apartment = ApartmentDataGenerator::generate(['exposedId' => $apartmentId]);
        $this->addApartment($apartment);

        return $apartment;
    }
}