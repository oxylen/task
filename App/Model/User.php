<?php

namespace App\Model;

use App\Utils\Bdd;

class User{
    //attributs
    private int $idUser;
    private string $firstname;
    private string $lastname;
    private string $email;
    private string $password;

    //BDD
    private \PDO $connexion;

    //constructeur
    public function __construct(){
        $this->connexion = (new Bdd())->connectBDD();
    }

    //getters et setters
    public function getIdUser():int{
        return $this->idUser;
    }

    public function setIdUser(int $id){
        $this->idUser = $id;
    }

    public function getFirstName():string{
        return $this->firstname;
    }

    public function setFirstname(string $firstname){
        $this->firstname = $firstname;
    }

    public function getLastName():string{
        return $this->lastname;
    }

    public function setLastname(string $lastname){
        $this->lastname = $lastname;
    }

    public function getEmail():string{
        return $this->email;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }

    public function getPassword():string{
        return $this->password;
    }

    public function setPassword(string $password){
        $this->password = $password;
    }

    //méthode pour hash et vérifier le password
    public function hashPassword(){
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function passwordVerify(string $hash):bool{
        return password_verify($this->password, $hash);
    }

    //methodes (requete SQL)
    public function saveUser():User{
        try{
            $firstname = $this->firstname;
            $lastname = $this->lastname;
            $email = $this->email;
            $password = $this->password;

            $request = "INSERT INTO users(firstname, lastname, email, password) VALUE (?,?,?,?)";
            $req = $this->connexion;
            $sqlRequest = $req->prepare($request);
            $sqlRequest->bindParam(1, $firstname, \PDO::PARAM_STR);
            $sqlRequest->bindParam(2, $lastname, \PDO::PARAM_STR);
            $sqlRequest->bindParam(3, $email, \PDO::PARAM_STR);
            $sqlRequest->bindParam(4, $password, \PDO::PARAM_STR);
            $sqlRequest->execute();
            $id = $req->lastInsertId('users');
            $this->idUser = $id;
            return $this;
        } catch(\Exception $e){
            throw new \Exception($e->getMessage());
        }
    }

}