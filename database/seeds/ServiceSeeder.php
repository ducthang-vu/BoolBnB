<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = [
            'WiFi',
            'Posto Macchina',
            'Piscina',
            'Portineria',
            'Sauna',
            'Vista Mare'
        ];

        foreach ($services as $service) {
            $new_service = new Service();
            $new_service->type = $service;
            $new_service->save();
        }
    }
}
