<?php
namespace KDuma\Validator;

use Illuminate\Contracts\Validation\Rule;


class PolishIdentityCardNumberRule implements Rule
{
    public function passes($attribute, $value)
    {
        //sprawdz dlugosc podanego numeru
        if (strlen($value) != 9) {
            return false;
        }
        $identity_card = strtoupper($value);
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
    }

    public function message()
    {
        return trans('validation.identity_card');
    }
}
