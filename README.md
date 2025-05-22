# Architect Labs

This project is a take-home assessment for Thrivecart, focusing on problem solving, design, and general software engineering skills.

## Project Structure

```
.
├── src/                # Source code
│   ├── Basket.php
│   ├── contexts/
│   ├── data/
│   ├── interfaces/
│   └── strategies/
├── tests/              # PHPUnit test cases
├── vendor/             # Composer dependencies
├── composer.json
├── phpunit.xml
└── .gitignore
```

## Requirements

- PHP 8.1 or higher
- Composer

## Setup

1. **Clone the repository:**
   ```sh
   git clone <repository-url>
   cd architect-labs
   ```

2. **Install dependencies:**
   ```sh
   composer install
   ```

## Running Tests

The project uses [PHPUnit](https://phpunit.de/) for testing.

To run all tests:
```sh
composer test
```
or directly:
```sh
vendor/bin/phpunit
```

## Design Choices and Assumptions
- The data is a simple dictionary of product code and their prices.
- The `Basket` class is the main entry point for adding items and calculating totals as required by the test.
- Use of interfaces and strategies to allow for easy extension of logic and new features.
- Current implementation requires the different strategies to be defined during the instantiation of the `Basket` class, there is no dynamic switching. However, this can be easily modified to allow for dynamic switching of strategies.
- No external dependencies are required except for PHPUnit (for testing), the project is self-contained.
- Test coverage is provided for all major features and strategies, as there was no explicit requirement for high coverage, the focus was on functionality and correctness.
- More complex delivery tiers and offers can be added to the project by creating the respective strategies. Allowing for easy extensibility.