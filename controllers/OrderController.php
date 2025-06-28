<?php
require_once 'models/pedido.php';
class OrderController {
    public function hacer() {
        require_once 'views/pedido/hacer.php';
    }

    public function add(){
        if(isset($_SESSION['identity'])){
            $usuario_id = $_SESSION['identity']->id;
            $region = isset($_POST['region']) ? $_POST['region'] : false;
            $municipio= isset($_POST['municipio']) ? $_POST['municipio'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $stats = Utils::stastCarrito();
            $coste = $stats['total'];


            if($region && $direccion && $municipio ) {
                //Guardar pedido
                $pedido = new Pedido();
                $pedido->setUsuarioId($usuario_id);
                $pedido->setRegion($region);
                $pedido->setMunicipio($municipio);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();

                //Guardar linea pedido
                $save_linea = $pedido->save_linea();

                if($save && $save_linea){
                    $_SESSION['pedido'] = "complete";
                    if(isset($_SESSION['carrito'])){
                        unset($_SESSION['carrito']);
                    }
                }else{
                    $_SESSION['pedido'] = "failed";
                }
            }else{
                $_SESSION['pedido'] = "failed";
            }
            header("location:".base_url."order/confirmado");
        }else{
            header("location:".base_url."user/registro");
        }

    }

    public function confirmado(){
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuarioID($identity->id);

            $pedido = $pedido->getOneByUser();

            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByOrder($pedido->id);
        }
        require_once 'views/pedido/confirmado.php';
    }

    public function misPedidos(){
        Utils::isIdentity();

        $usuario_id = $_SESSION['identity']->id;
        $pedido = new Pedido();
        $pedido->setUsuarioId($usuario_id);
        $pedidos = $pedido->getAllByUser();

        require_once 'views/pedido/misPedidos.php';
    }

    public function detalle(){
        Utils::isIdentity();

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            // Sacar datos del pedido
            $pedido = new Pedido();
            $pedido->setId($id);

            $pedido = $pedido->getOne();

            // Sacamos datos de los productos
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProductsByOrder($id);

            require_once 'views/pedido/detalle.php';

        }else{
            header("location:".base_url."order/misPedidos");
        }
    }

    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        require_once 'views/pedido/misPedidos.php';
    }

    public function estado(){
        utils::isAdmin();
        if(isset($_POST['pedido_id'])){
            //Update del estado del pedido
            $id = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($estado);

            $pedido = $pedido->updateStatus();

            header("location:".base_url."order/detalle&id=".$id);
        }else{
            header("location:".base_url);
        }
    }
}