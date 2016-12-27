# Projeto Biblioteca Madeira

* **Diagrama de caso de uso**

![](https://raw.githubusercontent.com/tifabio/testemadeira-docs/master/madeira-usecase.jpg)

* **Diagrama de entidade e relacionamento**

![](https://raw.githubusercontent.com/tifabio/testemadeira-docs/master/madeira.png)

* **Instalando e acessando o projeto**
    * executar os seguintes comandos:
    ```bash
      git clone https://github.com/tifabio/testemadeira.git <dir>
      cd <dir>
      composer install
    ```
      
    * alterar as seguintes linhas do arquivo ```(<dir>/config/autoload/global.php)``` com as configurações do banco (ou definir as mesmas como variáveis de ambiente):
    ```php
      'host'     => getenv(DB_HOST),
      'port'     => getenv(DB_PORT),
      'user'     => getenv(DB_USER),
      'password' => getenv(DB_PASS),
      'dbname'   => getenv(DB_BASE)
    ```
      
    * executar o script de criação do banco e dados iniciais:
    
    	* [madeira.sql](https://raw.githubusercontent.com/tifabio/testemadeira-docs/master/madeira.sql)
    
    * projeto instalado e configurado, agora já pode acessar via navegador a tela de login ```(http://<host>/<dir>)```, e utilizar os seguintes dados de acesso:
    ```
      Email: admin@email.com
      Senha: 1234
    ```