# ForEx Variations Analyzer

One Paragraph of project description goes here

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

Create an account at https://fixer.io/product and get their Access Key.

### Installing

On your www directory clone the repo by entering this:

```
git clone https://github.com/timkolm/ForExVariationsAnalyzer.git ForExVariationsAnalyzer
```

Now cd to the newly created folder

```
cd ForExVariationsAnalyzer
```

and install Laravel framework

```
composer install -vvv
```

create a .env file

```
cp .env.example .env
```

and generate an Application key

```
php artisan key:generate
```

Important! Open the newly created .env file and edit it according to your server setup.
Add this line to your eviromnent

```
FIXER_IO_ACCESS_KEY={your key}
```
Replace {your key} with the Key you've got from fixer.io

## Running the tests

Just enter 
```
phpunit
```

## Deployment

To enter the Analyze page put this into your browser's address line: www.yourdomain.com/analyze-it

## Built With

* [Laravel](https://laravel.com) - The web framework used

## Authors

* **Timkolm** - *Initial work* - [timkolm(doggie)real_name_of_the_google's_mail.and_so_on]
