<?php

//Requer conexão com o banco de dados
require_once '../../backend/database/conexao.php';

//Inicializa variável de mensagem
$mensagem_erro = '';

//Inicia a estrutura de tentativa try
try{

    //Prepara a query SQL para execução
    $preparo = $conexao->prepare("
    select
	mv.id,
    mv.quantidade,
    mv.ordem_compra,
    mv.venda,
    mv.medicamento
    
from tb_movimento mv
		inner join tb_tipo t on t.id = mv.tipo
    ");
    //Executa a query
    $preparo->execute();

    //Coloca o resultado em um array usando o fetch_assoc
    $relatorio = $preparo->fetchAll();

    //#### Testar se deu certo, remover depois ####
    //foreach($relatorio as $linha){
    //    print_r($linha);
    //}

}catch(PDOException $erro){
    //Imprime o erro na tela
    print_r($erro);
    //Coloca que deu erro na variável mensagem_erro
    $mensagem_erro = 'erro';
}


















?>