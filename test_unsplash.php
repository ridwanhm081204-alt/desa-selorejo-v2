<?php
function getUnsplashId($query) {
    $url = "https://unsplash.com/napi/search/photos?query=" . urlencode($query) . "&per_page=1";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
    $data = curl_exec($ch);
    curl_close($ch);
    $json = json_decode($data, true);
    return $json['results'][0]['urls']['regular'] ?? null;
}

echo "ATV: " . getUnsplashId("motocross") . "\n";
echo "Kesenian: " . getUnsplashId("indonesian culture") . "\n";
echo "Karnaval: " . getUnsplashId("fruit festival") . "\n";
