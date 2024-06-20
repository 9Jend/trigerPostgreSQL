## Instaling

* Clone the repo

  ```[bash]
    git clone https://github.com/9Jend/trigerPostgreSQL
  ```

* Copy env file

  ```[bash]
    cp .env.example .env
  ```
* Install composer dependencies

  ```[bash]
    composer install --ignore-platform-reqs
  ```

* Change port from .env and run docker compose

  ```[bash]
    ./vendor/bin/sail up -d
  ```

* Run migration

  ```[bash]
   ./vendor/bin/sail artisan migrate
  ```
* Generate key

  ```[bash]
    ./vendor/bin/sail artisan key:generate
  ```
* Install npm dependencies

  ```[bash]
    ./vendor/bin/sail npm install 
  ```
* Build npm 
  ```[bash]
    ./vendor/bin/sail npm run build 
  ```

## testing
* Run migration for test

  ```[bash]
    ./vendor/bin/sail artisan migrate --env=testing
  ```
* Run test
    ```[bash]
    ./vendor/bin/sail artisan test
    ```
