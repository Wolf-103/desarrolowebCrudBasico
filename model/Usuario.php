<?php

class Usuario implements JsonSerializable{
    private $id;
    private $username;
    private $password;
    private $status;
    private $email;
    private $telephone;
    private $firstname;
    private $lastname;

    public function __construct($id, $username, $password, $status, $email, $telephone, $firstname, $lastname)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->status = $status;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
    }

    public function jsonSerialize(): array {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'status' => $this->status,
            'email' => $this->email,
            'telephone' => $this->telephone,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname
        ];
    }

}
?>