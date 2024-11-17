<?php
// Carregar o autoload do Composer (se estiver usando o Composer)
require_once __DIR__ . '../../vendor/autoload.php';

// Incluir a configuração do banco de dados
require_once __DIR__ . '../../config/database.php';

// Definir a URL base
define('BASE_URL', 'http://localhost:8000');

// Mapeia as URLs para a Controller
$uri = $_SERVER['REQUEST_URI'];

// Ação padrão (listar os usuarios)
$action = $_GET['action'] ?? 'list'; 

// Instanciando o controlador de usuarios
require_once __DIR__ . '/../app/controller/UsuarioController.php';
$controller = new \app\controller\UsuarioController($pdo); 

// Iclui a view do cadastro de usuário
include __DIR__ . '/../app/view/usuario/index.php';

// Verifica qual ação foi solicitada na URL e chama o método adequado
switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'store':
        $controller->store(); 
        break;
    case 'edit':
        $controller->edit($_GET['id']);
        break;
    case 'update':
        $controller->update($_GET['id']); 
        break;
    case 'delete':
        $controller->delete($_GET['id']);
        break;
    case 'list':
    default:
        $controller->index();
        break;
}
