<?php
require_once 'models/usuario.php';

class UserController {
    public function index() {
        echo "Hola mundo from UserController, action: index";
    }

    public function registro() {
        require_once 'views/usuario/registro.php';
    }

    public function save() {
        if (isset($_POST)) {
            unset($_SESSION['error_nombre']);
            unset($_SESSION['error_apellidos']);
            unset($_SESSION["register"]);

            $nombre = isset($_POST["nombre"]) ? $_POST["nombre"] : false;
            $apellido = isset($_POST["apellidos"]) ? $_POST["apellidos"] : false;
            $email = isset($_POST["email"]) ? $_POST["email"] : false;
            $password = isset($_POST["password"]) ? $_POST["password"] : false;

            if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
                $nombre_validate = true;
            }else{
                $nombre_validate = false;
                $_SESSION['error_nombre'] = "nombre";
            }

            if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)){
                $apellido_validate = true;
            }else{
                $apellido_validate = false;
                $_SESSION['error_apellidos'] = "apellidos";
            }



            if($nombre && $apellido && $email && $password && $nombre_validate && $apellido_validate){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellido($apellido);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
                $save = $usuario->save();
                if ($save) {
                    $_SESSION["register"] = "complete";
                }else{
                    //var_dump($_POST);
                    //echo"<hr>Este error es por si el save no funciono";
                    //exit;
                    $_SESSION["register"] = "failed";
                }
            }else{
                //var_dump($_POST);
                //echo"<hr>Este error es por si no existe algun dato";
                //exit;
                $_SESSION["register"] = "failed";
            }
        }else{
            //var_dump($_POST);
            //echo"<hr>Este error es por si no llego nada por POST";
            //exit;
            $_SESSION["register"] = "failed";
        }
        header("Location: " .base_url.'user/registro');
    }

    public function login() {
        if(isset($_POST)){
            //Identificar al usuario
            //1. Constulta a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST["email"]);
            $usuario->setPassword($_POST["password"]);

            $identity = $usuario->login();

            if (isset($identity) && is_object($identity) && !is_numeric($identity) && $identity) {
                //2. Creamos la sesion
                $_SESSION["identity"] = $identity;

                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            }elseif ($identity == 1){
                Utils::setFlash("login_error", "password wrong");
            } else{
                Utils::setFlash("login_error", "identificacion fallida");
            }

        }
        header("Location: " .base_url);
    }

    public function logout() {
        if(isset($_SESSION["identity"])){
            unset($_SESSION["identity"]);
        }
        if(isset($_SESSION["admin"])){
            unset($_SESSION["admin"]);
        }
        header("Location: " .base_url);
    }
}
