<?php


class Producto{
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
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

    public function getCategoriaId()
    {
        return $this->categoria_id;
    }

    public function setCategoriaId($categoria_id): void
    {
        $this->categoria_id = $categoria_id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre): void
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio): void
    {
        $this->precio = $this->db->real_escape_string($precio);
    }

    public function getStock()
    {
        return $this->stock;
    }

    public function setStock($stock): void
    {
        $this->stock = $this->db->real_escape_string($stock);
    }

    public function getOferta()
    {
        return $this->oferta;
    }

    public function setOferta($oferta): void
    {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }
    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen): void
    {
        $this->imagen = $imagen;
    }


    public function getAll(){
        $productos = $this->db->query('SELECT * FROM productos ORDER BY id DESC');
        return $productos;
    }

    public function getAllByCategory(){
        $sql = "SELECT p.*, c.nombre AS 'Catnombre' FROM productos p "
                     ."INNER JOIN categorias c ON p.categoria_id = c.id "
                     ."WHERE categoria_id = {$this->categoria_id} "
                     ."ORDER BY id DESC";
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getRandom($limit=null){
        $productos = $this->db->query('SELECT * FROM productos ORDER BY RAND() LIMIT '.$limit);
        return $productos;
    }

    public function getOne(){
        $producto = $this->db->query('SELECT * FROM productos WHERE id = '.$this->id);
        return $producto->fetch_object();
    }

    public function save(){
        $sql = "INSERT INTO productos VALUES (NULL, {$this->getCategoriaId()},'{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, NULL, CURDATE(), '{$this->getImagen()}')";
        $save = $this->db->query($sql);


        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function edit() {
        $sql = "UPDATE productos SET 
                nombre = '{$this->getNombre()}', 
                descripcion = '{$this->getDescripcion()}', 
                precio = {$this->getPrecio()}, 
                stock = {$this->getStock()}, 
                categoria_id = {$this->getCategoriaId()}";

        if ($this->getImagen() != NULL) {
            $sql .= ", imagen = '{$this->getImagen()}'";
        }

        $sql .= " WHERE id = {$this->getId()};";

        $save = $this->db->query($sql);
        return $save;
    }

    public function delete(){
        $sql = "DELETE FROM productos WHERE id = {$this->getId()}";
        $delete = $this->db->query($sql);
        $result = false;
        if($delete){
            $result = true;
        }
        return $result;
    }



}