<?php

namespace Lit\MccMnc;

class Mcc
{
    const DB_DIR = __DIR__ . DIRECTORY_SEPARATOR . 'db' . DIRECTORY_SEPARATOR;

    /**
     * mcc 转 国家名称
     * @date 2023/8/23
     * @param string $mcc
     * @return string
     * @author litong
     */
    public static function toCountryName($mcc) {
        $data = include(self::DB_DIR . 'DbMccCountryName.php');
        return isset($data[$mcc]) ? $data[$mcc] : "";
    }

    /**
     * mcc 转 国家iso简码
     * @date 2023/8/23
     * @param string $mcc
     * @return string
     * @author litong
     */
    public static function toCountryISO($mcc) {
        $data = include(self::DB_DIR . 'DbMccCountryISO.php');
        return isset($data[$mcc]) ? $data[$mcc] : "";
    }

    /**
     * mcc 转 国际区号
     * @date 2023/8/23
     * @param string $mcc
     * @return string
     * @author litong
     */
    public static function toCountryCode($mcc) {
        $data = include(self::DB_DIR . 'DbMccCountryCode.php');
        return isset($data[$mcc]) ? $data[$mcc] : "";
    }

}