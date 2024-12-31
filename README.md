Germany Income Tax Calculator

# Description
Calculate the income tax according to the stored formula for the provided year.

Tax amounts are returned as float. You can round them down to the next integer manually.

# Installation
``
composer require hankit/germany-income-tax-calculator
``

# Example usage
```
use HankIT\GermanyIncomeTaxCalculator\GermanyIncomeTaxCalculator;

$calculator = new GermanyIncomeTaxCalculator;

print($calculator->calculate(2024, 50000);
```

# Testing
This library has 100% test coverage and aims to keep it that way.

You can run tests using phpunit:

``
phpunit
``

# License
See LICENSE file
