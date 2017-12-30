# RESTful API with Lumen

[![Build Status](https://travis-ci.org/pikarin/lumen-restful-api.svg?branch=master)](https://travis-ci.org/pikarin/lumen-restful-api)

RESTful API sederhana menggunakan [Lumen PHP Framework](https://github.com/laravel/lumen).

## Prasyarat

- composer
- PHP >= 7.0
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension

## Instalasi

- Clone repository ini
```
git clone https://github.com/pikarin/lumen-restful-api.git
```
- Masuk ke folder project
```
cd lumen-resful-api
```
- copy .env.example menjadi .env
```
cp .env.example .env
```
- install dependency dengan composer
```
composer install
```

## End point

Mendapatkan daftar author.

**URL** : `/api/authors`

**Method** : `GET`

Mendapatkan seorang author.

**URL** : `/api/authors/:id`

**Method** : `GET`

**URL Params**

- **Required :**
    - `id=[int]`

Membuat author baru

**URL** : `/api/authors`

**Method** : `POST`

**Params**

- **Required :**
    - `name=[string]`
    - `email=[string]`
    - `location=[string]`

Update author

**URL** : `/api/authors/:id`

**Method** : `PUT`

**URL Params**

- **Required :**
    - `id=[int]`

Hapus author

**URL** : `/api/authors/:id`

**Method** : `DELETE`

**URL Params**

- **Required :**
    - `id=[int]`

## Testing

Untuk testing cukup jalankan phpunit dari terminal
```
vendor/bin/phpunit
```

## License
MIT
