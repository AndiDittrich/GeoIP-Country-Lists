<?php
/**
 * Convert GeoLite CSV file to Country-IP Lists
 */

$countryLists = array();

// data-source
$dataSource = 'GeoLite2/';

// get latest datasource dir
$databases = scandir($dataSource, SCANDIR_SORT_DESCENDING);
$dataSource .= $databases[0].'/';

// data destination
$outputDir = 'Build/';

// Location <> ID Processing
// -------------------------------------------------------------------------------

// ready country list - get "geoname_od" <> iso code relation
$locationHandle = fopen($dataSource.'GeoLite2-Country-Locations-en.csv', 'r');

// drop header
fgets($locationHandle);

// iterate over location
while (($data = fgetcsv($locationHandle, 1000, ',')) !== false){
    // extract vars
    $geonameID = $data[0];
    $countryCode = $data[4];
    $continentName = $data[3];

    // country code list
    if (!empty($geonameID) && !empty($countryCode)){
        // push items to list and open file handle
        $countryLists[$geonameID] = array(
            'isocode' => $countryCode,
            'handle' => fopen($outputDir.$countryCode.'.txt', 'w')
        );
    }
}

// close location handle
fclose($locationHandle);

// IP Block Processing
// -------------------------------------------------------------------------------

// open country ip list
$dataHandle = fopen($dataSource.'GeoLite2-Country-Blocks-IPv4.csv', 'r');

// drop header
fgets($dataHandle);

// iterate over ip list
while (($data = fgetcsv($dataHandle, 1000, ',')) !== false) {
    // extract vars
    $cidr = $data[0];
    $geonameID = $data[1];
    $geonameCID = $data[2];

    // $geonameID given ? (assigned / registered)
    $geoid = (empty($geonameID) ? $geonameCID : $geonameID);

    // push ip to country list
    if (isset($countryLists[$geoid])) {
        fwrite($countryLists[$geoid]['handle'], trim($cidr) . "\n");
    }
}

// close data handle
fclose($dataHandle);

// Close filestreams
// -------------------------------------------------------------------------------
foreach ($countryLists as $id => $data){
    fclose($data['handle']);
}