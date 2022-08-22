<?php

function getUrl($title, $artist)
{
    $resource = curl_init();
    $apiUrl = "https://itunes.apple.com/search?term=" . urlencode($artist) . "-" . urlencode($title) . "&media=music&limit=1";
    $logo = "https://cdn.happyfm.eu/logos/logo-transparent.png";
    curl_setopt($resource, CURLOPT_URL, $apiUrl);
    curl_setopt($resource, CURLOPT_RETURNTRANSFER, 1);
    $curlResult = curl_exec($resource);
    $curlCode = curl_getinfo($resource, CURLINFO_HTTP_CODE);
    curl_close($resource);
    $json_data = json_decode($curlResult,true);
    $resultCount = $json_data['resultCount'];
    if($curlCode >= 200 && $curlCode < 300 && $resultCount == 1){
        echo "<br>" . $curlCode . " - " . $json_data['results']['0']['artworkUrl100'] . " - results: " . $resultCount;
        return $json_data['results']['0']['artworkUrl100'];
    }
    return $logo;
}

echo "<br><img src=" . getUrl("Zukunft", "Raf Camora") . ">";
echo "<br><img src=" . getUrl("Zinit", "Raf Camora") . ">";
echo "<br><img src=" . getUrl("Blaues Licht", "Raf Camora") . ">";

?>