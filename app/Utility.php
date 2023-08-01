<?php

namespace app;

/**
 * La classe Utility permet de faire quelques opérations 
 * sur les données à afficher sur les pages de l'application
 *
 * @author Ketsia
 */
class Utility {
    // Génerer des caractères alphanumériques aléatoires
    public static function randomStr(
        int $length = 10,
        string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'
    ): string {
        if ($length < 1) {
            throw new \RangeException("La longueur des caractères doit être positive.");
        }

        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;

        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }

        return implode('', $pieces);
    }

    public static function formatNumber($number) : string {
        return number_format($number, 0, ',', ' ');
    }
}
