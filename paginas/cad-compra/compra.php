<?php
//Inclui o relatório de usuários
//include_once '../../backend/compra/relatoriocompra.php';
//arrumar o código acima

include_once '../../backend/tipo/buscaTipo.php';


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
        <title>Medify|Compra</title>
        <link rel="stylesheet" href= "compra.css">
        <link rel="stylesheet" href= "../../componentes/menu/menu.css">
    </head>
    <body>
        <?php
            include_once '../../componentes/menu/menu.php';
        ?>
        <section class="pagina">
            <header>
                <h1 class="jefinho"> Movimentação | Cadastro de Compra</h1>
            </header>
            <form action="criarcompra.php" method="post">
                <div class="inputs">
                    <div class="linha">
                        <input type="text"name="quantidade" placeholder="Quantidade">
                        <input type="text"name="tb_ordem_compra_id" placeholder="Ordem de Compra">
                    <input type="text"name="venda" placeholder="Venda">
                    <div class="linha">
                        <input type="text"name="medicamento" placeholder="Medicamento">
                      <select name="tipo">
                            <option value="">Tipo</option>
                            <?php

                    if(isset($arrTipo)){
                        foreach($arrTipo as $tipo){
                            echo("<option value=".$tipo["id"].">".$tipo["descricao"]."</option>");
                        }
                          
}


                            ?>
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
                        <th>Quantidade</th>
                        <th>Ordem de Compra</th>
                        <th>Venda</th>
                        <th>Medicamento</th>
                        <th>Tipo</th>
                    </tr>
                    <tr>
                        <td><button>Excluir</button></td>
                        <td>1</td>
                        <td>20/07/2024</td>
                        <td>23/07/2024</td>
                        <td>Paracetamol</td>
                        <td>Geral</td>
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