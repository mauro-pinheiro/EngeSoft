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

* Faça migração do db
```PHP
php artisan migrate
```

* Faça o seed do db
```PHP
php artisan db:seed
```

* Geração da Key
```PHP
php artisan key:generate
```
### Utilização

* Inicie o Apache.
  * Pode ser utilizado o servidor do php, dando o comando <code>php artisan serve</code>.

Só utilizar!
