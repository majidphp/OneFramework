if [ $1 == 'cron' ]; then
    php Crons/index.php &
fi
php -S 0.0.0.0:80