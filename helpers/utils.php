<?php

class Utils{
    public static function deleteSession($nameSession){
        if(isset($_SESSION[$nameSession])){
            $_SESSION[$nameSession] = null;
        }
        return $nameSession;
    }

    public static function setFlash($key, $value) {
        $_SESSION['flash'][$key] = $value;
    }

    public static function getFlash($key) {
        if(isset($_SESSION['flash'][$key])) {
            $value = $_SESSION['flash'][$key];
            unset($_SESSION['flash'][$key]);
            return $value;
        }
        return null;
    }

    public static function isAdmin() {
        if(!isset($_SESSION['admin'])){
            header('location:'.base_url);
        }else{
            return true;
        }
    }

    public static function isIdentity(){
        if(!isset($_SESSION['identity'])){
            header('location:'.base_url);
        }else{
            return true;
        }
    }

    public static function showCategorys($limit = null){
        require_once 'models/categoria.php';
        $categoria = new Categoria();

        $sqlLimit = (isset($limit) && is_numeric($limit)) ? "LIMIT " . intval($limit) : '';
        $categorias = $categoria->getAll($sqlLimit);
        return $categorias;
    }

    public static function stastCarrito(){
        $stats = array('count' => 0,
            'total' => 0
        );

        if(isset($_SESSION['carrito'])){
            $stats['count'] = count($_SESSION['carrito']);
            foreach ($_SESSION['carrito'] as $producto) {
                $stats['total'] += $producto['precio_producto']* $producto['unidades'];
            }
        }
        return $stats;
    }

    public static function showStatus($status){
        $value = 'Pendiente';
        if($status == 'confirm'){
            $value = 'Pendiente';
        }elseif ($status == 'preparation'){
            $value = 'En preparacion';
        }elseif ($status == 'ready'){
            $value = 'Preparado';
        }elseif ($status == 'sended'){
            $value = 'Enviado';
        }
        return $value;
    }
}