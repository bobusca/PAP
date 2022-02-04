<?php

namespace core\classes;

use Exception;
use PDO;
use PDOException;

// com o mesmo nome do ficheiro
class Database
{
    /*
Esta class vai ter de fazer as operações de CRUD (Create, Read, Update e Delete),
 que no Mysql correspondem às operações de INSERT, SELECT, UPDATE E DELETE)
    */
    // cRIAR PRORIEDADE PRIVADA
    // porque só vai estar associada aos métodos dentro desta classe
    private $ligacao;

    //================================================================
    private function ligar() //1-Ligar 2- comunicar 3-Fechar
    {
        // Criar um objeto Pdo (PHP data object)
        // Ligar à base de dados
        $this->ligacao = new PDO(
            'mysql:' .
                'host=' . MYSQL_SERVER . ';' .
              'dbname=' . MYSQL_DATABASE . ';' .
                'charset=' . MYSQL_CHARSET,
            MYSQL_USER,
            MYSQL_PASS,
            array(PDO::ATTR_PERSISTENT => true)
        );

        // Colocar mecanismo de Debug
        // Estou a definir para este modo de erro
        // o modo de erro ue apresenta avisos
        $this->ligacao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    //================================================================
    private function desligar()
    {
        //Desliga-se da base de dados
        $this->ligacao = null;
    }
    //================================================================
    // Significa que podemos passar parâmetros ou não
    public function select($sql, $parametros = null)
    {
        $sql = trim($sql);
        // Verifica se é uma instrução SELECT
        // Vamos verificar através de expressões regulares
        // vamos usar a função preg_match que permite verificar 
        // através de expressões regulares, analisar uma determinada string
        // perante uma expressão regular
        // Expressão se começar por SELECT /i case-sensitive
        if (!preg_match("/^SELECT/i", $sql)) {
            // erro genérico que vai ser apresentado para o
            // programador, não aparece no lado cliente
            throw new Exception('Base de Dados - Não é uma instrução SELECT');
            //die('Base de Dados - Não é uma instrução SELECT');
        }
        // Executa função de pesquisa de SQL
        // Primeiro faz a ligação à BD
        $this->ligar();
        // todos os select's vão ter resultados
        $resultados = null;

        try {
            // Comunicação com a BD
            if (!empty($parametros))  // Se tiver parâmetros, vai preparar a instrução
            {
                // query é preparada aqui
                $executar = $this->ligacao->prepare($sql);
                // é executada com os parâmetros fornecidos
                $executar->execute($parametros);
                // Significa que todas as informações que vierem da nossa base
                // de dados, vêm num array em formato de objeto
                // temos assim todos os resultados, transformados numa classe
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else // se não tiver parâmetros
            {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) // Caso tenha erro, poderei ver através da variável $e
        {
            // Caso exista erro
            return false;
        }

        $this->desligar();
        // devolver os resultados obtidos
        return $resultados;
    }
    //================================================================
    // INSERT também vai ter o meu sql e ter parâmetros
    public function insert($sql, $parametros = null)
    {
        $sql = trim($sql);
        // Verifica se é uma instrução INSERT
        // Vamos verificar através de expressões regulares
        // vamos usar a função preg_match que permite verificar 
        // através de expressões regulares, analisar uma determinada string
        // perante uma expressão regular
        // Expressão se começar por INSERT /i case-sensitive
        if (!preg_match("/^INSERT/i", $sql)) {
            // erro genérico que vai ser apresentado para o
            // programador, não aparece no lado cliente
            throw new Exception('Base de Dados - Não é uma instrução INSERT');
            //die('Base de Dados - Não é uma instrução SELECT');
        }

        // Primeiro faz a ligação à BD
        $this->ligar();
        // Como não devolve resultados, não preciso desta linha
        //$resultados = null;

        try {
            // Comunicação com a BD
            if (!empty($parametros))  // Se tiver parâmetros, vai preparar a instrução
            {
                // query é preparada aqui
                $executar = $this->ligacao->prepare($sql);
                // é executada com os parâmetros fornecidos
                $executar->execute($parametros);
                // Significa que todas as informações que vierem da nossa base
                // de dados, vêm num array em formato de objeto
                // temos assim todos os resultados, transformados numa classe
                // NO INSERT NÃO É NECESSÁRIA A LINHA SEGUINTE
                // $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else // se não tiver parâmetros
            {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                //$resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) // Caso tenha erro, poderei ver através da variável $e
        {
            // Caso exista erro
            return false;
        }

        $this->desligar();
        // nÃO devolver os resultados obtidos
        // return $resultados;
    }

    //================================================================
    // UPDATE também vai ter o meu sql e ter parâmetros
    public function update($sql, $parametros = null)
    {
        $sql = trim($sql);
        // Verifica se é uma instrução UPDATE   
        // Vamos verificar através de expressões regulares
        // vamos usar a função preg_match que permite verificar 
        // através de expressões regulares, analisar uma determinada string
        // perante uma expressão regular
        // Expressão se começar por UPDATE /i case-sensitive
        if (!preg_match("/^UPDATE/i", $sql)) {
            // erro genérico que vai ser apresentado para o
            // programador, não aparece no lado cliente
            throw new Exception('Base de Dados - Não é uma instrução UPDATE');
            //die('Base de Dados - Não é uma instrução SELECT');
        }

        // Primeiro faz a ligação à BD
        $this->ligar();
        // Como não devolve resultados, não preciso desta linha
        //$resultados = null;

        try {
            // Comunicação com a BD
            if (!empty($parametros))  // Se tiver parâmetros, vai preparar a instrução
            {
                // query é preparada aqui
                $executar = $this->ligacao->prepare($sql);
                // é executada com os parâmetros fornecidos
                $executar->execute($parametros);
                // Significa que todas as informações que vierem da nossa base
                // de dados, vêm num array em formato de objeto
                // temos assim todos os resultados, transformados numa classe
                // NO update NÃO É NECESSÁRIA A LINHA SEGUINTE
                // $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else // se não tiver parâmetros
            {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                //$resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) // Caso tenha erro, poderei ver através da variável $e
        {
            // Caso exista erro
            return false;
        }

        $this->desligar();
        // nÃO devolver os resultados obtidos
        // return $resultados;
    }
    //================================================================
    // DELETE também vai ter o meu sql e ter parâmetros
    public function delete($sql, $parametros = null)
    {
        $sql = trim($sql);
        // Verifica se é uma instrução DELETE   
        // Vamos verificar através de expressões regulares
        // vamos usar a função preg_match que permite verificar 
        // através de expressões regulares, analisar uma determinada string
        // perante uma expressão regular
        // Expressão se começar por DELETE /i case-sensitive
        if (!preg_match("/^DELETE/i", $sql)) {
            // erro genérico que vai ser apresentado para o
            // programador, não aparece no lado cliente
            throw new Exception('Base de Dados - Não é uma instrução DELETE');
            //die('Base de Dados - Não é uma instrução SELECT');
        }

        // Primeiro faz a ligação à BD
        $this->ligar();
        // Como não devolve resultados, não preciso desta linha
        //$resultados = null;

        try {
            // Comunicação com a BD
            if (!empty($parametros))  // Se tiver parâmetros, vai preparar a instrução
            {
                // query é preparada aqui
                $executar = $this->ligacao->prepare($sql);
                // é executada com os parâmetros fornecidos
                $executar->execute($parametros);
                // Significa que todas as informações que vierem da nossa base
                // de dados, vêm num array em formato de objeto
                // temos assim todos os resultados, transformados numa classe
                // NO INSERT NÃO É NECESSÁRIA A LINHA SEGUINTE
                // $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else // se não tiver parâmetros
            {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                //$resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) // Caso tenha erro, poderei ver através da variável $e
        {
            // Caso exista erro
            return false;
        }

        $this->desligar();
        // nÃO devolver os resultados obtidos
        // return $resultados;
    }
    //================================================================
    // STATEMENT também vai ter o meu sql e ter parâmetros
    public function statement($sql, $parametros = null)
    {
        $sql = trim($sql);
        // Verifica se é uma instrução diferente das anteriores 
        // Não pode começar por nenhuma das palavras anteriores
        if (preg_match("/^(SELECT|INSERT|UPDATE|DELETE)/i", $sql)) {
            // erro genérico que vai ser apresentado para o
            // programador, não aparece no lado cliente
            throw new Exception('Base de Dados - Instrução Inválida');
        }

        // Primeiro faz a ligação à BD
        $this->ligar();
        // Como não devolve resultados, não preciso desta linha
        //$resultados = null;

        try {
            // Comunicação com a BD
            if (!empty($parametros))  // Se tiver parâmetros, vai preparar a instrução
            {
                // query é preparada aqui
                $executar = $this->ligacao->prepare($sql);
                // é executada com os parâmetros fornecidos
                $executar->execute($parametros);
                // Significa que todas as informações que vierem da nossa base
                // de dados, vêm num array em formato de objeto
                // temos assim todos os resultados, transformados numa classe
                // NO INSERT NÃO É NECESSÁRIA A LINHA SEGUINTE
                // $resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            } else // se não tiver parâmetros
            {
                $executar = $this->ligacao->prepare($sql);
                $executar->execute();
                //$resultados = $executar->fetchAll(PDO::FETCH_CLASS);
            }
        } catch (PDOException $e) // Caso tenha erro, poderei ver através da variável $e
        {
            // Caso exista erro
            return false;
        }

        $this->desligar();
        // nÃO devolver os resultados obtidos
        // return $resultados;
    }
}
