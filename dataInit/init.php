<?php

// 此部分为开发时使用, 使用者无需关注
// mcc-mnc-net

main();

function main() {
    $mccCountryCodeData = $mccCountryISOData = $mccCountryNameData = $mncNetworkData = [];
    expFile($mccCountryCodeData, $mccCountryISOData, $mccCountryNameData, $mncNetworkData);

    mccCountryISO($mccCountryISOData);
    mccCountryName($mccCountryNameData);
    mncNetwork($mncNetworkData);
}

function expFile(&$mccCountryCodeData, &$mccCountryISOData, &$mccCountryNameData, &$mncNetworkData) {
    $fp = fopen(__DIR__ . DIRECTORY_SEPARATOR . 'mcc-mnc.csv', 'r');
    $index = 0;
    while (!feof($fp)) {
        $index++;
        $data = fgetcsv($fp, 0, ';');
        if ($index > 1) {
            $mccCountryISOData[$data[0]] = expValue($data[5]);
            $mccCountryNameData[$data[0]] = !empty($data[4]) ? "'" . addslashes($data[4]) . "'" : "''";
            $mncNetworkData[$data[0] . '_' . $data[1]] = !empty($data[6]) ? "'" . addslashes($data[6]) . "'" : "''";
        } else {
            var_export($data);
        }
    }
}

function expValue($value) {
    $expValue = explode('/', $value);
    $expValue = array_map('strtolower', $expValue);
    $tmp = var_export($expValue, true);
    return str_replace("\n", "", $tmp);
}

function mccCountryISO($mccCountryISOData) {
    $dbFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . "DbMccCountryISO.php";
    toFile($mccCountryISOData, $dbFile);
}

function mccCountryName($mccCountryNameData) {
    $dbFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . "DbMccCountryName.php";
    toFile($mccCountryNameData, $dbFile);
}

function mncNetwork($mncNetworkData) {
    $dbFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . "DbMncNetwork.php";
    toFile($mncNetworkData, $dbFile);
}

function toFile($data, $dbFile) {
    putHeader($dbFile);
    foreach ($data as $key => $value) {
        putContent($dbFile, $key, $value);
    }
    putFooter($dbFile);
}

function putHeader($file) {
    file_put_contents($file, "<?php\nreturn [\n");
}

function putContent($file, $key, $value) {
    file_put_contents($file, "    '" . $key . "' => " . $value . ",\n", FILE_APPEND);
}

function putFooter($file) {
    file_put_contents($file, "];\n", FILE_APPEND);
}
