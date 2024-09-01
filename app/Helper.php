<?php

namespace App;

class Helper
{
    public static $randomInt = [];

    /**
     * Возвращает случайное неповторимое целое число
     * @return int
     * @throws \Exception
     */
    public static function getRandomInt()
    {
        $min = 1;
        $max = 9999;

        $rnd = random_int($min, $max);

        while (in_array($rnd, self::$randomInt)) {
            $rnd = random_int($min, $max);
        }

        self::$randomInt[] = $rnd;

        return $rnd;
    }

    public static function onlyDigits($string)
    {
        $string = (string)$string;

        return preg_replace('/[^0-9]/', '', $string);
    }

    /**
     * Форматирует номер телефона
     *
     * @param string $phoneNumber
     * @return string
     */
    public static function formatPhoneNumber($phoneNumber)
    {
        $phoneNumber = (string)$phoneNumber;

        // Удаляем все нецифровые символы из номера
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // По умолчанию номер невалидный
        $result = false;

        // Проверяем длину номера
        if (strlen($phoneNumber) == 10) {
            // Десятизначный номер, добавляем код страны
            $result = "+7 (" .
                substr($phoneNumber, 0, 3) .
                ") " .
                substr($phoneNumber, 3, 3) .
                "-" .
                substr($phoneNumber, 6, 2) .
                "-" .
                substr($phoneNumber, 8, 2);
        }
        if (strlen($phoneNumber) == 11) {
            // Одиннадцатизначный номер с кодом страны "8", удаляем "8" и добавляем "+7"
            $result = "+7 (" .
                substr($phoneNumber, 1, 3) .
                ") " .
                substr($phoneNumber, 4, 3) .
                "-" .
                substr($phoneNumber, 7, 2) .
                "-" .
                substr($phoneNumber, 9, 2);
        }

        return $result;
    }
}
