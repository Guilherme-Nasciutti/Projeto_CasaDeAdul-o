<?php

namespace App\Controller;

class TimesDayENUM {
    const ONE_AM = 1;
    const TWO_AM = 2;
    const THREE_AM = 3;
    const FOUR_AM = 4;
    const FIVE_AM = 5;
    const SIX_AM = 6;
    const SEVEN_AM = 7;
    const EIGHT_AM = 8;
    const NINE_AM = 9;
    const TEN_AM = 10;
    const ELEVEN_AM = 11;
    const NOON = 12;
    const ONE_PM = 13;
    const TWO_PM = 14;
    const THREE_PM = 15;
    const FOUR_PM = 16;
    const FIVE_PM = 17;
    const SIX_PM = 18;
    const SEVEN_PM = 19;
    const EIGHT_PM = 20;
    const NINE_PM = 21;
    const TEN_PM = 22;
    const ELEVEN_PM = 23;
    const MIDNIGHT = 24;

    public static function findConstants($value = NULL) {
        $values = array(
            self::ONE_AM => "01H00 da manhã",
            self::TWO_AM => "02H00 da manhã",
            self::THREE_AM => "03H00 da manhã",
            self::FOUR_AM => "04H00 da manhã",
            self::FIVE_AM => "05H00 da manhã",
            self::SIX_AM => "06H00 da manhã",
            self::SEVEN_AM => "07H00 da manhã",
            self::EIGHT_AM => "08H00 da manhã",
            self::NINE_AM => "09H00 da manhã",
            self::TEN_AM => "10H00 da manhã",
            self::ELEVEN_AM => "11H00 da manhã",
            self::NOON => "12H00 da tarde",
            self::ONE_PM => "13H00 da tarde",
            self::TWO_PM => "14H00 da tarde",
            self::THREE_PM => "15H00 da tarde",
            self::FOUR_PM => "16H00 da tarde",
            self::FIVE_PM => "17H00 da tarde",
            self::SIX_PM => "18H00 da tarde",
            self::SEVEN_PM => "19H00 da noite",
            self::EIGHT_PM => "20H00 da noite",
            self::NINE_PM => "21H00 da noite",
            self::TEN_PM => "22H00 da noite",
            self::ELEVEN_PM => "23H00 da noite",
            self::MIDNIGHT => "24H00 da noite"
        );

        if ($value != NULL) {
            if (is_numeric($value)) {
                return isset($values[$value]) ? $values[$value] : NULL;
            }
            return array_search($value, $values);

        } else {
            foreach ($values as $id => $cVal) {
                $ret[$id] = $cVal;
            }
            return $ret;
        }
    }
}
