<?php

class User{
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    public $bdd;

    function public construct($id,$login,$email,$firstname,$lastname){
        $this->id = $id;
        $this->login = $login;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->bdd = mysqli_connect('localhost', 'root', 'root', 'classes');
    }

    function public register($login, $password, $email, $firstname, $lastname){
        mysqli_set_charset($this->bdd,'utf8');
        $User_Exist = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE login = '".$login."'");
        $Row_Exist = mysqli_num_rows($User_Exist);
        if($Row_Exist == 1){
            echo 'Utilisateur déjà existant';
        }
        else{
            $Register = mysqli_query($this->bdd, "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ('$login','$password','$email','$firstname','$lastname')");
        }
    }

    function public connect($login, $password){
        mysqli_set_charset($this->bdd,'utf8');
        $loginA = $_POST['loginA'];
        $passwordA = $_POST['passwordA'];
        $recupUserConnect = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE login = '".$loginA."' AND password ='".$passwordA."'");
        $row = mysqli_num_rows($recupUserConnect);
        $fetch = mysqli_fetch_assoc($recupUserConnect);
        if($row == 1){
            $_SESSION['user'] = $fetch;
        }
        exit();
    }

    function public disconnect(){
        session_destroy();
        exit();
    }

    function public delete(){
        $loginD = $_SESSION['user']['login'];
        $delete = mysqli_query($this->bdd,"DELETE FROM utilisateurs WHERE login = '".$loginD."'");
        session_destroy();
        header('Location: index.php');
        exit();
    }

    function public update($login, $password, $email, $firstname, $lastname){
        mysqli_set_charset($this->bdd,'utf8');
        $loginUpdate = $_SESSION['user']['login'];
        $updateUser = mysqli_query($this->bdd, "UPDATE utilisateurs SET
                                    login = '".$login."',
                                    password = '".$password."',
                                    email = '".$email."',
                                    firstname = '".$firstname."',
                                    lastname = '".$lastname."'
                                    WHERE login = '".$loginUpdate."'");
        session_destroy();
        exit();
    }

    function public isConnected(){
        echo ((bool)$_SESSION).'</br>';
    }

    function public getAllInfos(){
        mysqli_set_charset($this->bdd,'utf8');
        $connected = $_SESSION['user']['login'];
        $isConnect = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE `login`= '".$connected."'");
        $rows = mysqli_num_rows($isConnect);
        if ($rows == 1){
            $fetch = mysqli_fetch_all($isConnect, MYSQLI_ASSOC);?>
            <table>
                <thead>
                    <tr>
                        <th>Login</th>
                        <th>Email</th>
                        <th>Prenom</th>
                        <th>Nom</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($fetch as $profil){
                        echo'<tr><td>'.$profil['login'].'</td>';
                        echo'<td>'.$profil['email'].'</td>';
                        echo'<td>'.$profil['firstname'].'</td>';
                        echo'<td>'.$profil['lastname'].'</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
    }

    function public getLogin(){
        mysqli_set_charset($this->bdd,'utf8');
        $connected = $_SESSION['user']['login'];
        $isConnect = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE `login`= '".$connected."'");
        $rows = mysqli_num_rows($isConnect);
        if ($rows == 1){
            $fetch = mysqli_fetch_all($isConnect, MYSQLI_ASSOC);
            foreach($fetch as $profil){
                echo 'Login : '.$profil['login'].'</br>';
            }
        }
    }

    function public getEmail(){
        mysqli_set_charset($this->bdd,'utf8');
        $connected = $_SESSION['user']['login'];
        $isConnect = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE `login`= '".$connected."'");
        $rows = mysqli_num_rows($isConnect);
        if ($rows == 1){
            $fetch = mysqli_fetch_all($isConnect, MYSQLI_ASSOC);
            foreach($fetch as $profil){
                echo 'Email : '.$profil['email'].'</br>';
            }
        }
    }

    function public getFirstname(){
        mysqli_set_charset($this->bdd,'utf8');
        $connected = $_SESSION['user']['login'];
        $isConnect = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE `login`= '".$connected."'");
        $rows = mysqli_num_rows($isConnect);
        if ($rows == 1){
            $fetch = mysqli_fetch_all($isConnect, MYSQLI_ASSOC);
            foreach($fetch as $profil){
                echo 'Prénom : '.$profil['firstname'].'</br>';
            }
        }
    }

    function public getLastname(){
        mysqli_set_charset($this->bdd,'utf8');
        $connected = $_SESSION['user']['login'];
        $isConnect = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE `login`= '".$connected."'");
        $rows = mysqli_num_rows($isConnect);
        if ($rows == 1){
            $fetch = mysqli_fetch_all($isConnect, MYSQLI_ASSOC);
            foreach($fetch as $profil){
                echo 'Nom : '.$profil['lastname'].'</br>';
            }
        }
    }
}
