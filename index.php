<?php

$erro = null;

if($_GET){
    if($_GET['erro']){
        $erro = $_GET['erro'];
    }
}

?>
<html>
    <head>
        <title>Login | Medify</title>
        <link rel="stylesheet" href="index.css">
        <meta charset="utf-8">
    </head>
    <body>
        <div class="part_left">
            <div class="logo">
                <img src="assets/img/th.png">
            </div>
        </div>
        <section class="sign">
            <form action="backend/login/login.php" method="post">
                <h1>Bem Vindo!</h1>
                    <input type="text" placeholder="Usuário" name="usuario">
                    <input type="password" placeholder="Senha" name="senha">
                    <button type="submit">Entrar</button>
                </div>
            </form>
            <?php
            if($erro != null){
             switch($erro){
                case '401':
                    echo("<p class=\"erro\">Usuário ou senha inválido</p>");
                    break;
                    case '500';
                    ("<p class=\"erro\">Erro no servidor, tente novamente, mais tarde</p>");
                    break;


             }
            }
            
            ?>
        </section>
    </body>
</html>