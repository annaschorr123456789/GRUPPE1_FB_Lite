<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of registerParameterClass
 * email and username must be unique in database
 * TODO:
 * Function:    Check for existing username 
 * Function:    Check for existing email
 * 
 * Function:    
 * Search for highest index in database
 * Insert new User in database at index+1
 * 
 * 
 * 
 * @author z0047brw
 */

require_once 'FaceBookLiteConnection.php';
class registerParameterClass {
    //put your code here
    protected $dbConnection;
    protected $eMail;
    protected $password;
    protected $username;
    
    public function __construct() 
    {
        
           
            $this->dbConnection=new FaceBookLiteConnection();
            if (empty($_POST["username"])) 
            {  
                $errMsg = "Error! You didn't enter the Name.";  
                echo $errMsg;  
            } 
            else 
            {  
                $name = $_POST ["username"];  
                if (!preg_match ("/^[a-zA-z]*$/", $name) )
                {  
                    $ErrMsg = "Only alphabets and whitespace are allowed.";  
                    echo $ErrMsg;  
                }
                else 
                {  
                    $this->username=$name;   
                    
                }   
            }
            $this->eMail=filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
            
            $this->password=filter_input(INPUT_POST,"psw",FILTER_DEFAULT);
            echo $this->password;
    }
    public  function checkUsername()
    {
        $sql="select BenutzerId from benutzer where BenutzerName='".$this->username."';";
     
        try
        {
            $res=$this->dbConnection->query($sql,PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            echo "<script>console.log('abc')</script>";
            echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
            die();       
        }
        if (sizeof($res) == 1)
        {
            echo "Benutzername bereits vergeben <br>";
            $_SESSION["RegisterUsernameAlreadyTaken"]=true;
            return false;
           
        }
        $_SESSION["RegisterUsernameAlreadyTaken"]=false;   
        return true;
        
        
    }
    public  function checkEmail()
    {
        $sql="select BenutzerId from benutzer where EMail='".$this->eMail."';";
     
        try
        {
            $res=$this->dbConnection->query($sql,PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            echo "<script>console.log('abc')</script>";
            echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
            die();       
        }
        if (sizeof($res) == 1)
        {
            echo"email bereits vergeben <br>";
            
            $_SESSION["RegisterEmailAlreadyTaken"]=true;
            
            return false;
           
        }
        $_SESSION["RegisterEmailAlreadyTaken"]=false;   
        return true;
    }
    
    public  function insertNewUser()
    {

        $sql="INSERT INTO Benutzer (BenutzerName, EMail, Passwort) VALUES ('".$this->username."', '".$this->eMail."' , '".$this->password."');";
        
        try
        {
            $res=$this->dbConnection->query($sql,PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
            
            echo 'Einfügen fehlgeschlagen: ' . $e->getMessage();
            die();       
        }
    }
    
}
