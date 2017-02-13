<?php

namespace App\Models;

use PDO;

/**
 * Auth model
 *
 * PHP version 5.4
 */
class Auth extends \Core\Model
{


    /**
     * openConn Connect to the database 
     *
     * @param 	
     * @return 	 $conn
     */
    public static function openConn(){
        
        try {
            $db = static::getDB();
            return $db;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     * isUserRegistered method 
     *
     * @param 	string  email the email to check
     * @return  int     result 1 if already registered otherwise 0
     */
    public static function isEmailRegistered ($email){
        try {

            //$db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $db = static::getDB();

            $query = "SELECT email FROM users WHERE email = ?";

            $stmt = $db->prepare($query);

            $stmt->execute([$email]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $result;
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }


    /**
     * validateUser         used by LoginController class  
     *
     * @param 	string      $email, user registered email
     *          string      $password, user password 
     * @return	bool        1, credentials matched otherwise 0  
     */
    public function validateUser ($email, $password ){
        try {
            $db = static::getDB();

            $records = $db->prepare('SELECT id,email,password FROM users WHERE email = :email');
            $records->bindParam(':email', $email);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);


            if(count($results) > 0 && password_verify($password, $results['password']) ){
                $results = 1;
            } else {
                $results = 0;
            }

            
            
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }


    /**
     * registerNewUserAction add a new user in the database 
     *
     * @param 	    string  $email, user email 
     *              string  $password, user password  
     * @return      bool    1 on success.	 
     */
    public static function registerNewUser($email, $password){
        $db = static::getDB();

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        if(!empty($email) && !empty($_POST['password'])){ // empty to be removed later 

            // Enter the new user in the database
            $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
            $stmt = $db->prepare($sql);

            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashedPassword);

            /*
             * 1 = Successfully created new user
             * 0 = Sorry there must have been an issue creating your account
             */
            return ( $stmt->execute() );  
        }
    }


}


