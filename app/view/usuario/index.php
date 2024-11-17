<?php
use app\controller\UsuarioController;

$controller = new UsuarioController($pdo);

$action = $_GET['action'] ?? 'list';

if ($action === 'store') {
    $controller->store();
    $action = 'list'; 
} elseif ($action === 'update') {
    $controller->update($_GET['id']);
    $action = 'list';
} elseif ($action === 'delete') {
    $controller->delete($_GET['id']); 
    $action = 'list';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD de Contatos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/footer.css">
</head>
<body>
    <header>
        <img src="assets/img/logo_alphacode.png" alt="simbolo da logo da Alphacode">
        <h1>Cadastro de contatos</h1>
    </header>
    <main>
        <div class="mt-5">
            <form id="createForm" action="?action=store" method="POST">
                <div class="form-row">
                    <div class="form-group col-12">
                        <label for="nome">Nome</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex.: Letícia Pacheco dos santos" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="data-nascimento">Data de Nascimento</label>
                        <input type="text" class="form-control" id="data-nascimento" name="data-nascimento" placeholder="Ex.: 03/10/2003" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ex.: leticia@gmail.com" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="profissao">Profissão</label>
                        <input type="text" class="form-control" id="profissao" name="profissao" placeholder="Ex: Desenvolvedora Web" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="telefone">Telefone</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="Ex.: (11) 4033-2019" required>
                    </div>
                    <div class="form-group col-12">
                        <label for="celular">Celular</label>
                        <input type="tel" class="form-control" id="celular" name="celular" placeholder="(11) 98493-2039" required>
                    </div>
                </div>

                <div class="checkbox-group">

                    <input type="hidden" name="whatsapp" value="false">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="whatsapp" name="whatsapp" value="true">
                        <label class="form-check-label" for="whatsapp">Número de celular possui WhatsApp</label>
                    </div>

                    <input type="hidden" name="notificacoes-email" value="false">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="notificacoes-email" name="notificacoes-email" value="true">
                        <label class="form-check-label" for="notificacoes-email">Enviar notificações por email</label>
                    </div>

                    <input type="hidden" name="notificacoes-sms" value="false">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="notificacoes-sms" name="notificacoes-sms" value="true">
                        <label class="form-check-label" for="notificacoes-sms">Enviar notificações por SMS</label>
                    </div>
                </div>

                <div class="btn-submit">
                    <button type="submit" class="btn btn-primary">Cadastrar Contato</button>
                </div>
            </form>

        </div>
        <div class="linha"></div>
        <?php if ($action === 'list'): ?>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Data Nascimento</th>
                            <th>E-mail</th>
                            <th>Celular para contato</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($controller->index() as $usuario): ?>
                            <?php 
                                $dataNascimento = (new DateTime($usuario['data_nascimento']))->format('d/m/Y'); // Formatar a data para exibição
                            ?>
                            <tr>
                                <td><?= htmlspecialchars($usuario['nome']) ?></td>
                                <td><?= htmlspecialchars($dataNascimento) ?></td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td><?= htmlspecialchars($usuario['celular']) ?></td>
                                <td>
                                    <a href="#" 
                                        class="btn btn-edit" 
                                        data-id="<?= $usuario['id'] ?>" 
                                        data-nome="<?= htmlspecialchars($usuario['nome']) ?>" 
                                        data-data-nascimento="<?= htmlspecialchars($dataNascimento) ?>" 
                                        data-email="<?= htmlspecialchars($usuario['email']) ?>" 
                                        data-profissao="<?= htmlspecialchars($usuario['profissao']) ?>" 
                                        data-telefone="<?= htmlspecialchars($usuario['telefone']) ?>" 
                                        data-celular="<?= htmlspecialchars($usuario['celular']) ?>" 
                                        data-whatsapp="<?= $usuario['whatsapp'] ?>" 
                                        data-notificacoes-email="<?= $usuario['notificacoes_email'] ?>" 
                                        data-notificacoes-sms="<?= $usuario['notificacoes_sms'] ?>" 
                                        data-toggle="modal" 
                                        data-target="#editModal">
                                        <img src="assets/img/editar.png" alt="Editar">
                                    </a>

                                    <a href="#" 
                                        class="btn" 
                                        data-id="<?= $usuario['id'] ?>" 
                                        data-nome="<?= htmlspecialchars($usuario['nome']) ?>" 
                                        data-email="<?= htmlspecialchars($usuario['email']) ?>" 
                                        data-toggle="modal" 
                                        data-target="#deleteModal">
                                            <img src="assets/img/excluir.png" alt="Excluir">
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
        <!-- Modal de Edição -->
        <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Editar Contato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="editForm" action="?action=update" method="POST">
                        <div class="modal-body">
                            <input type="hidden" name="id" id="editId" value="<?= $usuario['id'] ?>">
                            
                            <div class="form-group mb-3">
                                <label for="editNome">Nome</label>
                                <input type="text" name="nome" id="editNome" class="form-control" value="<?= htmlspecialchars($usuario['nome']) ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editDataNascimento">Data de Nascimento</label>
                                <input type="text" name="data-nascimento" id="editDataNascimento" class="form-control" value="<?= htmlspecialchars($usuario['data_nascimento']) ?>" placeholder="dd/mm/yyyy" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editEmail">Email</label>
                                <input type="email" name="email" id="editEmail" class="form-control" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editProfissao">Profissão</label>
                                <input type="text" name="profissao" id="editProfissao" class="form-control" value="<?= htmlspecialchars($usuario['profissao']) ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editTelefone">Telefone</label>
                                <input type="text" name="telefone" id="editTelefone" class="form-control" value="<?= htmlspecialchars($usuario['telefone']) ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="editCelular">Celular</label>
                                <input type="text" name="celular" id="editCelular" class="form-control" value="<?= htmlspecialchars($usuario['celular']) ?>" required>
                            </div>

                            <!-- Campos de checkbox com valores passados dinamicamente -->
                            <input type="hidden" name="whatsapp" value="false">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="whatsappModal" name="whatsapp" value="true" <?= $usuario['whatsapp_checked'] ?>>
                                <label class="form-check-label" for="whatsapp">Número de celular possui WhatsApp</label>
                            </div>

                            <input type="hidden" name="notificacoes-email" value="false">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="notificacoes-email-modal" name="notificacoes-email" value="true" <?= $usuario['notificacoes_email_checked'] ?>>
                                <label class="form-check-label" for="notificacoes-email">Enviar notificações por email</label>
                            </div>

                            <input type="hidden" name="notificacoes-sms" value="false">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="notificacoes-sms-modal" name="notificacoes-sms" value="true" <?= $usuario['notificacoes_sms_checked'] ?>>
                                <label class="form-check-label" for="notificacoes-sms">Enviar notificações por SMS</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-warning">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal de Confirmação de Exclusão -->
        <div class="deleteModal modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirmar Exclusão</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="deleteForm" action="?action=delete" method="POST">
                        <div class="modal-body">
                            <p>Tem certeza de que deseja excluir este usuário?</p>
                            <p id="deleteUserInfo"></p>
                            <input type="hidden" name="id" id="deleteUserId">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <h3>Termos | Políticas</h3>
        <div>
            <h3>&#169; Copyright 2024 | desenvolvido por </h3>
            <img src="assets/img/logo_rodape_alphacode.png" alt="logo e nome da empresa Alphacode">
        </div>
        <h3>&#169;Alphacode IT Solutions 2024</h3>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/inputmask/dist/inputmask.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/mask.js"></script>
</body>
</html>