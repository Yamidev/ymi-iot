# Integração IOT YMI

Este documento mostra como fazer a instalação do YMI cliente em um device

Crie um diretório onde vai ficar hospedada a aplicação cliente do YMI IOT

Execute o seguindo comando no terminal

composer require ymi/iot


Depois adicione ao cron para executar o arquivo a cada 1 minuto

* * * * * php {diretorio}/vendor/ymi/iot/update.php > /dev/null

Crie a variavel gateway com o comando no terminal do linux

...
$ gateway=$(ifconfig -a | grep -ioE '([a-z0-9]{2}:){5}..' | head -1 ) !
...

Em seguida execute o comando abaixo para 

...
$ sed -i -e 's/MACADDR/'"$gateway"'/g' {diretorio}/vendor/ymi/iot/update.php !
...

Add an alias to your application client

...
$ vi .bash_profile !
...

...
$ alias ymi-client='php /Users/rafaelbertolli/ymi-iot/vendor/ymi/iot/input.php' !
...

After Save

...
$ source .bash_profile !
...








