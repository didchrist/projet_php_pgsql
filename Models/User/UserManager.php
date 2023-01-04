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
    public function addUser($user, $password)
    {
        $req= "CREATE USER $user WITH PASSWORD '$password'";
        $statement = $this->getBdd()->prepare($req);
        $statement->execute();
    }
}