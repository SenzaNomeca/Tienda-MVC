<?php

class Usuario{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $rol;
    private $imagen;
    private $db;

    public function __construct(){
        $this->db = Database::connect();
    }


    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido): void
    {
        $this->apellido = $this->db->real_escape_string($apellido);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email): void
    {
        $this->email = $this->db->real_escape_string($email);
    }

    public function getPassword()
    {
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);;
    }

    public function setPassword($password): void
    {
        $this->password = $password;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol): void
    {
        $this->rol = $rol;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen): void
    {
        $this->imagen = $imagen;
    }

    public function save(){
        $sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', NULL)";
        $save =  $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;
        $step = 0;

        // Comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '{$email}'";
        $login = $this->db->query($sql);
        if ($login && $login->num_rows > 0) {
            $usuario = $login->fetch_object();
            $step = 1;
            $result = $step;
            //Verificamos password
            $verify = password_verify($password, $usuario->password);
            if ($verify) {
                $result = $usuario ;
            }
        }
    return $result;
    }

}