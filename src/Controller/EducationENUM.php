<?php

namespace App\Controller;

class EducationENUM {
    const COMPLETE_FUNDAMENTAL = 1;
    const INCOMPLETE_FUNDAMENTAL = 2;
    const COMPLETE_MEDIUM = 3;
    const INCOMPLETE_MEDIUM = 4;
    const COMPLETE_GRADUATED = 5;
    const INCOMPLETE_GRADUATED = 6;
    const SPECIALIZATION = 7;
    const MASTER = 8;
    const DOCTORATE = 9;
    const NOT = 10;

    public static function findConstants($value = NULL) {
        $values = array(
            self::COMPLETE_FUNDAMENTAL => "Ensino fundamental completo",
            self::INCOMPLETE_FUNDAMENTAL => "Ensino fundamental incompleto",
            self::COMPLETE_MEDIUM => "Ensino  médio completo",
            self::INCOMPLETE_MEDIUM => "Ensino médio incompleto",
            self::COMPLETE_GRADUATED => "Ensino superior completo",
            self::INCOMPLETE_GRADUATED => "Ensino superior incompleto",
            self::SPECIALIZATION => "Especialização",
            self::MASTER => "Mestrado",
            self::DOCTORATE => "Não informado",
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
