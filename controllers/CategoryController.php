<?php

require_once 'models/categoria.php';
require_once 'models/producto.php';
class CategoryController {
    public function index() {
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require "views/categoria/index.php";
    }

    public function create() {
        Utils::isAdmin();

        require "views/categoria/create.php";
    }

    public function save() {
        unset($_SESSION["category"]);

        if (isset($_POST) && isset($_POST['nombre'])) {
            // Averiguar si el usuario es admin
            Utils::isAdmin();
            //Guardo categoria
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $save = $categoria->save();
            if($save) {
                Utils::setFlash("category", "complete");
            }else{
                Utils::setFlash("category", "failed");
            }
        }

        header ('Location: '.base_url.'category/index');
    }

    public function ver(){
        if(isset($_GET["id"])){
            $id = $_GET["id"];

            // Conseguir categoria
            $categoria = new Categoria();
            $categoria->setId($id);
            $categoria_id = $categoria->getId();
            $categoria = $categoria->getOne();

            //Consigo productos
            $producto = new Producto();
            $producto->setCategoriaId($categoria_id);
            $productos = $producto->getAllByCategory();
        }
        require_once "views/categoria/ver.php";
    }
}