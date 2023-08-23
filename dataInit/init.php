<?php

// 此部分为开发时使用, 使用者无需关注
// mcc-mnc-com

main();

function main() {
    $lines = file(__DIR__ . DIRECTORY_SEPARATOR . 'mcc-mnc.dat');
    $mccCountryCodeData = $mccCountryISOData = $mccCountryNameData = $mncNetworkData = [];
    foreach ($lines as $index => $line) {
        if ($index > 0) {
            $data = explode("\t", trim($line));
            $mccCountryCodeData[$data[0]] = !empty($data[4]) ? $data[4] : "";
            $mccCountryISOData[$data[0]] = !empty($data[2]) ? $data[2] : "";
            $mccCountryNameData[$data[0]] = !empty($data[3]) ? $data[3] : "";
            $mncNetworkData[$data[0] . '_' . $data[1]] = !empty($data[5]) ? $data[5] : "";
        } else {
            echo $line;
        }
    }

    mccCountryCode($mccCountryCodeData);
    mccCountryISO($mccCountryISOData);
    mccCountryName($mccCountryNameData);
    mncNetwork($mncNetworkData);
}

function mccCountryCode($mccCountryCodeData) {
    $dbFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR . "DbMccCountryCode.php";
    toFile($mccCountryCodeData, $dbFile);
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
    file_put_contents($file, '    "' . $key . '" => "' . $value . "\",\n", FILE_APPEND);
}

function putFooter($file) {
    file_put_contents($file, "];\n", FILE_APPEND);
}