# L5-polish-verify-rules
polish Validation rules for Laravel 5 Validator

# Setup
Add the package to the require section of your composer.json and run `composer update`

    "kduma/polish-validation": "~1.0"

Then add the Service Provider to the providers array in `config/app.php`:

    'KDuma\Validator\PolishValidatorRulesServiceProvider',


# Usage
You have 2 new Validator rules:

- pesel - Checks if number is valid PESEL number
- identity_card - Checks if number is polish identity document number

# Translations
Use ready polish translations to paste in `resources/lang/pl/validation.php` file:

	"pesel" => 'Podany numer PESEL jest nieprawidłowy',
	"identity_card" => 'Podany numer dowodu osobistego jest nieprawidłowy',
	

# Code Authors

A special thanks to authors of [phpedia.pl](http://phpedia.pl/wiki/Walidacja_numeru_PESEL), an original pesel validator creators that this package is based on
and [Mariusz Tomaszewski (on algorytm.org)](http://www.algorytm.org/numery-identyfikacyjne/numer-dowodu-osobistego/do-php.html) who wrote original identity card checker.

# Packagist
View this package on Packagist.org: [kduma/polish-validation](https://packagist.org/packages/kduma/polish-validation)