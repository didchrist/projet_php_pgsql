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
            'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'superuser' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowAddUser' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowShowArticle' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowAddArticle' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowModifyArticle' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowDeleteArticle' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowShowClient' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowAddClient' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowModifyClient' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowDeleteClient' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowShowCommande' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowAddCommande' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowModifyCommande' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
            'allowDeleteCommande' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

        ]);
    }
    public function verifUser()
    {
        $this->getClean();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = strtolower($_POST['username']);
            $pwd = $_POST['password'];
            try {
                $this->userManager->verifUser($user, $pwd);
                $_SESSION['user'] = $user;
                $_SESSION['password'] = $pwd;
                $this->getPermission();
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
            $condition = '';
            if (isset($_POST['username']) and isset($_POST['password'])) {
                $user = $_POST['username'];
                $pwd = $_POST['password'];
                if (isset($_POST['superuser']) or isset($_POST['allowAddUser'])) {
                    $superuser = $_POST['superuser'] ? 'SUPERUSER' : '';
                    $addUser = $_POST['allowAddUser'] ? 'CREATEROLE' : '';
                    $condition = $superuser . " " . $addUser;
                }
                try {
                    $this->userManager->addUser($user, $pwd, $condition);
                    if (!isset($_POST['superuser'])) {
                        $tableauPermissionArticle[] = $_POST['allowShowArticle'] === 'on' ? 'SELECT' : null;
                        $tableauPermissionArticle[] = $_POST['allowAddArticle'] === 'on' ? 'INSERT' : null;
                        $tableauPermissionArticle[] = $_POST['allowModifyArticle'] === 'on' ? 'UPDATE' : null;
                        $tableauPermissionArticle[] = $_POST['allowDeleteArticle'] === 'on' ? 'DELETE' : null;
                        $permissionArticle = false;
                        foreach ($tableauPermissionArticle as $permission) {
                            if ($permission != null and empty($permissionArticle)) {
                                $permissionArticle = $permission;
                            } elseif ($permission != null) {
                                $permissionArticle .= ', ' . $permission;
                            }
                        }
                        if (!empty($permissionArticle)) {
                            $table = 'article';
                            $this->userManager->givepermission($permissionArticle, $table, $user);
                        }
                        $tableauPermissionUser[] = $_POST['allowShowClient'] === 'on' ? 'SELECT' : null;
                        $tableauPermissionUser[] = $_POST['allowAddClient'] === 'on' ? 'INSERT' : null;
                        $tableauPermissionUser[] = $_POST['allowModifyClient'] === 'on' ? 'UPDATE' : null;
                        $tableauPermissionUser[] = $_POST['allowDeleteClient'] === 'on' ? 'DELETE' : null;
                        $permissionClient = false;
                        foreach ($tableauPermissionUser as $permission) {
                            if ($permission != null and empty($permissionClient)) {
                                $permissionClient = $permission;
                            } elseif ($permission != null) {
                                $permissionClient .= ', ' . $permission;
                            }
                        }
                        if (!empty($permissionClient)) {
                            $table = 'client';
                            $this->userManager->givepermission($permissionClient, $table, $user);
                        }
                        $tableauPermissionCommande[] = $_POST['allowShowCommande'] === 'on' ? 'SELECT' : null;
                        $tableauPermissionCommande[] = $_POST['allowAddCommande'] === 'on' ? 'INSERT' : null;
                        $tableauPermissionCommande[] = $_POST['allowModifyCommande'] === 'on' ? 'UPDATE' : null;
                        $tableauPermissionCommande[] = $_POST['allowDeleteCommande'] === 'on' ? 'DELETE' : null;
                        $permissionCommande = false;
                        foreach ($tableauPermissionCommande as $permission) {
                            if ($permission != null and empty($permissionCommande)) {
                                $permissionCommande = $permission;
                            } elseif ($permission != null) {
                                $permissionCommande .= ', ' . $permission;
                            }
                        }
                        if (!empty($permissionCommande)) {
                            $table = 'commande';
                            $this->userManager->givepermission($permissionCommande, $table, $user);
                        }
                    }
                    echo '<p>Utilisateur bien enregistré.</p>';
                } catch (PDOException $e) {
                    echo "<p>Erreur dans l'enregistrement de l'utilisateur.</p>";
                }
            }
        }
    }
    public function getPermission()
    {
        $droit = $this->userManager->getPermissionByCatalog();
        $superuser = $droit->rolsuper;
        $addRole = $droit->rolcreaterole;
        $tables = ['article', 'client', 'commande'];
        $typePermissions = ['SELECT', 'INSERT', 'UPDATE', 'DELETE'];
        $permissions = $this->userManager->getPermission();
        foreach ($tables as $table) {
            foreach ($typePermissions as $typePermission) {
                foreach ($permissions as $permission) {
                    if ($table == $permission->table_name) {
                        $tableauPermissions[$table][$typePermission] = $permission->privilege_type == $typePermission ? true : false;
                        if ($tableauPermissions[$table][$typePermission]) {
                            break;
                        }
                    }
                }
                if (!isset($tableauPermissions[$table])) {
                    $tableauPermissions[$table]['SELECT'] = false;
                    $tableauPermissions[$table]['INSERT'] = false;
                    $tableauPermissions[$table]['UPDATE'] = false;
                    $tableauPermissions[$table]['DELETE'] = false;
                }
            }
        }
        $_SESSION['superuser'] = $superuser;
        $_SESSION['addrole'] = $addRole;
        $_SESSION['permissions'] = $tableauPermissions;
        /* var_dump($_SESSION['superuser']);
        var_dump($_SESSION['addrole']);
        var_dump($_SESSION['permissions']); */
        /* SELECT * FROM pg_catalog.pg_user */
        /* SELECT * FROM pg_catalog.pg_roles */
    }
}