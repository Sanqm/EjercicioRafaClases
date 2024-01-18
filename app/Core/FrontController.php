<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController{
    
    static function main(){
        Route::add('/', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\InicioController();
                    $controlador->index();
                }
                , 'get');
        
        Route::add('/formulario', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\FormularioExamenController();
                    $controlador->mostrarFormulario();
                }
                , 'get');
                
        Route::add('/formulario', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\FormularioExamenController();
                    $controlador->procesarFormulario();
                }
                , 'post');
                
        Route::add('/usuarios-full', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarTodosUsuarios();
                }
                , 'get');
        
        Route::add('/usuarios', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarListadoFiltros();
                }
                , 'get');
        
        Route::add('/usuarios-carlos', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarUsuariosCarlos();
                }
                , 'get');
        Route::add('/usuarios-standard', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarUsuariosStandard();
                }
                , 'get');
        
        Route::add('/usuarios-salar', 
                function(){
                    $controlador = new \Com\Daw2\Controllers\UsuarioController();
                    $controlador->mostrarUsuariosOrderBySalar();
                }
                , 'get');
                
        Route::pathNotFound(
            function(){
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error404();
            }
        );
        
        Route::methodNotAllowed(
            function(){
                $controller = new \Com\Daw2\Controllers\ErroresController();
                $controller->error405();
            }
        );
        Route::run();
    }
}

