<?php

namespace App\Controller;

class TypeRolesENUM {
    const INSTRUCTOR = 1;
    const HOMELESS = 2;
    const OUTRO = 3;

    public static function findConstants($value = NULL) {
        $values = array(
            self::INSTRUCTOR => "Instrutor(a)",
            self::HOMELESS => "Morador(a) de rua",
            self::OUTRO => "Outro"
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
