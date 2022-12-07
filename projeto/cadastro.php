<?php 
    if($_SERVER["REQUEST_METHOD"] == "POST"){ 
        if(isset($_POST['nome']) && $_POST['nome'] != "" 
            && isset($_POST['email']) && $_POST['email'] != ""
            && isset($_POST['senha']) && $_POST['senha'] != ""
            && isset($_POST['confirmSenha']) && $_POST['confirmSenha'] != ""){
            if($_POST['senha'] == $_POST['confirmSenha']){
                require_once('entidade/Usuario.php');

                $usuario = new Usuario();
                $usuario->nome = $_POST['nome'];
                $usuario->email = $_POST['email'];
                $usuario->foto = $_POST['foto'];
                $usuario->senha = $_POST['senha'];
                if($usuario->Cadastrar()){
                    header("location: home.php");
                } else{
                    echo '<div class="alert alert-danger fixed-top alert-dismissible fade show" role="alert">
                            Erro: falha de conxão com banco de dados
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                          </div>';
                }
               
            } else {
                echo '<div class="alert alert-danger fixed-top alert-dismissible fade show" role="alert">
                        Erro: senhas não são iguais!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                      </div>';
            }
        } else{
            echo '<div class="alert alert-danger fixed-top alert-dismissible fade show" role="alert">
                    Erro: campos vazios ou em branco, preencha todos os campos.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
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

    <title>SWE-CADASTRO</title>
</head>

<body>

    <div class="container-fluid">

        <div class="row d-flex align-items-center min-height">
            <img class="col-md-6" src="./image/cadastro.png" alt="">
            <div class="col-md-6 mt-5 mb-5">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-10">
                        <h1 class="text-center">SWE</h1>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input class="form-control" type="text" name="nome" id="nome" placeholder="Seu nome" required>
                            </div>

                            <div class="form-group">
                                <label for="usuario">Email</label>
                                <input class="form-control" type="email" name="email" id="email" placeholder="Seu email" required>
                            </div>

                            <div class="form-group">
                                <label for="foto">Link da Foto</label>
                                <input class="form-control" type="text" name="foto" id="foto"
                                    placeholder="Link da sua foto">
                            </div>

                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input class="form-control" type="password" name="senha" id="senha" placeholder="Sua senha" required>
                            </div>

                            <div class="form-group">
                                <label for="confirmSenha">Confirmar Senha</label>
                                <input class="form-control" type="password" name="confirmSenha" id="confirmSenha"
                                    placeholder="Confirme sua senha" required>
                            </div>
                        
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-danger mr-4"><a href="home.php" class="text-white text-decoration-none">Cancelar</a></button>
                                <button type="submit" class="btn btn-success">Cadastrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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