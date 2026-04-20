<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class LocationController extends Controller
{
    private array $locationCache = [];

    // Countries list with codes (ISO 3166-1)
    private $countries = [
        ['code' => 'PH', 'name' => 'Philippines'],
        ['code' => 'US', 'name' => 'United States'],
        ['code' => 'CA', 'name' => 'Canada'],
        ['code' => 'AU', 'name' => 'Australia'],
        ['code' => 'GB', 'name' => 'United Kingdom'],
        ['code' => 'SG', 'name' => 'Singapore'],
        ['code' => 'MY', 'name' => 'Malaysia'],
        ['code' => 'TH', 'name' => 'Thailand'],
        ['code' => 'VN', 'name' => 'Vietnam'],
        ['code' => 'ID', 'name' => 'Indonesia'],
        ['code' => 'JP', 'name' => 'Japan'],
        ['code' => 'KR', 'name' => 'South Korea'],
        ['code' => 'CN', 'name' => 'China'],
        ['code' => 'TW', 'name' => 'Taiwan'],
        ['code' => 'HK', 'name' => 'Hong Kong'],
        ['code' => 'AE', 'name' => 'United Arab Emirates'],
        ['code' => 'SA', 'name' => 'Saudi Arabia'],
        ['code' => 'KW', 'name' => 'Kuwait'],
        ['code' => 'QA', 'name' => 'Qatar'],
        ['code' => 'BH', 'name' => 'Bahrain'],
        ['code' => 'OM', 'name' => 'Oman'],
        ['code' => 'DE', 'name' => 'Germany'],
        ['code' => 'FR', 'name' => 'France'],
        ['code' => 'IT', 'name' => 'Italy'],
        ['code' => 'ES', 'name' => 'Spain'],
        ['code' => 'NL', 'name' => 'Netherlands'],
        ['code' => 'BE', 'name' => 'Belgium'],
        ['code' => 'CH', 'name' => 'Switzerland'],
        ['code' => 'AT', 'name' => 'Austria'],
        ['code' => 'SE', 'name' => 'Sweden'],
        ['code' => 'NO', 'name' => 'Norway'],
        ['code' => 'DK', 'name' => 'Denmark'],
        ['code' => 'FI', 'name' => 'Finland'],
        ['code' => 'PL', 'name' => 'Poland'],
        ['code' => 'CZ', 'name' => 'Czech Republic'],
        ['code' => 'RO', 'name' => 'Romania'],
        ['code' => 'RU', 'name' => 'Russia'],
        ['code' => 'TR', 'name' => 'Turkey'],
        ['code' => 'GR', 'name' => 'Greece'],
        ['code' => 'PT', 'name' => 'Portugal'],
        ['code' => 'IE', 'name' => 'Ireland'],
        ['code' => 'IL', 'name' => 'Israel'],
        ['code' => 'ZA', 'name' => 'South Africa'],
        ['code' => 'EG', 'name' => 'Egypt'],
        ['code' => 'NG', 'name' => 'Nigeria'],
        ['code' => 'BR', 'name' => 'Brazil'],
        ['code' => 'MX', 'name' => 'Mexico'],
        ['code' => 'AR', 'name' => 'Argentina'],
        ['code' => 'CO', 'name' => 'Colombia'],
        ['code' => 'CL', 'name' => 'Chile'],
        ['code' => 'PE', 'name' => 'Peru'],
        ['code' => 'NZ', 'name' => 'New Zealand'],
    ];



    

    

    public function regions(Request $request)
    {
        $regions = $this->getRegions();
        
        return response()->json($regions);
    }

    public function provinces(Request $request, $regionCode)
    {
        $provinces = $this->getProvinces($regionCode);
        
        return response()->json($provinces);
    }

    public function cities(Request $request, $provinceCode)
    {
        $cities = $this->getCities($provinceCode);
        
        return response()->json($cities);
    }

    public function barangays(Request $request, $cityCode)
    {
        $barangays = $this->getBarangays($cityCode);
        
        return response()->json($barangays);
    }

    public function countries(Request $request)
    {
        return response()->json($this->countries);
    }

    public function getPhilippinesRegions(Request $request)
    {
        return $this->regions($request);
    }

    // Legacy method for backward compatibility
    public function municipalities(Request $request, $provinceCode)
    {
        $cities = $this->getCities($provinceCode);
        
        return response()->json($cities);
    }

    private function getRegions(): array
    {
        if (Schema::hasTable('ph_regions')) {
            $regions = DB::table('ph_regions')
                ->select('code', 'name')
                ->orderBy('name')
                ->get()
                ->toArray();

            if (!empty($regions)) {
                return $regions;
            }
        }

        return $this->loadLocationFile('regions.json');
    }

    private function getProvinces(string $regionCode): array
    {
        if (Schema::hasTable('ph_provinces')) {
            $provinces = DB::table('ph_provinces')
                ->where('region_code', $regionCode)
                ->select('code', 'name')
                ->orderBy('name')
                ->get()
                ->toArray();

            if (!empty($provinces)) {
                return $provinces;
            }
        }

        return collect($this->loadLocationFile('provinces.json'))
            ->filter(fn (array $province) => ($province['regionCode'] ?? null) === $regionCode)
            ->map(fn (array $province) => [
                'code' => $province['code'],
                'name' => $province['name'],
            ])
            ->sortBy('name')
            ->values()
            ->all();
    }

    private function getCities(string $provinceCode): array
    {
        if (Schema::hasTable('ph_cities')) {
            $cities = DB::table('ph_cities')
                ->where('province_code', $provinceCode)
                ->select('code', 'name')
                ->orderBy('name')
                ->get()
                ->toArray();

            if (!empty($cities)) {
                return $cities;
            }
        }

        return collect($this->loadLocationFile('cities.json'))
            ->filter(fn (array $city) => ($city['provinceCode'] ?? null) === $provinceCode)
            ->map(fn (array $city) => [
                'code' => $city['code'],
                'name' => trim($city['name']),
            ])
            ->sortBy('name')
            ->values()
            ->all();
    }

    private function getBarangays(string $cityCode): array
    {
        if (Schema::hasTable('ph_barangays')) {
            $barangays = DB::table('ph_barangays')
                ->where('city_code', $cityCode)
                ->select('code', 'name')
                ->orderBy('name')
                ->get()
                ->toArray();

            if (!empty($barangays)) {
                return $barangays;
            }
        }

        return collect($this->loadLocationFile('barangays.json'))
            ->filter(fn (array $barangay) => ($barangay['cityCode'] ?? null) === $cityCode)
            ->map(fn (array $barangay) => [
                'code' => $barangay['code'],
                'name' => $barangay['name'],
            ])
            ->sortBy('name')
            ->values()
            ->all();
    }

    private function loadLocationFile(string $fileName): array
    {
        if (!array_key_exists($fileName, $this->locationCache)) {
            $path = base_path($fileName);

            if (!File::exists($path)) {
                $this->locationCache[$fileName] = [];
            } else {
                $decoded = json_decode(File::get($path), true);
                $this->locationCache[$fileName] = is_array($decoded) ? $decoded : [];
            }
        }

        return $this->locationCache[$fileName];
    }
}

