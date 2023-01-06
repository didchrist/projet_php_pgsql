<?php

namespace Models\User;

use Exception;
use Models\Database;

class UserManager extends Database
{
    public function verifUser($user, $pwd)
    {
        $this->setparamBdd($user, $pwd);
    }
    public function addUser($user, $password, $condition)
    {
        $req = "CREATE USER $user WITH PASSWORD '$password' $condition";
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
    }
    public function givepermission($commande, $table, $user)
    {
        $req = "GRANT $commande ON $table TO $user";
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
    }
    public function setpermission()
    {
        $req = "SELECT GRANTOR, GRANTEE, TABLE_NAME, PRIVILEGE_TYPE, IS_GRANTABLE
        FROM   INFORMATION_SCHEMA.COLUMN_PRIVILEGES
        WHERE  GRANTEE = ?
        group by grantee, table_name, grantor, privilege_type, is_grantable
        ORDER  BY GRANTEE, TABLE_NAME, PRIVILEGE_TYPE";
        $statement = $this->getBdd()->prepare($req);
        $statement->execute([$_SESSION['user']]);
        $permissionUser = $statement->fetchAll();
        $statement->closeCursor();
        return $permissionUser;
    }
}