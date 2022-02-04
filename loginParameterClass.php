<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of loginParameterClass
 *
 * @author z0047brw
 */

require_once 'FaceBookLiteConnection.php';
class loginParameterClass {
    protected $username;
    protected $password;
    protected $dbConnection;
    
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
            $this->password=filter_input(INPUT_POST,"psw",FILTER_DEFAULT);
            echo $this->password;
    }
    
    public function __getUsername()
    {
        return $this->username;
    }
    
    public function checkLogin()
    {
        /**
         * SQL: select BenutzerId from benutzer where BenutzerName=this->username and Passwort=this->password;
         */
        
        $sql="select BenutzerId from benutzer where BenutzerName='".$this->username."' and Passwort='".$this->password."';";
     
        try
        {
            $res=$this->dbConnection->query($sql,PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
             echo "<script>console.log('abc')</script>";
            echo 'Abfrage fehlgeschlagen: ' . $e->getMessage();
            die();       
        }
        //$row=$res->fetch();
        if (sizeof($res) == 1)
        {
           
            return true;
               
               
               
        }
           
           
        return false;
        
       
    }
}
