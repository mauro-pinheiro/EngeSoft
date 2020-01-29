Passos para instalação
---

### GIT

* Faça o clone do repositório.
  * De preferência no diretório público do XAMPP <code>(C:/xampp/htdocs)</code>
  
### ARQUIVOS

* Após fazer o clone do código, abra um cmd no diretório.
  * Atalho do VsCode: <code>Ctrl + Shift + '</code>
  * Execute os seguintes comandos:
```PHP
composer install -vvv
```
```PHP
copy .ht_Outros\.env.example-pre .env
```

* Caso necessário altere os seguintes campos no arquivo .env
```PHP
DB_HOST=localhost   //Informe o host.
DB_PORT=3306    //Informe a porta.
DB_DATABASE=db //Informe o nome da base.
DB_USERNAME=user //Informe o usuário.
DB_PASSWORD=pass    //Informe a senha.
MAIL_USERNAME=null  //Seu e-mail corporativo.
MAIL_PASSWORD=null  //Sua senha do email.
```

* Faça migração do db
```PHP
php artisan migrate
```

* Faça o seed do db
```PHP
php artisan db:seed
```

* Configure a rota de acesso.
  * Abra o arquivo <code>C:\xampp\apache\conf\extra\httpd-vhosts.conf</code>
  * Adicione as segintes linhas no arquivo:
```SH
<VirtualHost *:80>
    ##ServerAdmin webmaster@dummy-host2.example.com
    DocumentRoot "C:/xampp/htdocs/novosgi/public"
    ##ServerName dummy-host2.example.com
    ##ErrorLog "logs/dummy-host2.example.com-error.log"
    ##CustomLog "logs/dummy-host2.example.com-access.log" common
</VirtualHost>
```

### Utilização

* Inicie o Apache.
  * Pode ser utilizado o servidor do php, dando o comando <code>php artisan serve</code>.

Só utilizar!
