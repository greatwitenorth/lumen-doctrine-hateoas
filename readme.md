## Lumen Doctrine Hateoas Example
This Lumen project shows how to create an API that conforms to the HATEOAS principle.
 
## Getting started
```
git clone https://github.com/greatwitenorth/lumen-doctrine-hateoas.git
cd lumen-doctrine-hateoas
cp .env.example .env
composer install
php artisan doctrine:schema:create
php artisan db:seed
php artisan serve
```

Visit [http://localhost:8000](http://localhost:8000) and you can start traversing the links.

This project is setup in a way that it expects all routes to be named. This is due to the implementation of the URL Generator used by the HATEOAS package.