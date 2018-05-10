#!/bin/sh
echo "Adicionando YMI IOT client para rodar no cron de 1 em 1 minuto"

DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

crontab -l > mycron
#echo new cron into cron file
echo "* * * * * php $DIR/vendor/ymi/iot/update.php > /dev/null" >> mycron
#install new cron file
crontab mycron
rm mycron
