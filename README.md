# PHP Send-Email

Envio simples de e-mails com a classe PHPMailer 

## - Instalação

Para instalar esta dependência basta executar o comando abaixo:

``` shell
composer require rodrigotutz/send-email
```

## - Utilização

Para utilizar este componente basta seguir o exemplo abaixo:

 - Preencha os campos do arquivo Config.php com as informações do seu servidor SMTP

 ```php
        define("MAIL", [
        "host" => 'smtp-teste.com',             /* Insira o HOST do seu servidor SMTP */
        "port" => '587',                        /* Insira a PORTA do seu servidor SMTP */
        "user" => 'seu-usuario.com',            /* Insira o Usuario do seu servidor SMTP */
        "passwd" => 'Sua senha',                /* Insira a Senha do seu servidor SMTP */
        "from_email" => 'seuemail@teste.com',   /* Insira o email que irá receber o email */
        "from_name" => 'Seu Nome'              /* Insira o nome do usuário que irá receber o email */
        ]);
 ```

 - Chame a o componente no seu arquivo e inicie uma instância do objeto Mail e altere os dados como desejar

  ```php
        <?php

        require __DIR__ ."/vendor/autoload.php";

        use RodrigoTutz\SendEmail\Mail;

        $email = new Mail();

        $assunto = "Olá  Esse é um teste!";
        $conteudoDoEmail = "<h1>Olá, estou apenas testando esse componente!</h1>";
        $emailRemetente = "teste@teste.com";
        $nomeRemetente = "Rodrigo Tutz";

        $email->add(
            $assunto,                                   /* Assunto do Email */
            $conteudoDoEmail,                           /* Conteudo da mensagem */
            $nomeRemetente,                             /* Nome do Usuário que irá enviar a mensagem */
            $emailRemetente,                            /* Email do Usuário que irá enviar a mensagem */
        )->send();                                      /* Send -> Método que envia o email */

        if($email->error()){                           /* Validação do envio do e-mail */

            var_dump($email->error()->getMessage());     /* Imprime o erro na tela */

        }else {
            echo "E-mail enviado com sucesso";          /* Imprime o sucesso na tela */
        }

  ```

## - Requisitos 

    - PHP 7.0 ou superior
    - PHPMailer 6.6.3 ou superior