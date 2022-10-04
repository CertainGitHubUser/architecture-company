<?php
declare(strict_types=1);

final class InsertApartments
{
    public function test()
    {
        set_time_limit(0);
        ini_set('max_execution_time','6000');
        $payload = [
            'square' => 12345,
            'floor' => 3,
            'builtIn' => '2009-06-15T13:45:30',
            'rooms' => [
                [
                    'roomType' => 'LivingRoom',
                    'square' => 342
                ],
                [
                    'roomType' => 'Bedroom',
                    'square' => 343
                ],
                [
                    'roomType' => 'Kitchen',
                    'square' => 344
                ],
            ],
            'ownerId' => '123',
            'price' => '123456',
            'apartmentType' => 'RegularApartment',
            'heatingType' => 'HeatPump',
            'rentalPrice' => '12345',
            'currency' => 'USD',
            'addresses' => ['dd769909-d58d-fb6d-2f2b-9941d53b0fc6','dd769909-d58d-fb6d-2f2b-9941d53b0fc6'],
            'hasGas' => true,
            'hasWater' => false ,
            'hasHood' => false
        ];
        for ($i = 0; $i < 100_000; $i++) {
            $handle = curl_init();
            curl_setopt($handle, CURLOPT_URL, 'http://architecture-company.local:8080/api/v1/apartment');
            curl_setopt($handle, CURLOPT_POST, 1);
            curl_setopt($handle, CURLOPT_POSTFIELDS, json_encode($payload));
            $a = curl_exec($handle);
//            $res = curl_error($handle);
//            $fd = curl_getinfo($handle);
            curl_close($handle);
        }
    }
}