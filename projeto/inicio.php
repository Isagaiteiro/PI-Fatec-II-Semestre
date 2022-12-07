<?php
require_once('entidade/Usuario.php');
require_once('entidade/Postagem.php');

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: home.php");
    exit;
}

$usuario = new Usuario();
$result = $usuario->getUsuario(htmlspecialchars($_SESSION["email"]));
$row = $result->fetch_assoc();

$postagem = new Postagem();
$postTema = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_POST["btnBuscar"]){
       header("location: #AA");
    }
        
    if (isset($_POST["btnPublicar"])) {
        if (
            isset($_POST['tema']) && $_POST['tema'] != ""
            && isset($_POST['url']) && $_POST['url'] != ""
            && isset($_POST['conteudo']) && $_POST['conteudo'] != ""
            && isset($_POST['tipo']) && $_POST['tipo'] != ""
            && isset($_POST['titulo']) && $_POST['titulo'] != ""
        ) {
            $data = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));

            $postagem->titulo = $_POST['titulo'];
            $postagem->tema = $_POST['tema'];
            $postagem->url = $_POST['url'];
            $postagem->conteudo = $_POST['conteudo'];
            $postagem->data = $data->format('Y-m-d H:i:s');
            $postagem->tipo = $_POST['tipo'];
            $postagem->idUsuario = $row['id'];

            if ($postagem->Cadastrar()) {
                header("location: #AA");
            } else {
                echo '<div class="alert alert-danger fixed-top alert-dismissible fade show" role="alert">
                Erro: postagem não cadastrada.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
              </div>';
            }

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="stylesheet" href="./css/inicio.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>SWE-INICIO</title>
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
                    <a href="logout.php" class="m-0 font-weight-bold text-white fs-16">
                        <button type="button" class="btn btn-danger ">
                            Sair <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!--Header-->
    <div class="container-fluid">
        <div class="row bg-light d-flex align-items-center header-height">
            <div class="col-md-6">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 text-center text-dark">
                        <h1 class="fs-54">Seja bem vindo(a)!</h1>
                        <h5 class="fs-18">Compartilhe aqui os suas fontes de estudo e contribua com o crescimento de
                            todos!</h5>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-3 mb-3">
                    <div class="">
                        <button class="btn btn-success justify-content-center" data-toggle="modal"
                            data-target="#novaPostagem">Nova
                            Postagem</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img class="img-fluid" src="image/educacao.png" alt="">
            </div>
            <div id="AA"></div>
        </div>
    </div>

    <!--Postagens-->
    <div class="container mb-5 mt-5" id="postagens">
        <nav>
            <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
                <a class="nav-item active nav-link text-secondary font-weight-bold" id="nav-porTema-tab"
                    data-toggle="tab" href="#porTema" role="tab" aria-controls="nav-porTema" aria-selected="false">Por
                    Tema</a>
                <a class="nav-item nav-link  text-secondary font-weight-bold" id="nav-todasPostagens-tab"
                    data-toggle="tab" href="#todasPostagens" role="tab" aria-controls="nav-todasPostagens"
                    aria-selected="true">Todas as Postagens</a>

                <a class="nav-item nav-link text-secondary font-weight-bold" id="nav-minhasPostagens-tab"
                    data-toggle="tab" href="#minhasPostagens" role="tab" aria-controls="nav-minhasPostagens"
                    aria-selected="false">Minhas
                    Postagens</a>

            </div>
        </nav>

        <div class="tab-content mt-5" id="nav-tabContent">
            <div class="tab-pane fade" id="todasPostagens" role="tabpanel" aria-labelledby="nav-todasPostagens-tab">
                <?php
                $postTema = $postagem->getAll();
                if ($postTema) {
                    while ($po = $postTema->fetch_assoc()):
                        $fordate = date('d/m/Y \à\s H:i', strtotime($po['postdate']));
                        echo "
                            <div class='card mb-5'>
                                <div class='card text-center'>
                                    <div class='card-body'>
                                        <h5 class='card-title m-0'>$po[titulo]</h5>
                                        <small class='text-muted'> Tema: $po[tema]</small>
                                        <p class='card-text mt-3'>$po[conteudo]</p>
                                        <a href='$po[url]' target='_blank'>Click aqui</a>
                                        <p class='card-text'><small class='text-muted'>$fordate</small></p>
                                        <p class='card-text'><small class='text-muted'>by: $po[nome]</small></p>
                                    </div>
                                </div>
                            </div>";
                    endwhile;
                }

                ?>
            </div>

            <div class="tab-pane fade" id="minhasPostagens" role="tabpanel" aria-labelledby="nav-minhasPostagens-tab">
                <?php
                $posts = $postagem->getPostagemByUser($row['id']);
                while ($po = $posts->fetch_assoc()):

                    $fordate = date('d/m/Y \à\s H:i', strtotime($po['postdate']));
                    echo "
                <div class='card mb-5'>
                    <div class='card text-center'>
                        <div class='card-body'>
                            <h5 class='card-title m-0'>$po[titulo]</h5>
                            <small class='text-muted'> Tema: $po[tema]</small>
                            <p class='card-text mt-3'>$po[conteudo]</p>
                            <a href='$po[url]' target='_blank'>Click aqui</a>
                            <p class='card-text'><small class='text-muted'>$fordate</small></p>
                            <a class='text-danger mr-3' href='edite-postagem.php?id=$po[idpostagem]'>Editar/Apagar</a>
                        </div>
                    </div>
                </div>";
                endwhile; ?>
            </div>

            <div class="tab-pane fade show active" id="porTema" role="tabpanel" aria-labelledby="nav-porTema-tab">
                <form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                    <div class="row row d-flex justify-content-center mt-5 mb-5">
                        <div class="form-group">
                            <select name="temaTipo" id="temaTipo" class="form-control">
                                <option value="tema" selected>tema</option>
                                <option value="tipo">tipo</option>
                            </select>
                        </div>
                        <div class=" col-4 form-group">
                            <input type="text" class="form-control" name="busca" id="busca">
                        </div class="form-group">
                        <div>
                            <button type="submit" name="btnBuscar" class="btn btn-success">Pesquisar</button>
                        </div>
                    </div>
                </form>
                <?php
                $postsT = $postagem->getByTemaTipo((!empty($_POST['temaTipo'])) ? $_POST['temaTipo'] : '', (!empty($_POST['busca'])) ? $_POST['busca'] : '');
                if ($postsT) {
                    
                    while ($pot = $postsT->fetch_assoc()):
                        $fordate = date('d/m/Y \à\s H:i', strtotime($pot['postdate']));
                        echo "
                            <div class='card mb-5'>
                                <div class='card text-center'>
                                    <div class='card-body'>
                                        <h5 class='card-title m-0'>$pot[titulo]</h5>
                                        <small class='text-muted'> Tema: $pot[tema]</small>
                                        <p class='card-text mt-3'>$pot[conteudo]</p>
                                        <a href='$pot[url]' target='_blank'>Click aqui</a>
                                        <p class='card-text'><small class='text-muted'>$fordate</small></p>
                                        <p class='card-text'><small class='text-muted'>by: $pot[nome]</small></p>
                                    </div>
                                </div>
                            </div>";
                    endwhile;
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="novaPostagem" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="TituloModalCentralizado">Nova Postagem</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" name="titulo" id="titulo"
                                placeholder="Digite o título">
                        </div>

                        <div class="form-group">
                            <label for="titulo">Link</label>
                            <input type="text" class="form-control" name="url" id="link" placeholder="Digite o link">
                        </div>

                        <div class="form-group">
                            <label for="titulo">Tema</label>
                            <input type="text" class="form-control" name="tema" id="tema" placeholder="Digite o tema">
                        </div>

                        <div class="form-group">
                            <label for="texto">Texto</label>
                            <textarea class="form-control" name="conteudo" id="texto" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="texto">Escolha o tipo:</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option>Video</option>
                                <option>Curso on-line</option>
                                <option>Livro</option>
                                <option>Artigo</option>
                                <option>Site</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="btnPublicar" class="btn btn-success">Publicar</button>
                    </div>
                </form>
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


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
        </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
        </script>
</body>

</html>