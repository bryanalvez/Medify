<?php   
 include_once "../../componentes/menu/menu.php";
 include_once "../../backend/medicamento/relatoriohome.php";

?>

<html>
    <head>
        <title>Medify|Home</title>
        <link rel="stylesheet" href="home.css">
    </head>
    <body>
            <table>
                <h1>Relatório Venda</h1>
                <table>
                    <try>
                        <th>Medicamento</th>
                        <th>Quantidade Estoque</th>
                    </try>
                <?php

                foreach ($relatorio as $venda) {
                    echo ("
                            <tr>
                                <td>".$venda['nome'] . "</td>
                                <td>".$venda['quantidade'] ."</td>
                            </tr>");
                }

                ?>

                  <?php
                    
                    //Utiliza a função foreach
                    //para interar entre os itens do array
                    //que é o nosso $relatorio

                    foreach($relatorio as $usuario){
                        echo("
                            <tr>
                                <td><button>Excluir</button></td>
                                <td>".$usuario['id']."</td>
                                <td>".$usuario['dt_venda']."
                                <td>".$usuario['metodo_pgt']."</td>
                                <td>".$usuario['dt_pagamento']."</td>
                                <td>".$usuario['tipo']."</td>
                                <td>".$usuario['cliente']."</td>
                                <td>".$usuario['situacao']."</td>
                            </tr>
                        ");
                    }
                    ?>
            </table>
            </div>
        </section>
    </body>
</html>