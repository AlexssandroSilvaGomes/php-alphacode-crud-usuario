<?php

namespace app\controller;

use app\model\UsuarioModel;

class UsuarioController
{
    private $pdo;
    private $usuarioModel;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->usuarioModel = new UsuarioModel($this->pdo);
    }

    // Método para listar os usuários com paginação
    public function index($page = 1)
    {
        $limit = 10;
        $offset = ($page - 1) * $limit;
    
        try {
            $usuarios = $this->usuarioModel->allUsers($limit, $offset);
    
            foreach ($usuarios as &$usuario) {
                $usuario['notificacoes_sms_checked'] = $usuario['notificacoes_sms'] === 'true' ? true : false;
                $usuario['notificacoes_email_checked'] = $usuario['notificacoes_email'] === 'true'? true : false;
                $usuario['whatsapp_checked'] = $usuario['whatsapp'] === 'true' ? true : false;
            }
    
            return $usuarios;
        } catch (\Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Erro ao buscar usuários: ' . $e->getMessage()]);
        }
    }
    

    // Método para armazenar um novo usuário
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
            $validacao = $this->validarUsuario($dados);

            if ($validacao['status'] !== 200) {
                echo json_encode($validacao);
                return;
            }

            try {
                // Converte a data de nascimento para o formato 'yyyy-mm-dd', se presente nos dados
                if (isset($dados['data-nascimento']) && !empty($dados['data-nascimento'])) {
                    $dados['data-nascimento'] = \DateTime::createFromFormat('d/m/Y', $dados['data-nascimento'])
                    ->format('Y-m-d');
                }

                $this->preencherUsuarioModel($dados);
                $this->usuarioModel->createUser();

                return $this->index();  
            } catch (\Exception $e) {
                echo json_encode(['status' => 500, 'message' => 'Erro ao criar usuário: ' . $e->getMessage()]);
            }
        }
    }


    // Método para editar um usuário
    public function edit($id)
    {
        try {
            $usuario = $this->usuarioModel->findUserById($id);
            if (!$usuario) {
                echo json_encode(['status' => 404, 'message' => 'Usuário não encontrado.']);
                return;
            }

            $usuario['notificacoes_sms_checked'] = $usuario['notificacoes_sms'] === 'true' ? true : false;
            $usuario['notificacoes_email_checked'] = $usuario['notificacoes_email'] === 'true'? true : false;
            $usuario['whatsapp_checked'] = $usuario['whatsapp'] === 'true' ? true : false;
    
            return $usuario;
        } catch (\Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Erro ao buscar usuário: ' . $e->getMessage()]);
        }
    }
    

    // Método para atualizar o usuário
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
            $validacao = $this->validarUsuario($dados);
    
            if ($validacao['status'] !== 200) {
                echo json_encode($validacao);
                return;
            }
    
            try {
                // Converte a data de nascimento para o formato 'yyyy-mm-dd', se presente nos dados
                if (isset($dados['data-nascimento']) && !empty($dados['data-nascimento'])) {
                    $dados['data-nascimento'] = \DateTime::createFromFormat('d/m/Y', $dados['data-nascimento'])
                        ->format('Y-m-d');
                }
    
                $this->usuarioModel->id = $id;
                $this->preencherUsuarioModel($dados);
                $this->usuarioModel->updateUser();
    
                return $this->index();
            } catch (\Exception $e) {
                echo json_encode(['status' => 500, 'message' => 'Erro ao atualizar usuário: ' . $e->getMessage()]);
            }
        }
    }
    



    // Método para excluir o usuário
    public function delete($id)
    {
        if (empty($id) || !is_numeric($id)) {
            echo json_encode(['status' => 400, 'message' => 'ID do usuário inválido.']);
            return;
        }
    
        try {
            $this->usuarioModel->deleteUserById($id);
    
            return $this->index();
        } catch (\Exception $e) {
            echo json_encode(['status' => 500, 'message' => 'Erro ao excluir usuário: ' . $e->getMessage()]);
        }
    }

    // Validação dos dados do usuário
    private function validarUsuario($dados)
    {
        if (empty($dados['nome']) || strlen($dados['nome']) > 150) {
            return ['status' => 400, 'message' => 'Nome inválido. Deve ter até 150 caracteres.'];
        }
        if (empty($dados['data-nascimento'])) {
            return ['status' => 400, 'message' => 'Data de nascimento inválida. Use o formato YYYY-MM-DD.'];
        }

        if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            return ['status' => 400, 'message' => 'Email inválido.'];
        }

        if (empty($dados['profissao']) || strlen($dados['profissao']) > 100) {
            return ['status' => 400, 'message' => 'Profissão inválida. Deve ter até 100 caracteres.'];
        }

        if (!empty($dados['telefone']) && strlen($dados['telefone']) > 20) {
            return ['status' => 400, 'message' => 'Telefone inválido.'];
        }

        if (!empty($dados['celular']) && strlen($dados['celular']) > 20) {
            return ['status' => 400, 'message' => 'Celular inválido.'];
        }

        return ['status' => 200];
    }

    // Preenche o modelo de usuário com os dados fornecidos
    private function preencherUsuarioModel($dados)
    {
        $this->usuarioModel->nome = $dados['nome'];
        $this->usuarioModel->data_nascimento = $dados['data-nascimento'];
        $this->usuarioModel->email = $dados['email'];
        $this->usuarioModel->profissao = $dados['profissao'];
        $this->usuarioModel->telefone = $dados['telefone'] ?? null;
        $this->usuarioModel->celular = $dados['celular'] ?? null;
        $this->usuarioModel->whatsapp = $dados['whatsapp'] === 'true' ? 1 : 0;
        $this->usuarioModel->notificacoes_email = $dados['notificacoes-email'] === 'true' ? 1 : 0;
        $this->usuarioModel->notificacoes_sms = $dados['notificacoes-sms'] === 'true' ? 1 : 0;
    }
}
