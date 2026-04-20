<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhilippinesAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        DB::table('ph_barangays')->truncate();
        DB::table('ph_cities')->truncate();
        DB::table('ph_provinces')->truncate();
        DB::table('ph_regions')->truncate();
        
        // Seed regions first
        $this->seedRegions();
        
        // Seed provinces by region
        $this->seedProvinces();
        
        // Seed cities and municipalities with barangays
        $this->seedAllCities();
    }

    /**
     * Seed all Philippine regions
     */
    private function seedRegions(): void
    {
        $regions = [
            ['code' => '010000000', 'name' => 'Region I (Ilocos Region)'],
            ['code' => '020000000', 'name' => 'Region II (Cagayan Valley)'],
            ['code' => '030000000', 'name' => 'Region III (Central Luzon)'],
            ['code' => '040000000', 'name' => 'Region IV-A (CALABARZON)'],
            ['code' => '170000000', 'name' => 'Region IV-B (MIMAROPA)'],
            ['code' => '050000000', 'name' => 'Region V (Bicol Region)'],
            ['code' => '060000000', 'name' => 'Region VI (Western Visayas)'],
            ['code' => '070000000', 'name' => 'Region VII (Central Visayas)'],
            ['code' => '080000000', 'name' => 'Region VIII (Eastern Visayas)'],
            ['code' => '090000000', 'name' => 'Region IX (Zamboanga Peninsula)'],
            ['code' => '100000000', 'name' => 'Region X (Northern Mindanao)'],
            ['code' => '110000000', 'name' => 'Region XI (Davao Region)'],
            ['code' => '120000000', 'name' => 'Region XII (Soccsksargen)'],
            ['code' => '130000000', 'name' => 'Region XIII (Caraga)'],
            ['code' => '140000000', 'name' => 'NCR (National Capital Region)'],
            ['code' => '150000000', 'name' => 'CAR (Cordillera Administrative Region)'],
            ['code' => '160000000', 'name' => 'BARMM (Bangsamoro Autonomous Region in Muslim Mindanao)'],
        ];

        DB::table('ph_regions')->insert($regions);
    }

    /**
     * Seed all Philippines provinces
     */
    private function seedProvinces(): void
    {
        $provinces = [
            // Region I
            ['code' => '011300000', 'name' => 'Ilocos Norte', 'region_code' => '010000000'],
            ['code' => '011700000', 'name' => 'Ilocos Sur', 'region_code' => '010000000'],
            ['code' => '012100000', 'name' => 'La Union', 'region_code' => '010000000'],
            ['code' => '012500000', 'name' => 'Pangasinan', 'region_code' => '010000000'],
            
            // Region II
            ['code' => '021400000', 'name' => 'Batanes', 'region_code' => '020000000'],
            ['code' => '021800000', 'name' => 'Cagayan', 'region_code' => '020000000'],
            ['code' => '022200000', 'name' => 'Isabela', 'region_code' => '020000000'],
            ['code' => '022600000', 'name' => 'Nueva Vizcaya', 'region_code' => '020000000'],
            ['code' => '023000000', 'name' => 'Quirino', 'region_code' => '020000000'],
            
            // Region III
            ['code' => '031100000', 'name' => 'Aurora', 'region_code' => '030000000'],
            ['code' => '031500000', 'name' => 'Bataan', 'region_code' => '030000000'],
            ['code' => '031900000', 'name' => 'Bulacan', 'region_code' => '030000000'],
            ['code' => '032300000', 'name' => 'Nueva Ecija', 'region_code' => '030000000'],
            ['code' => '032700000', 'name' => 'Pampanga', 'region_code' => '030000000'],
            ['code' => '033100000', 'name' => 'Tarlac', 'region_code' => '030000000'],
            ['code' => '033500000', 'name' => 'Zambales', 'region_code' => '030000000'],
            
            // Region IV-A
            ['code' => '041400000', 'name' => 'Batangas', 'region_code' => '040000000'],
            ['code' => '041800000', 'name' => 'Cavite', 'region_code' => '040000000'],
            ['code' => '042200000', 'name' => 'Laguna', 'region_code' => '040000000'],
            ['code' => '042600000', 'name' => 'Quezon', 'region_code' => '040000000'],
            ['code' => '043000000', 'name' => 'Rizal', 'region_code' => '040000000'],
            
            // Region IV-B
            ['code' => '171400000', 'name' => 'Marinduque', 'region_code' => '170000000'],
            ['code' => '171800000', 'name' => 'Occidental Mindoro', 'region_code' => '170000000'],
            ['code' => '172100000', 'name' => 'Oriental Mindoro', 'region_code' => '170000000'],
            ['code' => '172500000', 'name' => 'Palawan', 'region_code' => '170000000'],
            ['code' => '172900000', 'name' => 'Romblon', 'region_code' => '170000000'],
            
            // Region V
            ['code' => '051400000', 'name' => 'Albay', 'region_code' => '050000000'],
            ['code' => '051800000', 'name' => 'Camarines Norte', 'region_code' => '050000000'],
            ['code' => '052200000', 'name' => 'Camarines Sur', 'region_code' => '050000000'],
            ['code' => '052600000', 'name' => 'Catanduanes', 'region_code' => '050000000'],
            ['code' => '053000000', 'name' => 'Masbate', 'region_code' => '050000000'],
            ['code' => '053400000', 'name' => 'Sorsogon', 'region_code' => '050000000'],
            
            // Region VI
            ['code' => '061100000', 'name' => 'Aklan', 'region_code' => '060000000'],
            ['code' => '061500000', 'name' => 'Antique', 'region_code' => '060000000'],
            ['code' => '061900000', 'name' => 'Capiz', 'region_code' => '060000000'],
            ['code' => '062300000', 'name' => 'Guimaras', 'region_code' => '060000000'],
            ['code' => '062700000', 'name' => 'Iloilo', 'region_code' => '060000000'],
            ['code' => '063100000', 'name' => 'Negros Occidental', 'region_code' => '060000000'],
            
            // Region VII
            ['code' => '071400000', 'name' => 'Bohol', 'region_code' => '070000000'],
            ['code' => '071800000', 'name' => 'Cebu', 'region_code' => '070000000'],
            ['code' => '072100000', 'name' => 'Negros Oriental', 'region_code' => '070000000'],
            ['code' => '072500000', 'name' => 'Siquijor', 'region_code' => '070000000'],
            
            // Region VIII
            ['code' => '081100000', 'name' => 'Biliran', 'region_code' => '080000000'],
            ['code' => '081500000', 'name' => 'Eastern Samar', 'region_code' => '080000000'],
            ['code' => '081900000', 'name' => 'Leyte', 'region_code' => '080000000'],
            ['code' => '082300000', 'name' => 'Northern Samar', 'region_code' => '080000000'],
            ['code' => '082700000', 'name' => 'Samar', 'region_code' => '080000000'],
            ['code' => '083100000', 'name' => 'Southern Leyte', 'region_code' => '080000000'],
            
            // Region IX
            ['code' => '091400000', 'name' => 'Misamis Occidental', 'region_code' => '090000000'],
            ['code' => '091800000', 'name' => 'Misamis Oriental', 'region_code' => '090000000'],
            ['code' => '092200000', 'name' => 'Negros Oriental', 'region_code' => '090000000'],
            ['code' => '092600000', 'name' => 'Zamboanga del Norte', 'region_code' => '090000000'],
            ['code' => '093000000', 'name' => 'Zamboanga del Sur', 'region_code' => '090000000'],
            ['code' => '093400000', 'name' => 'Zamboanga Sibugay', 'region_code' => '090000000'],
            
            // Region X
            ['code' => '101400000', 'name' => 'Bukidnon', 'region_code' => '100000000'],
            ['code' => '101800000', 'name' => 'Camiguin', 'region_code' => '100000000'],
            ['code' => '102200000', 'name' => 'Lanao del Norte', 'region_code' => '100000000'],
            ['code' => '102600000', 'name' => 'Misamis Oriental', 'region_code' => '100000000'],
            
            // Region XI
            ['code' => '111400000', 'name' => 'Davao de Oro', 'region_code' => '110000000'],
            ['code' => '111800000', 'name' => 'Davao Oriental', 'region_code' => '110000000'],
            ['code' => '112200000', 'name' => 'Davao del Norte', 'region_code' => '110000000'],
            ['code' => '112600000', 'name' => 'Davao del Sur', 'region_code' => '110000000'],
            ['code' => '113000000', 'name' => 'Davao Occidental', 'region_code' => '110000000'],
            
            // Region XII
            ['code' => '121400000', 'name' => 'Cotabato (North Cotabato)', 'region_code' => '120000000'],
            ['code' => '121800000', 'name' => 'Sarangani', 'region_code' => '120000000'],
            ['code' => '122200000', 'name' => 'South Cotabato', 'region_code' => '120000000'],
            ['code' => '122600000', 'name' => 'Sultan Kudarat', 'region_code' => '120000000'],
            
            // Region XIII
            ['code' => '131400000', 'name' => 'Agusan del Norte', 'region_code' => '130000000'],
            ['code' => '131800000', 'name' => 'Agusan del Sur', 'region_code' => '130000000'],
            ['code' => '132200000', 'name' => 'Surigao del Norte', 'region_code' => '130000000'],
            ['code' => '132600000', 'name' => 'Surigao del Sur', 'region_code' => '130000000'],
            
            // CAR
            ['code' => '150100000', 'name' => 'Abra', 'region_code' => '150000000'],
            ['code' => '150300000', 'name' => 'Apayao', 'region_code' => '150000000'],
            ['code' => '150500000', 'name' => 'Benguet', 'region_code' => '150000000'],
            ['code' => '150700000', 'name' => 'Ifugao', 'region_code' => '150000000'],
            ['code' => '150900000', 'name' => 'Kalinga', 'region_code' => '150000000'],
            ['code' => '151100000', 'name' => 'Mountain Province', 'region_code' => '150000000'],
        ];

        DB::table('ph_provinces')->insert($provinces);
    }

    /**
     * Seed all cities and municipalities
     */
    private function seedAllCities(): void
    {
        // NCR - Most complete with barangays
        $this->seedNCRCities();
        
        // CAR - Mountain Province and Baguio
        $this->seedCARCities();
        
        // Visayas - Cebu and Bohol
        $this->seedVisayasCities();
        
        // Ilocos - Laoag and Batac
        $this->seedIlocosCities();
        
        // Mindanao - Davao
        $this->seedMindanaoCities();
    }

    /**
     * NCR Cities and Barangays
     */
    private function seedNCRCities(): void
    {
        $ncrCities = [
            ['code' => '140100000', 'name' => 'City of Manila', 'province_code' => '140000000'],
            ['code' => '140300000', 'name' => 'City of Quezon City', 'province_code' => '140000000'],
            ['code' => '140500000', 'name' => 'City of Pasay', 'province_code' => '140000000'],
            ['code' => '140700000', 'name' => 'City of Las Piñas', 'province_code' => '140000000'],
            ['code' => '140900000', 'name' => 'City of Makati', 'province_code' => '140000000'],
            ['code' => '141100000', 'name' => 'City of Caloocan', 'province_code' => '140000000'],
            ['code' => '141500000', 'name' => 'City of Marikina', 'province_code' => '140000000'],
            ['code' => '141700000', 'name' => 'City of Muntinlupa', 'province_code' => '140000000'],
            ['code' => '142900000', 'name' => 'Pasig', 'province_code' => '140000000'],
            ['code' => '143100000', 'name' => 'Paranaque', 'province_code' => '140000000'],
            ['code' => '143300000', 'name' => 'Taguig', 'province_code' => '140000000'],
        ];
        DB::table('ph_cities')->insert($ncrCities);

        // Manila Barangays
        $manilaBarangays = [
            ['code' => '140101001', 'name' => 'Intramuros', 'city_code' => '140100000'],
            ['code' => '140101002', 'name' => 'Binondo', 'city_code' => '140100000'],
            ['code' => '140101003', 'name' => 'Quiapo', 'city_code' => '140100000'],
            ['code' => '140101004', 'name' => 'San Miguel', 'city_code' => '140100000'],
            ['code' => '140101005', 'name' => 'Sampaloc Central', 'city_code' => '140100000'],
            ['code' => '140101006', 'name' => 'Santa Cruz', 'city_code' => '140100000'],
            ['code' => '140101007', 'name' => 'Malate', 'city_code' => '140100000'],
            ['code' => '140101008', 'name' => 'Ermita', 'city_code' => '140100000'],
            ['code' => '140101009', 'name' => 'Tondo', 'city_code' => '140100000'],
            ['code' => '140101010', 'name' => 'Paco', 'city_code' => '140100000'],
            ['code' => '140101011', 'name' => 'Pandacan', 'city_code' => '140100000'],
            ['code' => '140101012', 'name' => 'Port Area', 'city_code' => '140100000'],
            ['code' => '140101013', 'name' => 'Santa Ana', 'city_code' => '140100000'],
        ];
        DB::table('ph_barangays')->insert($manilaBarangays);

        // Quezon City Barangays (30 sample)
        $qcBarangays = [
            ['code' => '140301001', 'name' => 'Anonas', 'city_code' => '140300000'],
            ['code' => '140301002', 'name' => 'Bagbag', 'city_code' => '140300000'],
            ['code' => '140301003', 'name' => 'Bagong Pag-asa', 'city_code' => '140300000'],
            ['code' => '140301004', 'name' => 'Balangiga', 'city_code' => '140300000'],
            ['code' => '140301005', 'name' => 'Bambang', 'city_code' => '140300000'],
            ['code' => '140301006', 'name' => 'Batasan Hills', 'city_code' => '140300000'],
            ['code' => '140301007', 'name' => 'Nayong Kanluran', 'city_code' => '140300000'],
            ['code' => '140301008', 'name' => 'North Avenue', 'city_code' => '140300000'],
            ['code' => '140301009', 'name' => 'Santa Lucia', 'city_code' => '140300000'],
            ['code' => '140301010', 'name' => 'Manresa', 'city_code' => '140300000'],
            ['code' => '140301011', 'name' => 'Commonwealth', 'city_code' => '140300000'],
            ['code' => '140301012', 'name' => 'Culiat', 'city_code' => '140300000'],
            ['code' => '140301013', 'name' => 'Tandang Sora', 'city_code' => '140300000'],
            ['code' => '140301014', 'name' => 'Payatas', 'city_code' => '140300000'],
            ['code' => '140301015', 'name' => 'Kaluran', 'city_code' => '140300000'],
            ['code' => '140301016', 'name' => 'Novaliches', 'city_code' => '140300000'],
            ['code' => '140301017', 'name' => 'Fairview', 'city_code' => '140300000'],
            ['code' => '140301018', 'name' => 'Banayan', 'city_code' => '140300000'],
            ['code' => '140301019', 'name' => 'La Mesilla', 'city_code' => '140300000'],
            ['code' => '140301020', 'name' => 'Diliman', 'city_code' => '140300000'],
            ['code' => '140301021', 'name' => 'Kengtron', 'city_code' => '140300000'],
            ['code' => '140301022', 'name' => 'Makabayan', 'city_code' => '140300000'],
            ['code' => '140301023', 'name' => 'Malaya', 'city_code' => '140300000'],
            ['code' => '140301024', 'name' => 'Masagana', 'city_code' => '140300000'],
            ['code' => '140301025', 'name' => 'Matandang Balara', 'city_code' => '140300000'],
            ['code' => '140301026', 'name' => 'Nagkaisang Nayon', 'city_code' => '140300000'],
            ['code' => '140301027', 'name' => 'Sikatuna', 'city_code' => '140300000'],
            ['code' => '140301028', 'name' => 'Teachers Village East', 'city_code' => '140300000'],
            ['code' => '140301029', 'name' => 'Teachers Village West', 'city_code' => '140300000'],
            ['code' => '140301030', 'name' => 'Mother Ignacia', 'city_code' => '140300000'],
        ];
        DB::table('ph_barangays')->insert($qcBarangays);

        // Add generic barangays for other NCR cities
        $this->addGenericBarangays('140500000', 17);
        $this->addGenericBarangays('140700000', 10);
        $this->addGenericBarangays('140900000', 17);
        $this->addGenericBarangays('141100000', 15);
        $this->addGenericBarangays('141500000', 16);
        $this->addGenericBarangays('141700000', 16);
        $this->addGenericBarangays('142900000', 30);
        $this->addGenericBarangays('143100000', 17);
        $this->addGenericBarangays('143300000', 34);
    }

    /**
     * CAR Cities and Barangays
     */
    private function seedCARCities(): void
    {
        $carCities = [
            ['code' => '150500100', 'name' => 'Baguio City', 'province_code' => '150500000'],
            ['code' => '151101000', 'name' => 'Bontoc', 'province_code' => '151100000'],
            ['code' => '151102000', 'name' => 'Barlig', 'province_code' => '151100000'],
            ['code' => '151104000', 'name' => 'Sagada', 'province_code' => '151100000'],
        ];
        DB::table('ph_cities')->insert($carCities);

        // Baguio City
        $baguioBarangays = [
            ['code' => '150500101', 'name' => 'Lualhati', 'city_code' => '150500100'],
            ['code' => '150500102', 'name' => 'Santo Tomas', 'city_code' => '150500100'],
            ['code' => '150500103', 'name' => 'Asin', 'city_code' => '150500100'],
            ['code' => '150500104', 'name' => 'South Drive', 'city_code' => '150500100'],
            ['code' => '150500105', 'name' => 'San Isidro', 'city_code' => '150500100'],
            ['code' => '150500106', 'name' => 'Nueva Visita', 'city_code' => '150500100'],
            ['code' => '150500107', 'name' => 'Outlook', 'city_code' => '150500100'],
            ['code' => '150500108', 'name' => 'Irisan', 'city_code' => '150500100'],
            ['code' => '150500109', 'name' => 'Ambuklao', 'city_code' => '150500100'],
            ['code' => '150500110', 'name' => 'Okayville', 'city_code' => '150500100'],
        ];
        DB::table('ph_barangays')->insert($baguioBarangays);

        // Bontoc
        $bontocBarangays = [
            ['code' => '151101001', 'name' => 'Begnet', 'city_code' => '151101000'],
            ['code' => '151101002', 'name' => 'Poblacion', 'city_code' => '151101000'],
            ['code' => '151101003', 'name' => 'Samoki', 'city_code' => '151101000'],
            ['code' => '151101004', 'name' => 'Viñas North', 'city_code' => '151101000'],
            ['code' => '151101005', 'name' => 'Viñas South', 'city_code' => '151101000'],
            ['code' => '151101006', 'name' => 'Talubin', 'city_code' => '151101000'],
        ];
        DB::table('ph_barangays')->insert($bontocBarangays);

        // Barlig
        $barligBarangays = [
            ['code' => '151102001', 'name' => 'Afga', 'city_code' => '151102000'],
            ['code' => '151102002', 'name' => 'Bangon', 'city_code' => '151102000'],
            ['code' => '151102003', 'name' => 'Bayyo', 'city_code' => '151102000'],
            ['code' => '151102004', 'name' => 'Dalang', 'city_code' => '151102000'],
            ['code' => '151102005', 'name' => 'Poblacion', 'city_code' => '151102000'],
            ['code' => '151102006', 'name' => 'Sagta', 'city_code' => '151102000'],
        ];
        DB::table('ph_barangays')->insert($barligBarangays);

        // Sagada
        $this->addGenericBarangays('151104000', 6);
    }

    /**
     * Visayas Cities and Barangays
     */
    private function seedVisayasCities(): void
    {
        $visayasCities = [
            ['code' => '071801000', 'name' => 'Cebu City', 'province_code' => '071800000'],
            ['code' => '071802000', 'name' => 'Mandaue City', 'province_code' => '071800000'],
            ['code' => '071803000', 'name' => 'Lapu-Lapu City', 'province_code' => '071800000'],
        ];
        DB::table('ph_cities')->insert($visayasCities);

        // Cebu City
        $cebuBarangays = [
            ['code' => '071801001', 'name' => 'Abellana', 'city_code' => '071801000'],
            ['code' => '071801002', 'name' => 'Apas', 'city_code' => '071801000'],
            ['code' => '071801003', 'name' => 'Bacayan', 'city_code' => '071801000'],
            ['code' => '071801004', 'name' => 'Banilad', 'city_code' => '071801000'],
            ['code' => '071801005', 'name' => 'Basak San Nicolas', 'city_code' => '071801000'],
            ['code' => '071801006', 'name' => 'Barangay Luz', 'city_code' => '071801000'],
            ['code' => '071801007', 'name' => 'Busay', 'city_code' => '071801000'],
            ['code' => '071801008', 'name' => 'Calamba', 'city_code' => '071801000'],
            ['code' => '071801009', 'name' => 'Camp Lapulapu', 'city_code' => '071801000'],
            ['code' => '071801010', 'name' => 'Carreta', 'city_code' => '071801000'],
            ['code' => '071801011', 'name' => 'Cogon', 'city_code' => '071801000'],
            ['code' => '071801012', 'name' => 'Duljo', 'city_code' => '071801000'],
            ['code' => '071801013', 'name' => 'Gui-os', 'city_code' => '071801000'],
            ['code' => '071801014', 'name' => 'Kalubihan', 'city_code' => '071801000'],
            ['code' => '071801015', 'name' => 'Kamputhaw', 'city_code' => '071801000'],
        ];
        DB::table('ph_barangays')->insert($cebuBarangays);

        // Mandaue and Lapu-Lapu
        $this->addGenericBarangays('071802000', 30);
        $this->addGenericBarangays('071803000', 24);
    }

    /**
     * Ilocos Cities and Barangays
     */
    private function seedIlocosCities(): void
    {
        $ilocosCities = [
            ['code' => '011301000', 'name' => 'Laoag City', 'province_code' => '011300000'],
            ['code' => '011302000', 'name' => 'Batac City', 'province_code' => '011300000'],
            ['code' => '011303000', 'name' => 'Paoay', 'province_code' => '011300000'],
        ];
        DB::table('ph_cities')->insert($ilocosCities);

        // Laoag City
        $laoagBarangays = [
            ['code' => '011301001', 'name' => 'Poro', 'city_code' => '011301000'],
            ['code' => '011301002', 'name' => 'Dammang', 'city_code' => '011301000'],
            ['code' => '011301003', 'name' => 'Villaflores', 'city_code' => '011301000'],
            ['code' => '011301004', 'name' => 'San Nicolas North', 'city_code' => '011301000'],
            ['code' => '011301005', 'name' => 'San Nicolas South', 'city_code' => '011301000'],
            ['code' => '011301006', 'name' => 'Vaui', 'city_code' => '011301000'],
            ['code' => '011301007', 'name' => 'Caloocan', 'city_code' => '011301000'],
            ['code' => '011301008', 'name' => 'Barangay 8', 'city_code' => '011301000'],
        ];
        DB::table('ph_barangays')->insert($laoagBarangays);

        // Batac and Paoay
        $this->addGenericBarangays('011302000', 8);
        $this->addGenericBarangays('011303000', 5);
    }

    /**
     * Mindanao Cities and Barangays
     */
    private function seedMindanaoCities(): void
    {
        $mindanaoCities = [
            ['code' => '111700000', 'name' => 'Davao City', 'province_code' => '111800000'],
        ];
        DB::table('ph_cities')->insert($mindanaoCities);

        $this->addGenericBarangays('111700000', 80);
    }

    /**
     * Add generic barangays for a city
     */
    private function addGenericBarangays($cityCode, $count = 10): void
    {
        $barangays = [];
        for ($i = 1; $i <= $count; $i++) {
            $barangays[] = [
                'code' => $cityCode . str_pad($i, 3, '0', STR_PAD_LEFT),
                'name' => "Barangay $i",
                'city_code' => $cityCode,
            ];
        }
        DB::table('ph_barangays')->insert($barangays);
    }
}
