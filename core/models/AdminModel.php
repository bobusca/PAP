<?php

namespace core\models;

use core\classes\Database;
use core\classes\Store;

class AdminModel
{
    //========================================================
    //************************************************************************* */
    // ADMIN - VALIDAR LOGIN
    public function validar_login($utilizador_admin, $password)
    {
        // Vai verificar se o login é válido
        $parametros = [
            ':utilizador_admin' => $utilizador_admin
        ];
        $bd = new Database();
        $resultados = $bd->select("
 SELECT * FROM admins
 WHERE utilizador = :utilizador_admin
 AND deleted_at IS NULL", $parametros);
 
        if (count($resultados) != 1) {
            // Não existe Admin
            return false;
        } else {
            // Temos utilizador Admin, verifcar a password
            // Que está codificada
            $utilizador_admin = $resultados[0];
            // Verifar a pass
            if (!password_verify($password, $utilizador_admin->password)) {
                // password inválida
                return false;
            } else {
                // Login é válido // Utilizador existe e a pass está OK
                return $utilizador_admin;
            }
        }
    }
}
