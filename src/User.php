<?php

class User{
    private $id;
    private $name;
    private $email;
    private $hashPassword;
    
    public function __construct(){
        $this->id = -1;
        $this->name = "";
        $this->email = "";
        $this->hashPassword = "";
    }
    
    public function getId(){
        return $this->id;
    }
    public function setName($newName){
        if(is_string($newName) && strlen(trim($newName)) > 0){
            $this->name = trim($newName);
        }
    }
    public function getName(){
        return $this->name;
    }
    public function setEmail($newEmail){
        if(is_string($newEmail) && strlen(trim($newEmail)) >= 5){
            $this->email = trim($newEmail);
        }
    }
    public function getEmail(){
        return $this->email;
    }
    
    public function setPassword($newPassword){
        if(is_string($newPassword) && strlen(trim($newPassword)) > 5){
            $newHashPassword = password_hash($newPassword,PASSWORD_DEFAULT);
            $this->hashPassword = $newHashPassword;
        }
    }
    public function saveToDB(mysqli $connection){
        if($this->id == -1){
            $sql = "INSERT INTO Users(name,email,hashed_password) VALUES ('$this->name','$this->email','$this->hashPassword')";
            $result = $connection->query($sql);
            if($result == TRUE){
                $this->id = $connection->insert_id;
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            
        }
    }
}
