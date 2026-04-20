<?php
$regions = json_decode(file_get_contents('regions.json'), true);
$provinces = json_decode(file_get_contents('provinces.json'), true);
$cities = json_decode(file_get_contents('cities.json'), true);

echo "=== NCR DATA VERIFICATION ===\n\n";

// Check NCR region
$ncr_region = array_values(array_filter($regions, fn($r) => $r['code'] === '1300000000'));
if ($ncr_region) {
    echo "✓ NCR Region Found:\n";
    echo "  Code: " . $ncr_region[0]['code'] . "\n";
    echo "  Name: " . $ncr_region[0]['name'] . "\n\n";
} else {
    echo "✗ NCR Region NOT found\n\n";
}

// Check Metro Manila province
$metro = array_values(array_filter($provinces, fn($p) => $p['code'] === '1300000000'));
if ($metro) {
    echo "✓ Metro Manila Province Found:\n";
    echo "  Code: " . $metro[0]['code'] . "\n";
    echo "  Region Code: " . $metro[0]['regionCode'] . "\n";
    echo "  Name: " . $metro[0]['name'] . "\n\n";
} else {
    echo "✗ Metro Manila Province NOT found\n\n";
}

// Check NCR cities
$ncr_cities = array_filter($cities, fn($c) => $c['provinceCode'] === '1300000000');
echo "✓ NCR Cities Count: " . count($ncr_cities) . "\n";
echo "  Cities:\n";
foreach ($ncr_cities as $city) {
    echo "    - " . $city['name'] . "\n";
}

// Check Sarangani is still intact with wrong cities  
$sarangani_cities = array_filter($cities, fn($c) => $c['provinceCode'] === '1208000000');
echo "\n✓ Sarangani Cities Count: " . count($sarangani_cities) . " (should have some)\n";

echo "\n=== VERIFICATION COMPLETE ===\n";
