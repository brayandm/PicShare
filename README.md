# PicShare
Social network to share pictures and make friends

## Author
- Brayan Durán Medina ([@brayandm](https://www.github.com/brayandm))

## Dependencies
- [PHP 8.1](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/)

## Installation instructions

Cloning the repository:

```bash
  git clone https://github.com/brayandm/PicShare.git
```

Changing the directory:

```bash
  cd PicShare
```

Installing dependencies:

```bash
  composer install
```

Mounting the server:

```bash
  ./vendor/bin/sail up
```

Seeding the database:

```bash
  ./vendor/bin/sail artisan migrate:fresh --seed 
```
