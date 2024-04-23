<?php
    namespace App;
    class User{
        public $username;
        public $password;
        public $locked;
        public function __construct($username, $password){
            $this->username = $username;
            $this->password = $password;
        }    
        public function authenticate(string $password):bool{
            if($this->password == $password){
                return true;
            }
            else{
                return false;
            }
        }
        public function reset_password(string $password){
            $this->password = $password;
        }
        public function is_locked():bool{
            if($this->locked == false){
            return false;
            }
            elseif ($this->locked == true) {
            return true;
            }
            return false;
        }
        public function lock_user(){
            $this->locked = false;
        }
        public function unlock_user(){
            $this->locked = true;
        }
    }