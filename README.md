# Integração IOT YMI

Este documento mostra como fazer a instalação do YMI cliente em um device

Crie um diretório onde vai ficar hospedada a aplicação cliente do YMI IOT

Execute o seguindo comando no terminal

  > composer require ymi/iot

Entre na pasta vendor/ymi/iot/ e crie o arquivo de licença do deviceid

  > ifconfig  | grep -o -E '([[:xdigit:]]{1,2}:){5}[[:xdigit:]]{1,2}' | head -1 > macaddr.txt

Depois adicione ao cron para executar o arquivo a cada 1 minuto

 > * * * * * php {diretorio}/vendor/ymi/iot/update.php > /dev/null

Add an alias to your application client

  > vi .bash_profile !

  > alias ymi-client='php {DIRINSTALATION}ymi-iot/vendor/ymi/iot/input.php' 

After Save

  > source .bash_profile 
  
Now, everytime you need you client just type

  > ymi-client








