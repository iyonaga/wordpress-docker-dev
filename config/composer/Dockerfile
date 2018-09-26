FROM composer

# make composer fast in japan
RUN composer config -g repositories.packagist composer https://packagist.jp && \
  composer global require hirak/prestissimo
