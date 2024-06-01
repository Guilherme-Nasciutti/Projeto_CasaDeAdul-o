<?php

namespace App\Controller;

class TypeRolesENUM {
    const ADMIN = 1;
    const INSTRUCTOR = 2;
    const HOMELESS = 3;
    const OUTRO = 4;

    public static function findConstants($value = NULL) {
        $values = array(
            self::ADMIN => "Administrador(a)",
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
