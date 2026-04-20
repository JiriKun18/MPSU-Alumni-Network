<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProperPHLocationSeeder extends Seeder
{
    /**
     * Run the database seeds with correct codes from JSON files
     */
    public function run(): void
    {
        $this->command->info('Seeding CORRECT Philippine locations from JSON files...');

        // Load JSON files
        $regionsJson = File::get(base_path('regions.json'));
        $provincesJson = File::get(base_path('provinces.json'));
        $citiesJson = File::get(base_path('cities.json'));
        $barangaysJson = File::get(base_path('barangays.json'));

        $regions = json_decode($regionsJson, true);
        $provinces = json_decode($provincesJson, true);
        $cities = json_decode($citiesJson, true);
        $barangays = json_decode($barangaysJson, true);

        // Clear all location tables
        DB::table('ph_barangays')->truncate();
        DB::table('ph_cities')->truncate();
        DB::table('ph_provinces')->truncate();
        DB::table('ph_regions')->truncate();

        // 1. Seed Regions
        $this->command->info('Seeding regions...');
        $regionsToInsert = array_map(function ($region) {
            return [
                'code' => $region['code'],
                'name' => $region['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $regions);
        DB::table('ph_regions')->insert($regionsToInsert);
        $this->command->info("✓ Seeded " . count($regionsToInsert) . " regions");

        // 2. Seed Provinces
        $this->command->info('Seeding provinces...');
        $provincesToInsert = array_map(function ($province) {
            return [
                'code' => $province['code'],
                'name' => $province['name'],
                'region_code' => $province['regionCode'],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }, $provinces);
        DB::table('ph_provinces')->insert($provincesToInsert);
        $this->command->info("✓ Seeded " . count($provincesToInsert) . " provinces");

        // 3. Seed Cities in chunks
        $this->command->info('Seeding cities...');
        $chunks = array_chunk($cities, 500);
        $cityCount = 0;

        foreach ($chunks as $chunk) {
            $toInsert = array_map(function ($city) {
                return [
                    'code' => $city['code'],
                    'name' => trim($city['name']),
                    'province_code' => $city['provinceCode'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $chunk);

            DB::table('ph_cities')->insert($toInsert);
            $cityCount += count($chunk);
            if ($cityCount % 1000 == 0) {
                $this->command->info("  - Seeded $cityCount cities...");
            }
        }
        $this->command->info("✓ Completed seeding " . count($cities) . " cities");

        // 4. Seed Barangays in chunks
        $this->command->info('Seeding barangays...');
        $chunks = array_chunk($barangays, 1000);
        $barangayCount = 0;

        foreach ($chunks as $chunk) {
            $toInsert = array_map(function ($barangay) {
                return [
                    'code' => $barangay['code'],
                    'name' => $barangay['name'],
                    'city_code' => $barangay['cityCode'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }, $chunk);

            DB::table('ph_barangays')->insert($toInsert);
            $barangayCount += count($chunk);
            if ($barangayCount % 5000 == 0) {
                $this->command->info("  - Seeded $barangayCount barangays...");
            }
        }
        $this->command->info("✓ Completed seeding " . count($barangays) . " barangays");

        $this->command->info('');
        $this->command->info('✓✓✓ COMPLETE Philippine location database seeded successfully! ✓✓✓');
        $this->command->info('Summary:');
        $this->command->info('  - Regions: ' . count($regions));
        $this->command->info('  - Provinces: ' . count($provinces));
        $this->command->info('  - Cities/Municipalities: ' . count($cities));
        $this->command->info('  - Barangays: ' . count($barangays));
    }
}
