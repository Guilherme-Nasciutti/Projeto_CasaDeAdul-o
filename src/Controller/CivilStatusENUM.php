<?php

namespace App\Controller;

class CivilStatusENUM {
    const SINGLE = 1;
    const MARRIED = 2;
    const SEPARETED = 3;
    const DIVORCED = 4;
    const WIDOWED = 4;

    public static function findConstants($value = NULL) {
        $values = array(
            self::SINGLE => "Solteiro(a)",
            self::MARRIED => "Casado(a)",
            self::SEPARETED => "Separado(a)",
            self::DIVORCED => "Divorciado(a)",
            self::WIDOWED => "Viúvo(a)"
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
