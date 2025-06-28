<?php
require_once "models/producto.php";
class ProductController {
    public function index() {
        // Renderizar vista
        $producto = new Producto();
        $productos = $producto->getRandom(6);

        require "views/producto/destacado.php";
    }

    public function ver(){
        if(isset($_GET["id"])){
            $id = $_GET["id"];
            $producto =  new producto();
            $producto->setId($id);

            $pro = $producto->getOne();
        }
        require_once 'views/producto/ver.php';
    }

    public function gestion(){
        Utils::isAdmin();

        $producto =  new producto();
        $productos = $producto->getAll();

        require_once "views/producto/gestion.php";
    }

    public function crear(){
        Utils::isAdmin();
        require "views/producto/crear.php";
    }

    public function save(){
        Utils::isAdmin();
        if(isset($_POST)){
            $nombre = isset($_POST["nombre"])?$_POST["nombre"]:null;
            $descripcion = isset($_POST["descripcion"])?$_POST["descripcion"]:null;
            $precio = isset($_POST["precio"])?$_POST["precio"]:null;
            $stock = isset($_POST["stock"])?$_POST["stock"]:null;
            $categoria = isset($_POST["categoria"])?$_POST["categoria"]:null;
            //$image = isset($_POST["image"])?$_POST["image"]:null;


            if($nombre && $descripcion && $precio && $stock && $categoria){
                $producto = new producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoriaId($categoria);

                // Guardar la imagen
                if(isset($_FILES["imagen"])){
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if($mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/jpg" || $mimetype == "image/gif"){
                        if(!is_dir('uploads/images')){
                            mkdir('uploads/images', 0777, true);
                        }
                        $producto->setImagen($filename);
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
                    }
                }

                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $producto->setId($id);

                    $save = $producto->edit();
                }else{
                    $save = $producto->save();
                }


                if($save){
                    $_SESSION['producto'] = "complete";
                }else{
                    $_SESSION['producto'] = "failed";
                }
            }else{
                $_SESSION['producto'] = "failed";
            }
        }else{
            $_SESSION['producto'] = "failed";
        }
        header('location:'.base_url.'product/gestion');
    }

    public function editar(){
        utils::isAdmin();

        if(isset($_GET["id"])){
            $edit = true;
            $producto =  new producto();
            $producto->setId($_GET["id"]);

            $pro = $producto->getOne();

            require_once 'views/producto/crear.php';
        }else{
            header('location:'.base_url.'product/gestion');
        }
    }

    public function eliminar(){
        Utils::isAdmin();
        if(isset($_GET["id"])){
            $producto = new producto();
            $producto->setId($_GET["id"]);
            $delete = $producto->delete();
            if($delete){
                $_SESSION['delete'] = "complete";
            }else{
                $_SESSION['delete'] = "failed";
            }
        }else{
            $_SESSION['delete'] = "failed";
        }
        header('location:'.base_url.'product/gestion');
    }

}