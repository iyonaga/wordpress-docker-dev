#!/bin/bash

WP_PATH=/var/www/html

# check if wordpress is installed
if `wp core is-installed --path=$WP_PATH`; then
  exit
fi

# wait until the wordpress download to complete
WAIT_TIMEOUT=120

while :
do
  if [ `wp find $WP_PATH --format=count --max_depth=1` -ne 0 -o $SECONDS -gt $WAIT_TIMEOUT ]; then
    sleep 5
    break
  fi
  sleep 1
done


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

wp core language update
