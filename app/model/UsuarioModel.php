<?php

namespace app\model;

use app\dao\UsuarioDAO;

class UsuarioModel
{
    private $dao;

    public $id; 
    public $nome; 
    public $email; 
    public $data_nascimento; 
    public $profissao; 
    public $telefone; 
    public $celular; 
    public $tem_whatsapp; 
    public $notificacao_sms; 
    public $notificacao_email;

    // Construtor recebe a instância do DAO
    public function __construct($pdo)
    {
        $this->dao = new UsuarioDAO($pdo);
    }

    // Método para criar um usuario
    public function createUser()
    {
        return $this->dao->create($this->nome, $this->data_nascimento, $this->email, $this->profissao, $this->telefone, $this->celular, $this->whatsapp, $this->notificacoes_email, $this->notificacoes_sms);
    }

    // Método para buscar todos os usuarios com paginamento
    public function allUsers($limit = 10, $offset = 0)
    {
        return $this->dao->findAll($limit, $offset);
    }

    // Método para buscar um usuario por ID
    public function findUserById($id)
    {
        return $this->dao->findById($id);
    }

    // Método para atualizar o usuario
    public function updateUser()
    {
        return $this->dao->update($this->id, $this->nome, $this->data_nascimento, $this->email, $this->profissao, $this->telefone, $this->celular, $this->whatsapp, $this->notificacoes_email, $this->notificacoes_sms);
    }

    // Método para deletar o usuario
    public function deleteUserById($id)
    {
        return $this->dao->delete($id);
    }
}
