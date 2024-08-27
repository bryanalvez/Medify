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
	v.id,
    v.dt_venda,
    v.metodo_pgt,
    v.dt_pagamento,
    v.tipo,
    v.cliente,
    v.situacao
    
from tb_venda v
		inner join tb_tipo t on t.id = v.tipo
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