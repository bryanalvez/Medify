<?php

//Requer conexão com o banco de dados
require_once '../../backend/database/conexao.php';

//Inicializa variável de mensagem
$mensagem_erro = '';

//Inicia a estrutura de tentativa try
try{

    //Prepara a query SQL para execução
    $preparo = $conexao->prepare("
    with estoque as(
	select
    m.id,
    m.nome,
		sum(ioc.quantidade)-sum(iv.quantidade) as estoque
	from tb_medicamento m
				left join fk_oc_item ioc on ioc.medicamento = m.id
                left join tb_ordem_compra oc on oc.id = ioc.ordem_compra
                left join fk_venda_item iv on iv.medicamento - m.id
                left join tb_venda v on v.id = iv.venda
			where 1=1
				and oc.situacao =3
                and v.situacao =3
			group by m.id,m.nome
),pendente as(
select
    m.id,
    m.nome,
		sum(ioc.quantidade) as ocPendente,
		sum(iv.quantidade) as vendaPendente
	from tb_medicamento m
		left join fk_oc_item ioc on ioc.medicamento = m.id
		left join tb_ordem_compra oc on oc.id = ioc.ordem_compra
		left join fk_venda_item iv on iv.medicamento - m.id
		left join tb_venda v on v.id = iv.venda
			where 1=1
				and oc.situacao <> 3
                and v.situacao <> 3
			group by m.id,m.nome
)
select
	e.id,
    e.nome,
    e.estoque,
    p.ocPendente,
    p.vendaPendente
from estoque e
		left join pendente p on p.id = e.id
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