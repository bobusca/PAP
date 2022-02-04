<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class clientes
{
    //************************************************************************* */
    // VERIFCA SE EMAIL EXISTE
    public function verificar_email_existe($email)
    {
        // Verifica se já existe outra conta com o mesmo email
        // Verifica na BD se existe cliente com mesmo email
        // é criado o namespace da database
        // parametro por exemplo :email podia ser e: PDO
        // este método evita SQLInjection
        $bd = new Database();
        $parametros = [
            ':email' => strtolower(trim($email))

        ];
        $resultados = $bd->select("SELECT email FROM clientes WHERE email = :email", $parametros);

        // se o cliente já existe
        if (count($resultados) != 0) {
            // AS passwords são diferentes
            return true;
        } else {
            return false;
        }
    }

    public function registar_cliente()
    {
        // Regista o novo cliente na base de dados
        $bd = new Database();
        // Cria uma hash para o registo cliente
        //$purl = store::criarHash();
        $parametros = [
            // NOME DOS PARAMETROS = NOME DOS CAMPOS
            ':email' => strtolower(trim($_POST['text_email'])),
            // ENCRIPTAÇÃO DA SENHA
            ':senha' => password_hash($_POST['text_senha_1'], PASSWORD_DEFAULT),
            ':nome_completo' => trim($_POST['text_nome_completo']),
            ':morada' => trim($_POST['text_morada']),
            ':cidade' => trim($_POST['text_cidade']),
            ':telefone' => trim($_POST['text_telefone']),
            ':purl' => NULL,
            ':ativo' => 1,
        ];
        $bd->insert("
 INSERT INTO clientes VALUES(
    0,
    :email,
    :senha,
    :nome_completo,
    :morada,
    :cidade,
    :telefone,
    :purl,
    :ativo,
    NOW(),
    NOW(),
    NULL
    )
    ", $parametros);
        //Retorna o purl criado
        return;
    }
    public function validar_login($utilizador, $password)
    {
        // Vai verificar se o login é válido
        $parametros = [
            ':utilizador' => $utilizador
        ];
        $bd = new Database();
        $resultados = $bd->select("
    SELECT * FROM clientes
    WHERE email = :utilizador
    AND ACTIVO = 1
    AND deleted_at IS NULL", $parametros);
        if (count($resultados) != 1) {
            // Não existe utilizador
            return false;
        } else {
            // Temos utilizador , verifcar a password
            // Que está codificada
            $utilizador = $resultados[0];
            // Verifar a pass
            if (!password_verify($password, $utilizador->senha)) {
                // password inválida
                return false;
            } else {
                // Login é válido // Utilizador existe e a pass está OK
                return $utilizador;
            }
        }
    }
    public function lista_clientes()
    {
        // Esta função não tem parâmetros, porque não queremos ir procurar
        // por algo específico, queremos sim, que nos dê os registos todos
        // da tabela clientes
        //Primeiro - Instanciar o objeto que trata das operações de CRUD
        // objeto database
        $bd = new Database();
        // Não existem parametros recebidos


        $resultados = $bd->select("SELECT * FROM clientes");
        // Chegado aqui podes começar por verificar se estamos a obter os registos
        // dos clientes
        // Chamada da famosa função que criamos, para nos ajudar neste efeito
        
        return $resultados;
    }
}
