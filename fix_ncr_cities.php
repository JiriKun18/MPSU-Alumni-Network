<?php
// Load cities
$cities = json_decode(file_get_contents('cities.json'), true);

// NCR cities that need to be updated (all have codes starting with 138)
$ncr_city_codes = [
    '1380600000', // City of Manila
    '1380500000', // City of Mandaluyong
    '1380700000', // City of Marikina
    '1381200000', // City of Pasig
    '1381300000', // Quezon City
    '1381400000', // City of San Juan
    '1380100000', // City of Caloocan
    '1380400000', // City of Malabon
    '1380900000', // City of Navotas
    '1381600000', // City of Valenzuela
    '1380200000', // City of Las Piñas
    '1380300000', // City of Makati
    '1380800000', // City of Muntinlupa
    '1381000000', // City of Parañaque
    '1381100000', // Pasay City
    '1381500000', // City of Taguig
];

// Update cities to map to Metro Manila (1300000000)
$updates = 0;
foreach ($cities as &$city) {
    if (in_array($city['code'], $ncr_city_codes)) {
        echo "Updating: " . $city['name'] . " (code: " . $city['code'] . ")\n";
        $city['provinceCode'] = '1300000000';
        $updates++;
    }
}

// Write back to file
file_put_contents('cities.json', json_encode($cities, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

echo "\nTotal updated: $updates cities\n";
echo "File saved successfully!\n";
