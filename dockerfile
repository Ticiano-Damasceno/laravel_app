FROM php:8.3-apache

# Atualiza pacotes
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev

# Instala Node.js 20 (LTS)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs

# Extensões necessárias para Laravel
RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    mysqli \
    zip

# Habilita mod_rewrite do Apache
RUN a2enmod rewrite

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Cria usuário com mesmo UID/GID do seu WSL
RUN groupadd -g 1000 tadamasceno && \
    useradd -u 1000 -g tadamasceno -m tadamasceno

# Faz o Apache rodar como esse usuário (em vez de www-data)
ENV APACHE_RUN_USER=tadamasceno
ENV APACHE_RUN_GROUP=tadamasceno


# Define diretório padrão
WORKDIR /var/www/html

# Garante posse da pasta (importante: antes do volume ser montado)
RUN chown -R tadamasceno:tadamasceno /var/www/html