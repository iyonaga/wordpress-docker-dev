#!/bin/sh

wp core install \
  --path="/var/www/html" \
  --url="https://localhost" \
  --title="${SITE_TITLE}" \
  --admin_user=${ADMIN_USER} \
  --admin_password=${ADMIN_PASS} \
  --admin_email=${ADMIN_EMAIL}

wp core language install ja --activate
wp option update timezone_string "Asia/Tokyo"
wp option update date_format 'Y年n月j日'
wp option update time_format 'H:i'

wp plugin uninstall akismet hello
wp plugin install wp-multibyte-patch --activate

wp core language update
