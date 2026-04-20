<?php
$cities = json_decode(file_get_contents('cities.json'), true);

// Find Pateros
$pateros = array_filter($cities, fn($c) => strpos($c['name'], 'Pateros') !== false);

foreach ($pateros as $p) {
    echo "Pateros:\n";
    echo "  Code: " . $p['code'] . "\n";
    echo "  Name: " . $p['name'] . "\n";
    echo "  Province Code: " . $p['provinceCode'] . "\n";
}

// Also check all cities in 1300000000 now
echo "\n\nAll cities in Metro Manila (1300000000):\n";
$metro = array_filter($cities, fn($c) => $c['provinceCode'] === '1300000000');
foreach ($metro as $c) {
    echo "- " . $c['name'] . " (code: " . $c['code'] . ")\n";
}
