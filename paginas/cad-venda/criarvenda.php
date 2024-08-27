<?php


require_once '../../backend/database/conexao.php';

$valores = $_POST;
//Utiliza uma estrutura de tentativa para tentar
//inserir as informaçoes no banco de dados
try{
    //Utiliza o método prepare() da variável conexao que está disponivel
    //no arquivo por meio do require_once), para preparar uma instrução
    //sql(banco de dados)

    $stmt = $conexao->prepare("insert into tb_venda(dt_venda,metodo_pgt,dt_pagamento,tipo,cliente,situacao
    )values(:dt_venda,:metodo_pgt,:dt_pagamento,:tipo,:cliente,:situacao)");
    $stmt->bindParam(':dt_venda',$valores['dt_venda'],PDO::PARAM_STR);
    $stmt->bindParam(':metodo_pgt',$valores['metodo_pgt'],PDO::PARAM_STR);
    $stmt->bindParam(':dt_pagamento',$valores['dt_pagamento'],PDO::PARAM_STR);
    $stmt->bindParam(':tipo',$valores['tipo'],PDO::PARAM_STR);
    $stmt->bindParam(':cliente',$valores['cliente'],PDO::PARAM_STR);
    $stmt->bindParam(':situacao',$valores['situacao'],PDO::PARAM_STR);
    $stmt->execute();

    $stmt2 = $conexao->prepare('select last_insert_id() as id');
    $stmt2->execute();
    $res = $stmt2->fetchAll();
    $id = $res[0]['id'];

    $stmt3 = $conexao->prepare("insert into tb_oc_item(
    ordem_compra,medicamento,quantidade
    ) values(:ordem_compra,:medicamento,:quantidade)");
     $stmt->bindParam(':ordem_compra', $id,PDO::PARAM_INT);
     $stmt->bindParam(':medicamento',$valores["medicamento"],PDO::PARAM_INT);
     $stmt->bindParam(':quantidade',$valores["quantidade"],PDO::PARAM_INT);
     $stmt->execute();
     
    //Utiliza o método bindParam da classe PreparedStatement disponivel
    //na variavel preparaçao, que recebeu a preparaçao acima
    //a função bindParam troca um dos parametros da intruçao sql pelo
    //valor contido em uma variavel. Nao esquecer de mudar o tipo no
    //ultimo argumento.
//Ao final da troca dos paramtros, estamos prontos para executar
//a instrução, por isso utilizamos o método execute() da classe
//PreparedStatement
    $preparacao->execute();
    //Ao executar, precisamos verificar se o valor foi de fato
    //inserido no banco de dadods, para isso verificamos se o valor do
    //rowCount() é igual a 1 (quantidade de linhas que foram inseridas)
    if($preparacao->rowCount()==1){
        //Caso isso seja positivo, retorna a pagina de cadastro
        //com o status 201 (Ceated)
        header('Location: ../../paginas/cad-venda/venda.php?status=201');
        //Morre a execução para evitar lacunas de segurança.
        die();
    } else{
        //Caso a quantidade não seja 1, retorna com o status
        //400 (Bad Request), informando que faltou algo
        header('Location: ../../paginas/cad-venda/venda.php?status=400');
        die();
    }
}catch(PDOException $erro){
    //Executa caso receba algum erro
    //Volta para a pagina de cadastro e apresenta
    //um erro do tipo 500 (Server Error)
    print_r($erro->getMessage());
    //header('Location: ../../paginas/cad-usuario/usuario.php?status=500');
    //Morre a execução para evitar lacunas de segurança.
    die();
}







?>