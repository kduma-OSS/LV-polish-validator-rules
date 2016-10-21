<?php

namespace KDuma\Validator;

use Illuminate\Support\ServiceProvider;

class PolishValidatorRulesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Validator::extend('pesel', function ($attribute, $value, $parameters) {
            if (! preg_match('/^[0-9]{11}$/', $value)) { //sprawdzamy czy ciąg ma 11 cyfr
                return false;
            }

            $arrSteps = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3]; // tablica z odpowiednimi wagami
            $intSum = 0;
            for ($i = 0; $i < 10; $i++) {
                $intSum += $arrSteps[$i] * $value[$i]; //mnożymy każdy ze znaków przez wagć i sumujemy wszystko
            }
            $int = 10 - $intSum % 10; //obliczamy sumć kontrolną
            $intControlNr = ($int == 10) ? 0 : $int;
            if ($intControlNr == $value[10]) { //sprawdzamy czy taka sama suma kontrolna jest w ciągu
                return true;
            }

            return false;
        });

        \Validator::extend('identity_card', function ($attribute, $_identity_card, $parameters) {
            //sprawdz dlugosc podanego numeru
            if (strlen($_identity_card) != 9) {
                return false;
            }
            $identity_card = strtoupper($_identity_card);
            //tablica wartosci znakow
            $def_value = ['0' => 0, '1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9,
                'A' => 10, 'B' => 11, 'C' => 12, 'D' => 13, 'E' => 14, 'F' => 15, 'G' => 16, 'H' => 17, 'I' => 18, 'J' => 19,
                'K' => 20, 'L' => 21, 'M' => 22, 'N' => 23, 'O' => 24, 'P' => 25, 'Q' => 26, 'R' => 27, 'S' => 28, 'T' => 29,
                'U' => 30, 'V' => 31, 'W' => 32, 'X' => 33, 'Y' => 34, 'Z' => 35, ];
            //tablica wag
            $importance = [7,  3,  1,  0,  7,  3,  1,  7,  3];
            //oblicz sume kontrolna
            $identity_card_sum = 0;

            for ($i = 0; $i < 9; $i++) {
                if ($i < 3 && $def_value[$identity_card[$i]] < 10) {
                    return false;
                } elseif ($i > 2 && $def_value[$identity_card[$i]] > 9) {
                    return false;
                }
                $identity_card_sum += ((int) $def_value[$identity_card[$i]]) * $importance[$i];
            }
            //sprawdz wartosc sumy kontrolnej
            if ($identity_card_sum % 10 != $identity_card[3]) {
                return false;
            }

            return true;
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
