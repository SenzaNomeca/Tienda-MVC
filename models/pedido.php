<?php


class Pedido{
    private $id;
    private $usuario_id;
    private $region;
    private $municipio;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;

    private $db;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuario_id;
    }

    /**
     * @param mixed $usuario_id
     */
    public function setUsuarioId($usuario_id): void
    {
        $this->usuario_id = $usuario_id;
    }

    /**
     * @return mixed
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * @param mixed $region
     */
    public function setRegion($region): void
    {
        $this->region = $this->db->real_escape_string($region);
    }

    /**
     * @return mixed
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * @param mixed $municipio
     */
    public function setMunicipio($municipio): void
    {
        $this->municipio = $this->db->real_escape_string($municipio);
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion): void
    {
        $this->direccion = $this->db->real_escape_string($direccion);
    }

    /**
     * @return mixed
     */
    public function getCoste()
    {
        return $this->coste;
    }

    /**
     * @param mixed $coste
     */
    public function setCoste($coste): void
    {
        $this->coste = $coste;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @param mixed $hora
     */
    public function setHora($hora): void
    {
        $this->hora = $hora;
    }

    public function __construct(){
        $this->db = Database::connect();
    }

    public function getAll(){
        $pedido = $this->db->query('SELECT * FROM pedidos ORDER BY id DESC');
        return $pedido;
    }


    public function getOne(){
        $pedido = $this->db->query('SELECT * FROM pedidos WHERE id = '.$this->id);
        return $pedido->fetch_object();
    }

    public function getOneByUser(){
        $sql = "SELECT p.id, p.coste FROM pedidos p "
            //. "INNER JOIN lineas_pedidos lp ON lp.pedido_id = p.id "
            . "WHERE p.usuario_id = {$this->getUsuarioId()} "
            . "ORDER BY p.id DESC LIMIT 1";
        $pedido = $this->db->query($sql);
        return $pedido->fetch_object();
    }

    public function getAllByUser(){
        $sql = "SELECT p.* FROM pedidos p "
            . "WHERE p.usuario_id = {$this->getUsuarioId()} ORDER BY p.id DESC";
        $pedido = $this->db->query($sql);
        return $pedido;
    }

    public function getProductsByOrder($id){
//        $sql = "SELECT * FROM productos WHERE id IN"
//            ."(SELECT producto_id FROM lineas_pedidos WHERE pedido_id = {$id}) ";

        $sql = "SELECT pr.*, lp.unidades FROM productos pr "
            ."INNER JOIN lineas_pedidos lp ON pr.id = lp.producto_id "
            ."WHERE lp.pedido_id = {$id}";

        $productos = $this->db->query($sql);
        return $productos;
    }

    public function save(){
        $sql = "INSERT INTO pedidos VALUES (NULL, {$this->getUsuarioId()},'{$this->getRegion()}', '{$this->getMunicipio()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME())";
        $save = $this->db->query($sql);


        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function save_linea(){
        $sql = "SELECT LAST_INSERT_ID() AS 'pedido';";
        $query= $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];

            $insert = "INSERT INTO lineas_pedidos VALUES (NULL, {$pedido_id}, {$producto->id}, {$elemento['unidades']})";
            $save = $this->db->query($insert);
            $update_stock = "UPDATE productos SET stock = stock - {$elemento['unidades']} WHERE id = {$producto->id}";
            $this->db->query($update_stock);
        }
        $result = false;
        if($save){
            $result = true;

        }
        return $result;
    }

    public function updateStatus(){
        $sql = "UPDATE pedidos SET estado ='{$this->getEstado()}' WHERE id = '{$this->getId()}';";

        $save = $this->db->query($sql);
        return $save;
    }




}