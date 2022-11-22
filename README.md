# PicShare
Social network to share pictures and make friends

## Author
- Brayan Durán Medina ([@brayandm](https://www.github.com/brayandm))

## Dependencies
- [PHP 8.1](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/)

## Installation instructions

1 - Cloning the repository:

```bash
  git clone https://github.com/brayandm/PicShare.git
```

2 - Changing the directory:

```bash
  cd PicShare
```

3 - Installing dependencies:

```bash
  composer install
```

4 - Copying .env.example to .env

```bash
   cp .env.example .env
```

5 - Mounting the server:

```bash
  ./vendor/bin/sail up -d
```

6 - Generating App key:

```bash
   ./vendor/bin/sail artisan key:generate
```

7 - Seeding the database:

```bash
  ./vendor/bin/sail artisan migrate:fresh --seed 
```
