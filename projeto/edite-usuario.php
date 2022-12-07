<?php
session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: home.php");
    exit;
}

require_once('entidade/Usuario.php');

$usuario = new Usuario();
$result = $usuario->getUsuario(htmlspecialchars($_SESSION["email"]));
$row = $result->fetch_assoc();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["botaoExcluir"])) {
        $usuario->id = $row['id'];
        if ($usuario->Excluir()) {
            session_destroy();
            header('location: home.php');
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Erro: falha ao excluir usuário
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>';
        }
    } else {
        if (
            isset($_POST['nome']) && $_POST['nome'] != ""
            && isset($_POST['email']) && $_POST['email'] != ""
            && isset($_POST['senha']) && $_POST['senha'] != ""
            && isset($_POST['confirmSenha']) && $_POST['confirmSenha'] != ""
        ) {
            if ($_POST['senha'] == $_POST['confirmSenha']) {
                $usuario->id = $row['id'];
                $usuario->nome = $_POST['nome'];
                $usuario->email = $_POST['email'];
                $usuario->foto = $_POST['foto'];
                $usuario->senha = $_POST['senha'];
                if ($usuario->Update()) {
                    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                Usuário atualizado com sucesso
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
                    $_SESSION["usuario"] = $usuario->nome;
                    $_SESSION["email"] = $usuario->email;
                    $result = $usuario->getUsuario(htmlspecialchars($_SESSION["email"]));
                    $row = $result->fetch_assoc();
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Erro: falha de conxão com banco de dados
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
                }

            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Erro: senhas não são iguais!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Erro: campos vazios ou em branco, preencha todos os campos.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>SWE-USUARIO</title>
</head>

<body>
    <!--Navibar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top nav-height">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
            aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto d-flex align-items-center">
                <li class="nav-item active">
                    <?php if (isset($row['foto']) && $row['foto'] != null): ?>
                    <img src="<?php echo $row['foto'] ?>" alt="Imagem do user" width="50px" height="50px"
                        class="img-fluid rounded-circle">
                    <?php else: ?>
                    <img src="image/usuario.jpg" alt="Imagem do user" width="50px" height="50px"
                        class="img-fluid rounded-circle">
                    <?php endif; ?>
                </li>
                <li class="nav-item dropdown pl-3">
                    <a class="nav-link dropdown-toggle font-weight-bold text-dark fs-16 p-0 pr-1
                     pl-1" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <?php echo htmlspecialchars($_SESSION["usuario"]); ?>
                    </a>
                    <div class="dropdown-menu ml-3" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./edite-usuario.php">Editar/Excluir Usuário</a>
                    </div>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto d-flex align-items-center">
                <li class="nav-item pl-3">
                    <a href="inicio.php" class="m-0 font-weight-bold text-white fs-16">
                        <button type="button" class="btn btn-danger ">
                            voltar <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">

        <div class="row d-flex align-items-center min-height">
            <img class="col-md-6" src="./image/cadastro.png" alt="">
            <div class="col-md-6 mt-5 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input class="form-control" type="text" name="nome" id="nome" placeholder="Seu nome"
                                    value="<?php echo $row['nome'] ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="usuario">Email</label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Seu email"
                                    value="<?php echo $row['email'] ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="foto">Link da Foto</label>
                                <input class="form-control" type="text" name="foto" id="foto"
                                    value="<?php echo $row['foto'] ?>" placeholder="Link da sua foto">
                            </div>

                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input class="form-control" type="password" name="senha" id="senha"
                                    value="<?php echo $row['senha'] ?>" placeholder="Sua senha" required>
                            </div>

                            <div class="form-group">
                                <label for="confirmSenha">Confirmar Senha</label>
                                <input class="form-control" type="password" name="confirmSenha" id="confirmSenha"
                                    value="<?php echo $row['senha'] ?>" placeholder="Confirme sua senha" required>
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="button" data-toggle="modal" data-target="#modalExemplo"
                                    class="btn btn-danger mr-4">Excluir</button>
                                <button type="submit" name="botaoEditar" class="btn btn-success">Editar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Deletar Usuário</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Deseja realmente deletar seu usuário?
                    Todas suas postagens e interações serão apagadas
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <input data-dismiss="modal" style="display: none;" name="botaoExcluir">
                        <button type="submit" name="botaoExcluir" class="btn btn-danger">Excluir</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <hr>
    <footer class="page-footer font-small ">
        <div class="footer-copyright  text-center py-3">
            <p class="copyright text-muted">Copyright &copy; SWE 2022</p>
        </div>
    </footer>

    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>