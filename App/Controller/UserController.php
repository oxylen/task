<?php

namespace App\Controller;

use App\Model\User;
use App\Utils\Utilitaire;

class UserController{
    private User $user;

    public function __construct(){
        $this->user = new User();
    }

    public function addUser()
    {
        //Message erreur ou confirmation
        $message = "";
        //tester si le formulaire est soumis
        if (isset($_POST["submit"])) {
            //tester si le champs est non vide
            if (!empty($_POST["firstname"]) and !empty($_POST["lastname"]) and !empty($_POST["email"]) and !empty($_POST["password"])) {
                //nettoyer les informations
                $firstname = Utilitaire::sanitize($_POST["firstname"]);
                $lastname = Utilitaire::sanitize($_POST["lastname"]);
                $email = Utilitaire::sanitize($_POST["email"]);
                $password = Utilitaire::sanitize($_POST["password"]);
                //Créer un Objet User
                $user = new User();
                //Setter
                $user->setFirstname($firstname);
                $user->setLastname($lastname);
                $user->setEmail($email);
                $user->setPassword($password);
                //hasher le password
                $user->hashPassword();
                //ajouter le user en BDD
                $user->saveUser();
                //redirection vers la liste des categories avec un paramètre GET
                $message = "L'utilisateur a été ajouté en BDD";
            } else {
                $message = "Veuillez remplir les champs obligatoire";
            }
        }

        include "App/View/viewAddUser.php";
    }
}
