<?php
declare(strict_types = 1);

namespace Com\Daw2\Controllers;

class UsuarioController extends \Com\Daw2\Core\BaseController {
    
    function mostrarTodosUsuarios(){
        $modelo = new \Com\Daw2\Models\UsuarioModel();
        $usuarios = $modelo->getAllUsers();
        
        $data = array(
            'titulo' => 'Todos usuarios',
            'breadcrumb' => ['Inicio', 'Usuarios'],
            'seccion' => 'usuarios-full',
            'usuarios' => $usuarios
        );        
        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    
    function mostrarUsuariosOrderBySalar(){
        $modelo = new \Com\Daw2\Models\UsuarioModel();
        $usuarios = $modelo->getAllUserOrderBySalar();
        
        $data = array(
            'titulo' => 'Usuarios por salario',
            'breadcrumb' => ['Inicio', 'Usuarios'],
            'seccion' => 'usuarios-salar',
            'usuarios' => $usuarios
        );        
        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    
    function mostrarUsuariosCarlos(){
        $modelo = new \Com\Daw2\Models\UsuarioModel();
        $usuarios = $modelo->getUsersNameCarlos();
        
        $data = array(
            'titulo' => 'Usuarios Carlos',
            'breadcrumb' => ['Inicio', 'Usuarios'],
            'seccion' => 'usuarios-carlos',
            'usuarios' => $usuarios
        );        
        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    
    function mostrarUsuariosStandard(){
        $modelo = new \Com\Daw2\Models\UsuarioModel();
        $usuarios = $modelo->getStandardUsers();
        
        $data = array(
            'titulo' => 'Usuarios Standard',
            'breadcrumb' => ['Inicio', 'Usuarios'],
            'seccion' => 'usuarios-standard',
            'usuarios' => $usuarios
        );        
        $this->view->showViews(array('templates/header.view.php', 'usuarios.view.php', 'templates/footer.view.php'), $data);
    }
    
    function mostrarListadoFiltros() : void{               
        $rolModel = new \Com\Daw2\Models\AuxRolModel();
        $roles = $rolModel->getAll();
        
        $countriesModel = new \Com\Daw2\Models\AuxCountriesModel();
        $paises = $countriesModel->getAll();
        
        $input = filter_var_array($_GET, FILTER_SANITIZE_SPECIAL_CHARS);
        
        $modelo = new \Com\Daw2\Models\UsuarioModel();
        $usuarios = $modelo->filter($_GET);
        
        $data = array(
            'titulo' => 'Usuarios',
            'breadcrumb' => ['Inicio', 'Usuarios'],
            'seccion' => 'usuarios',
            'usuarios' => $usuarios,
            'roles' => $roles,
            'paises' => $paises,
            'input' => $input,
            'js' => array('plugins/select2/js/select2.full.min.js', 'assets/js/pages/usuarios-filtro.view.js')
        );                
        $this->view->showViews(array('templates/header.view.php', 'usuarios-filtro.view.php', 'templates/footer.view.php'), $data);
    }    
}