<?php
//Inclui o relatório de usuários
//include_once '../../backend/compra/relatoriocompra.php';
//arrumar o código acima


//Inicializa uma variavel com nome de mensagem com valor null
$mensagem = null;
//verifica se recebeu alguma informação por meio de GET
if($_GET){
    //Verifica se essa informação é um status
   if($_GET['status']){
    //Utiliza a estrutura de decisão switch para verificar qual
    //status foi recebido e atribuir uma mensagem conforme necessário
    switch($_GET['status']){
        case 201:
            //Criado
            $mensagem = 'Adicionado com sucesso!';
            break;
        case 400:
            //Bad request
            $mensagem = 'Inserção não funcionou';
            break;
        case 500:
            //Erro no servidor
            $mensagem = 'Erro ao tentar inserir informações';
            break  ;  
    }
   }
}

?>


<html>
    <head>
        <title>Medify|Venda</title>
        <link rel="stylesheet" href= "venda.css">
        <link rel="stylesheet" href= "../../componentes/menu/menu.css">
    </head>
    <body>
        <?php
            include_once '../../componentes/menu/menu.php';
        ?>
        <section class="pagina">
            <header>
                <h1 class="jefinho"> Movimentação | Cadastro de Pedidos</h1>
            </header>
            <form action="criarvenda.php" method="post">
                <div class="inputs">
                    <div class="linha">
                        <input type="date" name="dt_venda" placeholder="Data da Venda">
                        <select name="tipo">
                            <option value="">Tipo</option>
                            <option value="400">Pessoa Física</option>
                            <option value="401">Pessoa Jurídica</option>
                        </select>
                    </div>
                    <input type="text"name="metodo_pgt" placeholder="Método de Pagamento">
                    <input type="date"name="dt_pagamento" placeholder="Data de Pagamento">
                    <div class="linha">
                        <input type="text"name="cliente" placeholder="Cliente">
                
                    </div>
                    <div class="linha">
                        <select name="situacao">
                            <option value="">Situação</option>
                            <option value="1">Entregue</option>
                            <option value="2">Não entregue</option>
                        </select>
                    </div>
                </div>
                <div class="controles">
                    <button type="submit" class="salvar">Salvar</button>
                    <button type="reset" class="cancelar">Cancelar</button>
                <?php
                echo('<p>'.$mensagem.'</p>');
                ?>
            </div>
            </form>
            <div class="relatorio">
                <h1>Relatório</h1>
                <table>
                    <tr>
                        <th>Ação</th>
                        <th>Data da Venda</th>
                        <th>Tipo</th>
                        <th>Método de Pagamento</th>
                        <th>Data de Pagamento</th>
                        <th>Cliente</th>
                        <th>Situação</th>
                    </tr>
                    <tr>
                        <td><button>Excluir</button></td>
                        <td>01/08/2024</td>
                        <td>Pessoa Física</td>
                        <td>Crédito</td>
                        <td>04/08/2024</td>
                        <td>Ganoel Mones</td>
                        <td>Entregue</td>
                
                    </tr>
                    <?php
                    
                    //Utiliza a função foreach
                    //para interar entre os itens do array
                    //que é o nosso $relatorio

                 /*   foreach($relatorio as $medicamento){
                        echo("
                            <tr>
                                <td><button>Excluir</button></td>
                                <td>".$medicamento['id']."</td>
                                <td>".$medicamento['nome']."</td>
                                <td>".$medicamento['controlado']."</td>
                                <td>".$mecicamento['Alta vigilancia']."</td>
                                <td>".$medicamento['valor']."</td>;
                    ");}*/
                    
                    ?>
                </table>
            </div>
        </section>
    </body>
</html>