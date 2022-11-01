<?php
    session_start(); // initial session

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ // se não existir loggedin no session ou loggedin não estuver valido volta para index.php
        header("location: home.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/inicio.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>SWE-INICIO</title>
</head>

<body>
    <!--Navibar-->
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary sticky-top nav-height">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#conteudoNavbarSuportado"
            aria-controls="conteudoNavbarSuportado" aria-expanded="false" aria-label="Alterna navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="conteudoNavbarSuportado">
            <ul class="navbar-nav mr-auto d-flex align-items-center">
                <li class="nav-item active">
                    <img src="image/usuario.jpg" alt="Imagem do user" width="50px"
                        height="50px" class="img-fluid rounded-circle">
                </li>
                <li class="nav-item pl-3">
                    <p class="m-0 font-weight-bold text-white fs-16">Witer Mendonça</p>
                </li>

                <li class="nav-item pl-3">
                    <a [routerLink]="[ '/usuario-edit', id]">
                        <p class="text-white fs-16 m-0"><i class="fa fa-pencil-square-o " aria-hidden="true"></i></p>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto d-flex align-items-center">
                <li class="nav-item pl-3">
                    <button type="button" class="btn btn-outline-dark ">
                        <a href="logout.php" class="m-0 font-weight-bold text-white fs-16">Sair</a>
                    </button>

                </li>
            </ul>
        </div>
    </nav>

     <!--Header-->
    <div class="container-fluid">
        <div class="row bg-secondary d-flex align-items-center header-height">
            <div class="col-md-6">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12 text-center text-white">
                        <h1 class="fs-54">Seja bem vindo(a)!</h1>
                        <h5 class="fs-18">Compartilhe aqui os suas fontes de estudo e contribua com o crescimento de
                            todos!</h5>
                    </div>
                </div>
                <div class="row d-flex justify-content-center mt-3 mb-3">
                    <div class="">
                        <button class="btn btn-light justify-content-center" data-toggle="modal"
                            data-target="#novaPostagem">Nova
                            Postagem</button>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-center">
                <img class="img-fluid" src="image/educacao.png" alt="">
            </div>
        </div>
    </div>

     <!--Postagens-->
    <div class="container mb-5 mt-5" id="postagens">
        <nav>
            <div class="nav nav-tabs d-flex justify-content-center" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active text-secondary font-weight-bold" id="nav-todasPostagens-tab"
                    data-toggle="tab" href="#todasPostagens" role="tab" aria-controls="nav-todasPostagens"
                    aria-selected="true">Todas as Postagens</a>

                <a (click)='findByIdUsuario()' class="nav-item nav-link text-secondary font-weight-bold"
                    id="nav-minhasPostagens-tab" data-toggle="tab" href="#minhasPostagens" role="tab"
                    aria-controls="nav-minhasPostagens" aria-selected="false">Minhas
                    Postagens</a>

                <a class="nav-item nav-link text-secondary font-weight-bold" id="nav-postagemTema-tab" data-toggle="tab"
                    href="#postagemTema" role="tab" aria-controls="nav-postagemTema" aria-selected="false">Postagens por
                    tema</a>

                <a class="nav-item nav-link text-secondary font-weight-bold" id="nav-postagemTipo-tab" data-toggle="tab"
                    href="#postagemTipo" role="tab" aria-controls="nav-postagemTipo" aria-selected="false">Postagens por
                    tipo</a>
            </div>
        </nav>

        <!-- <h2 *ngIf='listaPostagem.length == 0' class="text-center text-secondary mt-5">
            Não existem postagens ainda...
        </h2>-->

        <div class="tab-content mt-5" id="nav-tabContent">
            <div class="tab-pane fade show active" id="todasPostagens" role="tabpanel"
                aria-labelledby="nav-todasPostagens-tab">

                <div class="card">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title m-0">titulo</h5>
                            <small class="text-muted"> Tema: JavaScript</small>
                            <p class="card-text mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam
                                consequatur nobis earum officiis. Illo sapiente, voluptates quae modi facilis
                                distinctio, voluptatum repellat reiciendis a pariatur possimus adipisci. Unde, debitis
                                alias?</p>
                            <a href="">Link de alguma coisa</a>
                            <p class="card-text"><small class="text-muted">24/10/2022 às 21:35</small></p>
                            <p class="card-text"><small class="text-muted">by: Witer Mendonça</small></p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="minhasPostagens" role="tabpanel" aria-labelledby="nav-minhasPostagens-tab">
                <div class="card">
                    <div class="card text-center" *ngFor='let item of usuario.postagem | orderBy : key : reverse'>
                        <div class="card-body">
                            <h5 class="card-title m-0">titulo</h5>
                            <small class="text-muted"> Tema: descricao</small>
                            <p class="card-text mt-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Mollitia
                                fugiat aliquid libero laudantium atque voluptatem ipsa. Ex, quibusdam, distinctio unde
                                necessitatibus soluta asperiores eos iusto obcaecati repellat natus, ipsum esse.</p>
                            <p class="card-text"><small class="text-muted">24/10/2022 às 21:35</small></p>

                            <a class="text-info mr-3" href="">Editar</a>
                            <a class="text-danger" href="">Apagar</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="postagemTema" role="tabpanel" aria-labelledby="nav-postagemTema-tab">
                <div class="row d-flex justify-content-center mt-5 mb-5">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" id="titulo"
                                placeholder="Digite um tema para pesquisar">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title m-0">titulo</h5>
                            <small class="text-muted"> Tema: JavaScript</small>
                            <p class="card-text mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam
                                consequatur nobis earum officiis. Illo sapiente, voluptates quae modi facilis
                                distinctio, voluptatum repellat reiciendis a pariatur possimus adipisci. Unde, debitis
                                alias?</p>
                            <a href="">Link de alguma coisa</a>
                            <p class="card-text"><small class="text-muted">24/10/2022 às 21:35</small></p>
                            <p class="card-text"><small class="text-muted">by: Witer Mendonça</small></p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="postagemTipo" role="tabpanel" aria-labelledby="nav-postagemTipo-tab">
                <div class="row d-flex justify-content-center mt-5 mb-5">
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" id="titulo"
                                placeholder="Digite um tipo para pesquisar">
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title m-0">titulo</h5>
                            <small class="text-muted"> Tema: JavaScript</small>
                            <p class="card-text mt-3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam
                                consequatur nobis earum officiis. Illo sapiente, voluptates quae modi facilis
                                distinctio, voluptatum repellat reiciendis a pariatur possimus adipisci. Unde, debitis
                                alias?</p>
                            <a href="">Link de alguma coisa</a>
                            <p class="card-text"><small class="text-muted">24/10/2022 às 21:35</small></p>
                            <p class="card-text"><small class="text-muted">by: Witer Mendonça</small></p>
                        </div>
                    </div>
                </div>
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
                <div class="modal-body">
                    <div class="form-group">
                        <label for="titulo">Título</label>
                        <input [(ngModel)]='postagem.titulo' type="text" class="form-control" id="titulo"
                            placeholder="Digite o título">
                    </div>

                    <div class="form-group">
                        <label for="titulo">Link</label>
                        <input type="text" class="form-control" id="link"
                            placeholder="Digite o link">
                    </div>

                    <div class="form-group">
                        <label for="titulo">Tema</label>
                        <input type="text" class="form-control" id="tema"
                            placeholder="Digite o tema">
                    </div>

                    <div class="form-group">
                        <label for="texto">Texto</label>
                        <textarea [(ngModel)]='postagem.texto' class="form-control" name="texto" id="texto"
                            rows="3"></textarea>
                    </div>
                  
                    <div class="form-group">
                        <label for="texto">Escolha o tipo:</label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option>Vídeo</option>
                            <option>Curso on-line</option>
                            <option>Livro</option>
                            <option>Artigo</option>
                            <option>Site</option>
                        </select>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success" (click)='publicar()'
                        data-dismiss="modal">Publicar</button>
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