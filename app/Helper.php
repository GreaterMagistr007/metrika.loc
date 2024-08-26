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
}
