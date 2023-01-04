<?php

namespace Controllers\User;

use Models\User\UserManager;
use PDOException;

class UserController
{
    private $userManager;

    public function __construct()
    {
        $this->userManager = new UserManager;
    }
    public function getClean()
    {
        $_POST = filter_input_array(INPUT_POST, [
            'username' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS
        ]);
    }
    public function verifUser()
    {
        $this->getClean();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = $_POST['username'];
            $pwd = $_POST['password'];
            try {
                $this->userManager->verifUser($user,$pwd);
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $pwd;
                header("Location: homepage");
            } catch (PDOException $e) {
                $error = 'Impossible de se connecter.';
            }
        }
        require_once './Views/homepage.php';
    }
    public function disconnect()
    {
        session_unset();
        header('Location: homepage');
    }
    public function addUser()
    {
        $this->getClean();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {  
            $user = $_POST['username'];
            $pwd = $_POST['password'];
            try {
                $this->userManager->addUser($user,$pwd);
                echo '<p>Utilisateur bien enregistré.</p>';
            } catch (PDOException $e) {
                echo "<p>Erreur dans l'enregistrement de l'utilisateur.</p>"; 
            }
        }
    }
}