# Integração IOT YMI

Este documento mostra como fazer a instalação do YMI cliente em um device

# Requisitos

* PHP CLI 7+
* lsusb 

# Instalação

Crie um diretório onde vai ficar hospedada a aplicação cliente do YMI IOT

Execute o seguindo comando no terminal

  > composer require ymi/iot

Entre na pasta vendor/ymi/iot/ e crie o arquivo de licença do deviceid

  > ifconfig  | grep -o -E '([[:xdigit:]]{1,2}:){5}[[:xdigit:]]{1,2}' | head -1 > macaddr.txt

Depois adicione ao cron para executar o arquivo a cada 1 minuto

 > ymi-client

Add an alias to your application client

  > vi .bash_profile !

  > alias ymi-client='php {DIRINSTALATION}/input.php' 

After Save

  > source .bash_profile 
  
# How to test
  
Now, everytime you need you client just type

  > ymi-client
  
He will open a background consume.php to receive messages from rabbitMq

#examples

Queue message to print

> {"command" : "php {dir}print.php '[\"{\"text\" : \"rafael\"}\",\"{\"qrcode\":\"joaozinho\"}\",\"{\"barcode\":\"sabrina\"}\",\"{\"text\":\"texto2\"}\"]' | lp"}

>> {dir} is replaced with the IOT client directory

Generate barcode to barcode.png 

> php barcode_noprint.php {text_to_barcode} {label_to_barcode*optional} {type_barcode*optional}

Generate qrcode to qrcode.png

> php qrcode '{text_to_qrcode|' '{setLabel*optional}' {setSize*optional} {setFontSize*optional} {SetPadding*optional}







