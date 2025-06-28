<?php


class Categoria{
    private $id;
    private $nombre;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }


    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getAll($limit = ''){
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id  DESC ". $limit);
        return $categorias;
    }

    public function getOne(){
        $categorias = $this->db->query("SELECT * FROM categorias WHERE id = {$this->getId()}");
        return $categorias->fetch_object();
    }

    public function save(){
        $result = false;

        $sqlNombreRepetido = "Select nombre from categorias where nombre = '".$this->nombre."'";
        $prueba = $this->db->query($sqlNombreRepetido);

        if($prueba->num_rows == 0){
            $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}')";
            $save =  $this->db->query($sql);

            if ($save) {
                $result = true;
            }
        }
        return $result;
    }



}