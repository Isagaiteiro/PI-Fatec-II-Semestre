<?php
    require_once('entidade/Usuario.php');

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usuario = new Usuario();
        $result = $usuario->getUsuario($_POST['email']); 
        $row = $result->fetch_assoc();
        if(isset($row['email']) && isset($row['senha'])){             
            if($_POST['senha'] == $row['senha']){ 
                session_start(); 
                $_SESSION['loggedin'] = TRUE; 
                $_SESSION["usuario"] = $row["nome"];
                $_SESSION["email"] = $row["email"];  
                header("location: inicio.php"); 
            } else {
                $_SESSION['loggedin'] = FALSE; 
            }
        } else{
            echo '<div class="alert alert-danger fixed-top alert-dismissible fade show" role="alert">
                    Usuário ou senha inválida.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                  </div>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/home.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <title>SWE</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row d-flex align-items-center min-height">
            <div class="col-md-6">

                <div class="row d-flex justify-content-center">
                    <div class="col-md-6">

                        <h1 class="text-center mb-3 mt-5 title">SWE</h1>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group" >
                                <label for="usuario">Email</label>
                                <input class="form-control" type="text" name="email" id="email"
                                    placeholder="Seu email">
                            </div>

                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input class="form-control" type="password" name="senha" id="senha" placeholder="Sua senha">
                            </div>

                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">Entrar</button>
                            </div>
                        </form>

                        <hr class="mt-5 mb-5">

                        <p class="text-center">
                            <!-- para rota interna '/cadastrar' -->
                            Não tem uma conta? <a href="cadastro.php">Cadastre-se</a>
                        </p>
                        <p class="text-center">
                            <!-- para rota interna '/sobre-nos' -->
                            <a href="sobre-nos.html">Sobre Nós</a>
                        </p>
                        <p class="text-center">
                            <!-- para rota interna '/sobre-nos' -->
                            <a href="contato.html">Contato</a>
                        </p>
                    </div>
                </div>

            </div>
            <img class="col-md-6" src="image/educacao.png" alt="">
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
</body>

</html>