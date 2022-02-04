<?php
// Vai perceber o que vem na query string do meu site
// Colecão de Rotas
// Neste exemplo quando for encontrada a
// acão inicio vou carregar o controlador main e executaro seu método index
// sempre que quiser adicionar novas localizações, coloca,
$rotas=[
'novo_cliente' => 'main@novo_cliente',
'inicio'=>'main@index',
'loja' => 'main@loja',
'carrinho' => 'main@carrinho',
'criar_cliente' => 'main@criar_cliente',
'login' => 'main@login',
'login_submit' => 'main@login_submit',
'logout' => 'main@logout',
'admin_logout' => 'admin@admin_logout', 
];

//Agora vamos definir uma acão por defeito
// que vai definir o nosso fluxo de código
// e que vai ter o primeiro valor, como sendo inicio
// quando não for enviado nenhum valor vai para inicio
$acao ='inicio';
// Verifique se a acão na query string
if (isset ($_GET['a'])) 
{
    // Verifca se existe ação nas rotas
    if (!key_exists ($_GET['a'],$rotas ))
    {
        $acao = 'inicio';
    }
    else
    {
    // então a ação só pode ser inicio ou loja
    $acao = $_GET['a'];
    }
}
// trata a definição da rota
// repara que o separador é o e e o explode vai dividir a string
// sacando neste caso main@index o main e o index
$partes = explode('@', $rotas[$acao]) ;
//var_dump ($partes); // Despejar o array
// Controlador, que é a classe onde são utilizados os controlos
//$controlador = ucfirst($partes[0]);
// Criar uma instanciação deste controlador, assim terei o caminho do controlador
$controlador = 'core\\controllers\\' . ucfirst($partes[0]);
// Método que a função desta clase controlador
$metodo= $partes [1];
// aqui é a instanciação
$ctr = new $controlador();
//Agora vou buscar o metodo, da classe controlador
$ctr->$metodo();
// por exemplo vou executara classe que vai ser o controlador
// e o seu método
//echo "$controlador - $metodo";
?>