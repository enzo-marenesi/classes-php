<?php

class user {
    private $id;
    public $login;
    public $email;
    public $password;
    public $firstname;
    public $lastname;
}



function public construct{
    $this->id = $id;
    $this->login = $login; 
    $this->email = $email; 
    $this->firstname = $firstname; 
    $this->lastname = $lastname;
    $this->bdd = mysqli_connect('localhost', 'root', '', 'classes');
}

function public register($login,$email,$firstname,$lastname){
    mysqli_set_charset($this->bdd,'utf8');
    $User_Exist = mysqli_query ($this->bdd,"SELECT * FROM utilisateurs WHERE + '".$login."' " );
    $Row_Exist= mysqli_num_rows($User_Exist);
    if($Row_Exist == 1){
        echo 'Utilisateur déjà utlisé';
        else
        $query = mysqli_query($this->bdd, "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ('$login','$password','$email','$firstname','$lastname')");
    }
}

function public connect($login,$password){
    mysqli_set_charset($this->bdd,'utf8');
    $loginA = $_POST['loginA'];
    $passwordA = $_POST['passwordA'];
    $useconnect = mysqli_query($this->bdd, "SELECT * FROM utilasateurs WHERE login '".$loginA"' AND password = '".$passwordA"'");
    $row = mysqli_num_rows($useconnect);
    $fetch = mysqli_fetch_assoc($useconnect);
    if($row == 1){
        $_SESSION['user'] = $fetch;
    }
}

function public disconnect(){
    session_destroy();
    }

    
function public delete(){
    $loginB = $_SESSION ['user']['login'];
    $delete = mysqli_query($this->bdd,"DELETE FROM utilisateurs WHERE login = '".$loginB"'");
    session_destroy();
    }

function public update($login,$password,$email,$firstname,$lastname){
    mysqli_set_charset($this->bdd,'utf8');
    $loginjour = $_SESSION['user']['login'];
    $jouruser = mysqli_query($this->bdd, "UPDATE utilisateurs SET login ='".$login"', password ='".$password"', email ='".$email"', firstname ='".$firstname"', lastname ='".$lastname"' WHERE login ='".$loginjour"'");
    session_destroy();
}

function public isConnected(){
    echo((bool)$_SESSION).'</br>';
}

function public getAllInfos(){
    mysqli_set_charset($this->bdd,'utf8');
    $connected = $_SESSION['user']['login'];
    $con = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE `login`= '".$connected."'");
    $rows = mysqli_num_rows($con);
    if ($rows == 1){
        $fetch = mysqli_fetch_all($con, MYSQLI_ASSOC);?>
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
    $con = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE `login`= '".$connected."'");
    $rows = mysqli_num_rows($con);
    if ($rows == 1){
        $fetch = mysqli_fetch_all($con, MYSQLI_ASSOC);
        foreach($fetch as $profil){
            echo 'Login : '.$profil['login'].'</br>';
        }
    }
  }


  public function getEmail(){
    mysqli_set_charset($this->bdd,'utf8');
    $connected = $_SESSION['user']['login'];
    $isConnect = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE `login`= '".$connected."'");
    $rows = mysqli_num_rows($con);
    if ($rows == 1){
        $fetch = mysqli_fetch_all($con, MYSQLI_ASSOC);
        foreach($fetch as $profil){
            echo 'Email : '.$profil['email'].'</br>';
        }
    }
  }
  
  public function getFirstname(){
    mysqli_set_charset($this->bdd,'utf8');
    $connected = $_SESSION['user']['login'];
    $con = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE `login`= '".$connected."'");
    $rows = mysqli_num_rows($con);
    if ($rows == 1){
        $fetch = mysqli_fetch_all($con, MYSQLI_ASSOC);
        foreach($fetch as $profil){
            echo 'Prénom : '.$profil['firstname'].'</br>';
        }
    }
  }
  
  public function getLastname(){
    mysqli_set_charset($this->bdd,'utf8');
    $connected = $_SESSION['user']['login'];
    $con = mysqli_query($this->bdd, "SELECT * FROM utilisateurs WHERE `login`= '".$connected."'");
    $rows = mysqli_num_rows($con);
    if ($rows == 1){
        $fetch = mysqli_fetch_all($con, MYSQLI_ASSOC);
        foreach($fetch as $profil){
            echo 'Nom : '.$profil['lastname'].'</br>';
        }
    }
  }


