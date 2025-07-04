<?php
require_once 'models/producto.php';
class CartController {
    public function index() {
        if(isset($_SESSION['carrito'])){
            $carrito = $_SESSION['carrito'];
        }

        require 'views/carrito/index.php';
    }

    public function add(){
        if(isset($_GET['id'])){
            $producto_id = $_GET['id'];
        }else{
            header('Location:'.base_url);
        }


        if(isset($_SESSION['carrito'])){
            $count = 0;
            foreach($_SESSION['carrito'] as $indice => $elemento){
                if($elemento['id_producto'] == $producto_id){
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $count++;
                }
            }
        }

        if(!isset($count) || $count == 0){
            //Conseguir producto
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto = $producto->getOne();

            // Add al carrito
            if(is_object($producto)){
                $_SESSION['carrito'][] = array(
                    'id_producto' => $producto->id,
                    'nombre_producto' => $producto->nombre,
                    'precio_producto' => $producto->precio,
                    'unidades' => 1,
                    "producto" => $producto,
                );
            }
        }
        header('Location:'.base_url.'cart/index');
    }

    public function remove(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header('Location:'.base_url.'cart/index');
    }

    public function up(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']++;

        }
        header('Location:'.base_url.'cart/index');
    }

    public function down(){
        if(isset($_GET['index'])){
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            
            if($_SESSION['carrito'][$index]['unidades'] == 0){
                unset($_SESSION['carrito'][$index]);
            }

        }
        header('Location:'.base_url.'cart/index');
    }

    public function delete_all(){
        if(isset($_SESSION['carrito'])){
            unset($_SESSION['carrito']);
        }
        header('Location:'.base_url.'cart/index');
    }
}