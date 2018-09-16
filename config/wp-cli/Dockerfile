FROM wordpress:cli

# Install `wp find` command
RUN php -d memory_limit=512M \
  "$(which wp)" package install wp-cli/find-command
