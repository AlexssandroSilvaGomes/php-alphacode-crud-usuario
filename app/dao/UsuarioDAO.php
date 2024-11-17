<?php

namespace app\dao;

class UsuarioDAO
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para buscar todos os usuários com paginamento
    public function findAll($limit = 10, $offset = 0)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_usuario LIMIT :limit OFFSET :offset");
        
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, \PDO::PARAM_INT);
        
        $stmt->execute();
        
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Método para buscar um usuário por ID
    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tbl_usuario WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Método para criar um usuário
    public function create($nome, $data_nascimento, $email, $profissao, $telefone, $celular, $whatsapp, $notificacoes_email, $notificacoes_sms)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO tbl_usuario (nome, data_nascimento, email, profissao, telefone, celular, whatsapp, notificacoes_email, notificacoes_sms) 
            VALUES (:nome, :data_nascimento, :email, :profissao, :telefone, :celular, :whatsapp, :notificacoes_email, :notificacoes_sms)"
        );
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profissao', $profissao);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':whatsapp', $whatsapp);
        $stmt->bindParam(':notificacoes_email', $notificacoes_email);
        $stmt->bindParam(':notificacoes_sms', $notificacoes_sms);
        return $stmt->execute();
    }

    // Método para atualizar o usuário
    public function update($id, $nome, $data_nascimento, $email, $profissao, $telefone, $celular, $whatsapp, $notificacoes_email, $notificacoes_sms)
    {
        $stmt = $this->pdo->prepare(
            "UPDATE tbl_usuario SET nome = :nome, data_nascimento = :data_nascimento, email = :email, profissao = :profissao, 
            telefone = :telefone, celular = :celular, whatsapp = :whatsapp, notificacoes_email = :notificacoes_email, 
            notificacoes_sms = :notificacoes_sms WHERE id = :id"
        );
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':data_nascimento', $data_nascimento);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profissao', $profissao);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':celular', $celular);
        $stmt->bindParam(':whatsapp', $whatsapp);
        $stmt->bindParam(':notificacoes_email', $notificacoes_email);
        $stmt->bindParam(':notificacoes_sms', $notificacoes_sms);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Método para deletar o usuário
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM tbl_usuario WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
