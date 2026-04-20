<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CompletePHLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Load complete data from JSON files
        $citiesJson = File::get(base_path('cities.json'));
        $barangaysJson = File::get(base_path('barangays.json'));

        $cities = json_decode($citiesJson, true);
        $barangays = json_decode($barangaysJson, true);

        $this->command->info('Seeding complete Philippine locations from JSON files...');

        // Clear existing cities and barangays (regions and provinces already stable)
        DB::table('ph_barangays')->truncate();
        DB::table('ph_cities')->truncate();

        // Seed cities in chunks for efficiency
        $this->command->info('Seeding ' . count($cities) . ' cities...');
        $chunks = array_chunk($cities, 500);
        $cityCount = 0;

        foreach ($chunks as $chunk) {
            $toInsert = array_map(function ($city) {
                return [
                    'code' => $city['code'],
                    'name' => $city['name'] ?? 'Unknown',
                    'province_code' => $city['provinceCode'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $chunk);

            DB::table('ph_cities')->insert($toInsert);
            $cityCount += count($chunk);
            $this->command->info("  - Seeded $cityCount cities...");
        }

        $this->command->info('✓ Completed seeding ' . $cityCount . ' cities');

        // Seed barangays in chunks
        $this->command->info('Seeding ' . count($barangays) . ' barangays...');
        $chunks = array_chunk($barangays, 1000);
        $barangayCount = 0;

        foreach ($chunks as $chunk) {
            $toInsert = array_map(function ($barangay) {
                return [
                    'code' => $barangay['code'],
                    'name' => $barangay['name'] ?? 'Unknown',
                    'city_code' => $barangay['cityCode'] ?? null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $chunk);

            DB::table('ph_barangays')->insert($toInsert);
            $barangayCount += count($chunk);
            $this->command->info("  - Seeded $barangayCount barangays...");
        }

        $this->command->info('✓ Completed seeding ' . $barangayCount . ' barangays');
        $this->command->info('✓ Complete Philippine location data seeded successfully!');
    }
}
