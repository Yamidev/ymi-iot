# Integração IOT YMI

Este documento mostra como fazer a instalação do YMI cliente em um device

Crie um diretório onde vai ficar hospedada a aplicação cliente do YMI IOT

Execute o seguindo comando no terminal

composer require ymi/iot


Depois adicione ao cron para executar o arquivo a cada 1 minuto

* * * * * php {diretorio}/vendor/ymi/iot/update.php > /dev/null


