<?php


class UserController {

    private $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }
    public function register($userData){
       
    }
    public function login($userData) {
         return true;
    }

    public function logout(): void {
        // Lógica de logout
    }
}
