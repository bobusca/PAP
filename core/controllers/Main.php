<?php

namespace core\controllers;

use core\classes\Database;
use core\classes\Store;
use core\models\Clientes;
use core\models\clientes as ModelsClientes;

class Main
{
    public function index()
    {
        // $clientes = ['João Mascarenhas', 'Figueirita Malmequer', 'Cristi Vai Dai'];

        $dados = [
            'titulo' => APP_NAME . '' . APP_VERSION,
        ]; // Como vamos passar agora isto para o interior dos nossos Layouts

        // vou passar as estruturas
        // fazer as inclusões dos elementos
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'layouts/footer',
            'inicio',
            'layouts/html_footer',
        ], $dados);
        /* 
        1- Carregar e tratar dados (cálculos) (bases de dados)
        2- Apresentar o Layout (views )
        */
    }
    public function loja()
    {
        //apresenta a página da loja
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'loja',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    public function carrinho()
    {
        //apresenta a página do carrinho
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'carrinho',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    public function novo_cliente()
    {
        //Verifica se existe Sessão Aberta
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }
        //apresenta o Layout Criar Novo Utilizador
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'criar_cliente',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    public function criar_cliente()
    {
        // store::printData('');
        // Vamos agora verificar se o utilizador já existe
        if (Store::clienteLogado()) {
            $this->index();
            return;
        }
        // Alguém pode querer entrar de forma forçada
        // colocando endereço no browser, não seguindo a sequência
        // do programa
        // Verifica se houve submissão de um formulário
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            $this->index();
            return;
        }
        // Criação de um novo Cliente
        // 1- Verificar se a password 1 coincide com password 2
        if ($_POST['text_senha_1'] !== $_POST['text_senha_2']) {
            // AS passwords são diferentes
            $_SESSION['erro'] = 'Senhas são Diferentes!!!!';
            $this->novo_cliente();
            return;
        }
        $clientes = new Clientes();
        // Verifica na BD se existe cliente com mesmo email
        // é criado o namespace da database
        // parametro por exemplo :email podia ser e: PDO
        // este método evita SQLInjection
        $bd = new Database();
        $parametros = [
            ':email' => strtolower(trim($_POST['text_email']))
        ];

        // Lucas fote buscar o campo que veio do form através de POST, correto
        // Agora o que tinhas de faze, é verficar na BD na tabela clientes se
        // email existe, NÃO O FIZESTE, farias então assim
        // Percebe esta lógica, dividimos a nossa Framework em partes
        // existe uma parte que vai tratar do CRUD, operações sobre as bd's
        // que se vai chamar de models, é lá que iremos fazer estas operações
        // para dividir as lógicas no nosso programa
        // então é assim, tens o email que veio do formulário através de post e 
        // já tens num array anterior essa captura

        // verifica se na base de dados existe cliente com o mesmo email, então
        // vamos criar na nossa classe Clientes, dentro do models a função
        // que vai verificar a existência ou não desse email
        // o que estamos a fazer, instanciar o objeto Clientes, para quê?
        // porque é lá que vamos criar o método verificar_email_existe
        // o que vai fazer? Recebe o parâmetro do POST relativo ao email e vai
        // fazer um select para ver se o email existe, se for true
        // email existe e vai novamente para o Form, caso contrário
        // continua o programa

        $cliente = new Clientes();
        if ($cliente->verificar_email_existe($_POST['text_email'])) {
            $_SESSION['erro'] = 'Já existe um Cliente com Esse EMAIL';
            $this->novo_cliente();
            return;
        }

        // se o programa passou para aqui é sinal que
        // está validado
        // as senhas são iguais
        // e o email não existe
        // então podemos gravar

        // Grava (adiciona_insert) o cliente na tabela
        // Vê o método da classe, tudo é feito desta forma
        // as operações de CRUD, depois são tratadas no models
        // daí, dividirmos todo código, chama-se, Programação Estruturada
        // onde as lógicas, simplificam os processos
        $clientes->registar_cliente();

        // Agora o que vamos fazer é apresentar o Layout, mas com uma págian
        // de criação de sucesso do cliente, OK????

        //apresenta o Layout Informar o envio do Email
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'criar_cliente_sucesso',
            'layouts/footer',
            'layouts/html_footer',
        ]);
        return;
    }
    public function login()
    {
        /* Verificar se existe um utilizador logado */
        if (Store::clienteLogado()) {
            Store::redirect();
            return;
        }
        //apresenta o Layout Informar o envio do Email
        Store::Layout([
            'layouts/html_header',
            'layouts/header',
            'login_frm',
            'layouts/footer',
            'layouts/html_footer',
        ]);
    }
    public function login_submit()
    {
        /* Verificar se existe um utilizador logado */
        if (Store::clienteLogado()) {
            Store::redirect();
            return;
        }
        // veriifca se foi efetuado um post do Formulário de Login
        if ($_SERVER['REQUEST_METHOD'] != 'POST') {
            if (Store::clienteLogado()) {
                Store::redirect();
                return;
            }
        }
        // Validar campos
        if (
            !isset($_POST['text_utilizador']) ||
            !isset($_POST['text_password']) || !filter_var(
                trim($_POST['text_utilizador']),
                FILTER_VALIDATE_EMAIL
            )
        ) {
            // erro de preenchimento do form
            $_SESSION['erro'] = 'Login Inválido';
            store::redirect('login');
            return;
        }
        // Prepara os dados para o model
        $utilizador = trim(strtolower($_POST['text_utilizador']));
        $password = trim($_POST['text_password']);
        // Ir à bd (ver login)
        // carrega o model e verifica se o login é correto
        $cliente = new Clientes();
        // chama model Clientes, validar_login
        // Para verificar user e pass
        $resultado = $cliente->validar_login($utilizador, $password);
        // analisa o resultado
        if (is_bool($resultado)) {
            //Login inválido
            $_SESSION['erro'] = 'Login Inválido';
            Store::redirect('login');
            return;
        } else {
            // Login Válido, criar sessão cliente
            // Coloca os dados na sessão / Criar sessão do cliente
            // Optamos por estes três códigos na sessão
            $_SESSION['cliente'] = $resultado->id_cliente;
            $_SESSION['utilizador'] = $resultado->email;
            $_SESSION['nome_cliente'] = $resultado->nome_completo;
            // redirecionar para o inicio
            Store::redirect();
        }
    }
    public function logout()
    {
        // remove as varáveis da sessão e redericiona
        // para o inicio da aplicação
        unset($_SESSION['cliente']);
        unset($_SESSION['utilizador']);
        unset($_SESSION['nome_cliente']);
        // redireciona para o inicio da aplicação
        Store::redirect();
    }
}
