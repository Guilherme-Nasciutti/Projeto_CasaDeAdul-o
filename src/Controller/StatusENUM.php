<?php

namespace App\Controller;

class StatusENUM {
    const INATIVO = 0;
    const ATIVO = 1;

    public static function findConstants($value = NULL) {
        $values = array(
            self::ATIVO => "Ativo",
            self::INATIVO => "Inativo"
        );

        if ($value !== NULL) {
            $value = (int) $value;
            if (is_numeric($value))
                return isset($values[$value]) ? $values[$value] : NULL;
            else
                return array_search($value, $values);
        } else {
            foreach ($values as $id => $cVal) {
                $ret[$id] = $cVal;
            }
            return $ret;
        }
    }
}
