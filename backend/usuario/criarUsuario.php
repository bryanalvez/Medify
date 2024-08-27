<?php


require_once '../database/conexao.php';

$requisicao = $_POST;
$senha = sha1('123Mudar!');
//Utiliza uma estrutura de tentativa para tentar
//inserir as informaçoes no banco de dados
try{
    //Utiliza o método prepare() da variável conexao que está disponivel
    //no arquivo por meio do require_once), para preparar uma instrução
    //sql(banco de dados)
    $preparacao = $conexao->prepare("
        insert into tb_usuario(
            nome, sobrenome, endereco, telefone, login, senha, cargo
        ) values(
            :nome, :sobrenome, :endereco, :telefone, :login, :senha, :cargo
        )
    ");
    //Utiliza o método bindParam da classe PreparedStatement disponivel
    //na variavel preparaçao, que recebeu a preparaçao acima
    //a função bindParam troca um dos parametros da intruçao sql pelo
    //valor contido em uma variavel. Nao esquecer de mudar o tipo no
    //ultimo argumento.
    $preparacao->bindParam(':nome',$requisicao['nome'],PDO::PARAM_STR);
    $preparacao->bindParam(':sobrenome',$requisicao['sobrenome'],PDO::PARAM_STR);
    $preparacao->bindParam(':endereco',$requisicao['endereco'],PDO::PARAM_STR);
    $preparacao->bindParam(':telefone',$requisicao['telefone'],PDO::PARAM_STR);
    $preparacao->bindParam(':login',$requisicao['usuario'],PDO::PARAM_STR);
    $preparacao->bindParam(':senha',$senha ,PDO::PARAM_STR);
    $preparacao->bindParam(':cargo',$requisicao['tipo'],PDO::PARAM_INT);
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
        header('Location: ../../paginas/cad-usuario/usuario.php?status=201');
        //Morre a execução para evitar lacunas de segurança.
        die();
    } else{
        //Caso a quantidade não seja 1, retorna com o status
        //400 (Bad Request), informando que faltou algo
        header('Location: ../../paginas/cad-usuario/usuario.php?status=400');
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