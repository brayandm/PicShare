# PicShare
Social network to share pictures and make friends

## Author
- Brayan Durán Medina ([@brayandm](https://www.github.com/brayandm))

## Dependencies
- [PHP 8.1](https://www.php.net/)
- [Composer 2.4](https://getcomposer.org/)
- [Docker 20.10](https://www.docker.com/)
- [Npm 8.19](https://www.npmjs.com/)

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

7 - Installing npm packages:

```bash
   npm install
```

8 - Building npm packages:

```bash
   npm run build
```

9 - Seeding the database:

```bash
  ./vendor/bin/sail artisan migrate:fresh --seed 
```
