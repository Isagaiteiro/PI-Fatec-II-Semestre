<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/contato.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>SWE-CONTATO</title>
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar  font-weight-bold not-decoration" href="home.php">Home</a>

            <a class="navbar-nav text-center ml-auto font-weight-bold not-decoration" href="sobre-nos.php">Sobre</a>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row d-flex justify-content-center align-items-center">

            <!--col Imagem Logo-->
            <div class="col-md-6 mb-5 mt-5 text-center">
                <h1 class="title">SWE</h1>
                <p>share way education</p>
              
            </div>

            <!--col Form-->
            <div class="col-md-6 mt-5 mb-5 lh-5">
                <div class="row d-flex justify-content-center align-items-center">
                    <div class="col-md-8">
                        <h1 class="text-center text-green-dark m-3">Contato</h1>
                        <form>
                            <div class="form-group">
                                <label for="nome">Nome:</label>
                                <input class="form-control" type="text" name="nome" id="nome" placeholder="Nome">
                            </div>

                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input class="form-control" name="email" id="email"
                                    placeholder="Digite seu E-mail" type="email" #alert>
                            </div>

                            <div class="form-group">
                                <label for="assunto">Assunto:</label>
                                <textarea class="form-control" name="assunto" id="assunto"
                                    placeholder="Digite sua mensagem" cols="30" rows="5"
                                    style="resize: none"></textarea>
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="button" class="btn btn-success btnHome">Enviar</button>
                            </div>
                        </form>
                    </div>
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
</body>

</html>