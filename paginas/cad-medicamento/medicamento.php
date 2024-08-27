<?php
//Inclui o relatório de usuários
include_once '../../backend/medicamento/relatoriomedicamento.php';
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
        <title>Medify| Medicamento</title>
        <link rel="stylesheet" href= "medicamento.css">
        <link rel="stylesheet" href= "../../componentes/menu/menu.css">
    </head>
    <body>
        <?php
            include_once '../../componentes/menu/menu.php';
        ?>
        <section class="pagina">
            <header>
                <h1 class="jefinho">Administração | Cadastro de Medicamentos</h1>
            </header>
            <form action="../../backend/medicamento/criarmedicamento.php" method="post">
                <div class="inputs">
                    <div class="linha">
                        <input type="text" name="nome" placeholder="Nome">
                        <select name="controlado">
                            <option value="">Controlado</option>
                            <option value="true">Sim</option>
                            <option value="false">Não</option>
                        </select>
                    </div>
                    <div class="linha">
                        <input type="text" name="valor" placeholder="Valor">
                      <select name="alta_vigilancia">
                            <option value="">Alta vigilância</option>
                            <option value="true">Sim</option>
                            <option value="false">Não</option>
                        </select>
                    </div>
                    <div class="linha">
                        <select name="ativo">
                            <option value="">Ativo</option>
                            <option value="true">Sim</option>
                            <option value="false">Não</option>
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
                        <th>Nome</th>
                        <th>Controlado</th>
                        <th>Alta vigilância</th>
                        <th>Valor</th>
                        <th>Ativo</th>
                    </tr>
                    
                    <?php
                    
                    //Utiliza a função foreach
                    //para interar entre os itens do array
                    //que é o nosso $relatorio

                    foreach($relatorio as $medicamento){
                        echo("
                            <tr>
                                <td><button>Excluir</button></td>
                                <td>".$medicamento['nome']."</td>
                                <td>".$medicamento['controlado']."</td>
                                <td>".$medicamento['alta_vigilancia']."</td>
                                <td>".$medicamento['valor']."</td>
                                <td>".$medicamento['ativo']."</td>
                    ");}
                    
                    ?>
                </table>
            </div>
        </section>
    </body>
</html>