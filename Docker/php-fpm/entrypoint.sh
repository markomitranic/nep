#!/bin/bash
set -e

chown -R www-data:www-data /usr/share/nginx/html
php-fpm -F
