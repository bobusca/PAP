<?php

namespace core\classes;

use Exception;

class Store
{
    // Chamamento do nosso layout
    // Static function, porque não quero fazer uma instanciacão da class Store
    // quero fazer executar o méttodo dela automaticamente
    // Vai servir para apresentar as views da aplicação
    public static function Layout($estruturas, $dados = null)
    {
        // Estruturas são a coleção de ficheiros (html_ header.php...)
        // seguindo a sequência de apresentação
        // html_header.php nav_bar.php inicio.php       html_folder.php
        // Verifica se estruturas é um array
        if (!is_array($estruturas)) // Se não for array
        {
            throw new Exception("coleção de estruturas inválida");
        }
        // variáveis
        if (!empty($dados) && is_array($dados)) {
            // Significa que foram enviadas informações, que queremos
            // Passar para dentro das nossas views
            extract($dados);
        }

        // Apresentar as views da aplicação
        // Ficheiros que estão colocados dentro do views
        foreach ($estruturas as $estrutura) {
            include("../core/views/$estrutura.php"); // como vou usar extensões php
        }
    }
    public static function clienteLogado()
    {
        // Verifica se temos um cliente logado / em sessão
        // SE EXISTIR um cliente na sessão 
        return isset($_SESSION['cliente']);
    }



    //******************************************************/
    //***************** printData *************************************/
    public static function printData($data, $die = true)
    {
        if (is_array($data) || is_object($data)) {
            echo "<pre>";
            print_r($data);
        } else {
            echo "<pre>";
            echo $data;
        }
        if ($die) {
            die("FIM");
        }
    }
    public static function criarHash($num_caracteres = 12)
    {
        // Criar hashes
        $chars = '01234567890123456789abcdefghijlmnopqrstuvwxyzabcdefghijlmnopqrstuvwxyzABCDEFGH
 IJLMNOPQRSTUVWXYZABCDEFGHIJLMNOPQRSTUVWXYZ';
        return substr(str_shuffle($chars), 0, $num_caracteres);
    }
    public static function redirect($rota = '', $admin = false)
    {
        // Faz o redirecionamento para a URL desejada (rota)
        if (!$admin) {
            header("Location: " . BASE_URL . "?a=$rota");
        } else {
            header("Location: " . BASE_URL . "admin?a=$rota");
        }
    }
    public static function adminLogado()
    {
        // Verifica se temos um admin logado / em sessão
        // SE EXISTIR um cliente na sessão vai devolver true
        return isset($_SESSION['admin']);
    }
    // Chamamento do nosso layout
    // Static function, porque não quero fazer uma instanciação da class Store
    // quero fazer executar o método dela automaticamente
    // Vai servir para apresentar as views da aplicação
    public static function Layout_admin($estruturas, $dados = null)
    {
        // Estruturas são a coleção de ficheiros (html_header.php .....)
        // seguindo a sequência de apresentação
        //html_header.php nav_bar.php inicio.php html_footer.php
        // Verifica se estruturas é um array
        if (!is_array($estruturas)) // Se não for array
        {
            throw new Exception("Coleção de estruturas inválida");
        }
        // variáveis
        if (!empty($dados) && is_array($dados)) {
            // significa que foram enviadas informações, que queremos
            // Passar para dentro das nossas views
            extract($dados);
        }
        // apresentar as views da aplicação
        // Ficheiros que estão colocados dentro das views
        foreach ($estruturas as $estrutura) {
            include("../../core/views/$estrutura.php"); // como vou usar extensões php
        }
    }
}
