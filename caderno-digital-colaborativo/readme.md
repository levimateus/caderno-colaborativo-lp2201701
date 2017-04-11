
//INSTALAR XAMPP 
Adicionar a variavel de ambiente PATH (do sistema) os seguintes valores

	C:\xampp\mysql\bin
	C:\xampp\php;


//INSTALAR COMPOSER
https://getcomposer.org/download/

// Acessar a pasta do projeto laravel, dentro dela abrir um GITBASH e executar

composer install
- aqui pode demorar, vai baixar as dependencias 

php artisan --version 
- para verificar a versao instalada do lavavel

php artisan key:generate
- para gerar a chave de applicacao que o laravel precisa.

// dentro da pasta,buscar pelo arquivo: ".env.example" e salvar como ".env"  modificar 

DB_DATABASE=cadernocolaborativo
DB_USERNAME=root


//para subir o server
php artisan serve

//criar estrutura de authenticacao
php artisan make:auth