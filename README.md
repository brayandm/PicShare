# PicShare
Social network to share pictures and make friends

## Author
- Brayan Durán Medina ([@brayandm](https://www.github.com/brayandm))

## Dependencies
- [PHP 8.1](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Docker](https://www.docker.com/)

## Installation instructions
```bash
  git clone https://github.com/brayandm/PicShare.git
```

```bash
  cd PicShare
```

```bash
  composer install
```

```bash
  ./vendor/bin/sail up
```

```bash
  ./vendor/bin/sail artisan migrate:fresh --seed 
```
