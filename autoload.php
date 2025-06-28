<?php

function ControllersAutoload($nombreClase) {
    if (file_exists('controllers/' . $nombreClase . '.php')) {
        include 'controllers/' . $nombreClase . '.php';
    } elseif (file_exists('models/' . $nombreClase . '.php')) {
        include 'models/' . $nombreClase . '.php';
    } elseif (file_exists('config/' . $nombreClase . '.php')) {
        include 'config/' . $nombreClase . '.php';
    }
}

spl_autoload_register('ControllersAutoload');