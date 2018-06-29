# BiasharaPlus

Biashara plus is a well crafted and simple to use app that aims to help business owners at Forever to access their products pricelist and removing all the go betweens that slow you down so they can use the extra time to do some more biashara.

## Setup

- Copy configuration

  ```sh
  $ cp .env.example .env
  ```

- Refresh migration every time you pull changes

  ```sh
  $ composer update
  $ php artisan optimize
  $ php artisan migrate:refresh --seed
  ```

- If migrations fails to refresh, run

  ```sh
  $ php artisan migrate:fresh --seed
  $ heroku run:detached php artisan migrate:fresh --seed
  ```

- Ensure file storage is enables

  ```sh
  $ php artisan storage:link
  ```

- Compile assets

  ```sh
  $ yarn install
  $ yarn watch
  ```

## Seed Specific File

```sh
$ composer dump-autoload
$ php artisan db:seed --class=UsersTableSeeder
```

## Countries

```sh
We use the following numbers instead of country names:

| Country       | Number        |
| ------------- |:-------------:|
| Tanzania      | 0             |
| Kenya         | 1             |
| Uganda        | 2             |
```

## Reviews

- <https://laravel.com/docs>
- <https://developers.google.com/chart>
- <https://www.npmjs.com/package/google-charts>
- <https://vuejs.org/v2/guide>

## Disclaimer

Biashara plus is not in any way affiliated with agencies such as forever living, oriflame or GNLD
