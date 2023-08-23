<?php

namespace Lit\MccMnc;

class Mnc
{
    const DB_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR;

    /**
     * mnc 转 运营商名称
     * @date 2023/8/23
     * @param string $mcc
     * @return string
     * @author litong
     */
    public static function toNetwork($mcc, $mnc) {
        $data = include(self::DB_DIR . 'DbMncNetwork.php');
        return isset($data[$mcc . '_' . $mnc]) ? $data[$mcc . '_' . $mnc] : "";
    }

}