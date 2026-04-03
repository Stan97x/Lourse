<?php

class User
{

    private $db;

    function __construct($conn)
    {
        $this->db = $conn;
    }
    public function Login($user, $password)
    {
        try {
            // Rechercher l'utilisateur par son nom d'utilisateur
            $sql = "SELECT * FROM `compte` WHERE `USER` = :user";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user', $user);
            $stmt->execute();
            $userData = $stmt->fetch(PDO::FETCH_ASSOC);
            // Vérifier si l'utilisateur existe
            if (!$userData) {
                return "L'utilisateur n'existe pas.";
            }

            // Vérifier si le mot de passe correspond
            if (password_verify($password, $userData['MDP'])) {
                // Le mot de passe est correct, retourner les données de l'utilisateur
                return $userData;
            } else {
                // Le mot de passe est incorrect
                return "Le mot de passe est incorrect.";
            }
        } catch (PDOException $e) {
            // En cas d'erreur de la base de données, renvoyer un message d'erreur
            return "Erreur de la base de données : " . $e->getMessage();
        }
    }

    public function GetUserbyPseudo($user)
    {
        $sql = "SELECT COUNT(*) AS count FROM compte WHERE user = :user";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user', $user);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result['count'] > 0) {
            return false;
        } else {
            return $result;
        }
    }
    public function getUsersbyUSERS($id)
    {
        try 
        {$sql="SELECT`ID`,`USER`,`MDP`,`ADRCOMPTE` FROM compte where Id=:id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindparam(':id', $id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        }   
        catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    

    public function EditUser($id,$param)
    {
        try
        {
            $sql = "UPDATE `compte` SET
            USER     =?,
                MDP      =?,
                ADRCOMPTE          =?,
                WHERE 
                  ID         =?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute($param);
            if($stmt)
            {
                return true;
                return $id;
            }
                
        }
        catch(PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function Register($user, $email, $password)
    {
        try {
            $res = $this->GetUserbyPseudo($user);
            if ($res === false) {
                return false;
            } else {
                // Hacher le mot de passe
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Préparer et exécuter la requête SQL avec le mot de passe haché
                $sql = "INSERT INTO `compte`(`USER`,`MDP`,`ADRCOMPTE`) VALUES (:user, :MDP, :email)";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':user', $user);
                $stmt->bindParam(':MDP', $hashedPassword); // Utiliser le mot de passe haché
                $stmt->bindParam(':email', $email);

                $stmt->execute();
                return true;
            }
        } catch (PDOException $e) {
            // Gérer les erreurs éventuelles
            // echo $e->getMessage();
            return false;
        }
    }
    
    // funtion to return all users form rese bd
    public function getUsers()
    {
        try {
            $sql = "SELECT * FROM compte";
            $result = $this->db->query($sql);
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
