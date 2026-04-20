<?php
// Pateros is indeed part of NCR/Metro Manila
$cities = json_decode(file_get_contents('cities.json'), true);

// Update Pateros specifically
foreach ($cities as &$city) {
    if ($city['code'] === '1381701000' && strpos($city['name'], 'Pateros') !== false) {
        echo "Updating: " . $city['name'] . " (code: " . $city['code'] . ")\n";
        echo "  From: " . $city['provinceCode'] . "\n";
        $city['provinceCode'] = '1300000000';
        echo "  To: " . $city['provinceCode'] . "\n";
    }
}

file_put_contents('cities.json', json_encode($cities, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "\nPateros updated successfully!\n";
