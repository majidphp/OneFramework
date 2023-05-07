if [ $1 == 'cron' ]; then
    cd Crons
    php index.php &
    cd ../
fi
php -S 0.0.0.0:80