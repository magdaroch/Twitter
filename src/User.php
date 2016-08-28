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
            $sql = "UPDATE Users SET name='$this->name',email='$this->email',hashed_password='$this->hashPassword' WHERE id='$this->id'";
            $result = $connection->query($sql);
            if($result == TRUE){
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }
    static public function loadUserById(mysqli $connection, $id){
        $sql = "SELECT * FROM Users WHERE id= ".$connection->real_escape_string($id);
        
        $result = $connection->query($sql);
        if($result == TRUE && $result->num_rows == 1){
            $row = $result->fetch_assoc();
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->name = $row['name'];
            $loadedUser->hashPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];
            
            return $loadedUser;
        }
        return NULL;
    }
    static public function loadAllUsers(mysqli $connection){
        $sql = "SELECT * FROM Users";
        $ret = [];
        
        $result = $connection->query($sql);
        if($result == TRUE && $result->num_rows != 0){
            foreach($result as $row){
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->name = $row['name'];
                $loadedUser->hashPassword = $row['hashed_password'];
                $loadedUser->email = $row['email'];
                
                $ret[] = $loadedUser;
            }
        }return $ret;
    }
    public function delete(mysqli $connection){
        if($this->id != -1){
            $sql = "DELETE FROM Users WHERE id=$this->id";
            $result = $connection->query($sql);
            if($result == TRUE){
                $this->id = -1;
                return TRUE;
            }else{
                return FALSE;
            }
        }
    }
    static public function loadUserByEmail(mysqli $connection, $email){
        $sql = "SELECT * FROM Users WHERE email= '".$connection->real_escape_string($email)."'";
        
        $result = $connection->query($sql);
        if($result == TRUE && $result->num_rows == 1){
            $row = $result->fetch_assoc();
            
            $loadedUser = new User();
            $loadedUser->id = $row['id'];
            $loadedUser->name = $row['name'];
            $loadedUser->hashPassword = $row['hashed_password'];
            $loadedUser->email = $row['email'];
            
            return $loadedUser;
        }
        return NULL;
    }
    static public function login(mysqli $connection,$email,$password){
        $user = self::loadUserByEmail($connection,$email);
        if($user){
            if(password_verify($password,$user->hashPassword)){
                return $user;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    
}
