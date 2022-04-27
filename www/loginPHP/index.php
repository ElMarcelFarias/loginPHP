<?php
    require_once './classes/usuarios.php';
    $u = new Usuario;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Marcel Leite de Farias">
    <link rel="stylesheet" href="style.css">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/jquery.mask.min.js"></script>
    <title>Login</title>
</head>
<body>
    <section>
        <div class="container">
            <div class="user signinBx">
                <div class="imgBx"><img src="images/img1.jpg"></div>
                <div class="formBx">
                    <form method="POST">
                        <h1>LOGIN</h1>
                        <input type="email" name="email" placeholder="Email do Usuário">
                        <input type="password" name="senha" placeholder="Senha">
                        <input type="submit" value="ACESSAR">
                        <p class="signup">dont' have an account? <a onclick="toggleForm();">Sign up.</a></p>
                        <p class="signinDev">Desenvolvido por - <a href="https://www.linkedin.com/in/marcel-leite-de-farias-38b62b220/">Marcel Leite de Farias</a></p>
                    </form>
                </div>
            </div>
            <?php
            if(isset($_POST['email']))
            {
                $email = addslashes($_POST['email']);
                $senha = addslashes($_POST['senha']);
        
                //verificar se esta vazio
                if(!empty($email) && !empty($senha))
                {
                    $u->conectar("projeto_login", "localhost", "root", "");
                    if($u->msgErro == "")
                    {
                        if($u->logar($email, $senha))
                        {
                            header("location: AreaPrivada.php");
                        }
                        else
                        {
                            ?>    
                            <div class="user signinBx">
                                <div class="imgBx"><img src="images/img1.jpg"></div>
                                <div class="formBx">
                                    <form method="POST">
                                        <h1>Login</h1>
                                        <input type="email" name="email" placeholder="Email do Usuário">
                                        <input type="password" name="senha" placeholder="Senha">
                                        <input type="submit" value="ACESSAR">
                                        <p class="signup">dont' have an account? <a onclick="toggleForm();">Sign up.</a></p>
                                        <div class="msg-erroLogin">
                                            Email e/ou senha estão incorretos!
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <div class="msg-erro">
                            <?php echo "Erro: ".$u->msgErro;?>
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="user signinBx">
                        <div class="imgBx"><img src="images/img1.jpg"></div>
                        <div class="formBx">
                            <form method="POST">
                                <h1>Login</h1>
                                <input type="email" name="email" placeholder="Email do Usuário">
                                <input type="password" name="senha" placeholder="Senha">
                                <input type="submit" value="ACESSAR">
                                <p class="signup">dont' have an account? <a onclick="toggleForm();">Sign up.</a></p>
                                <div class="msg-erroLogin">
                                    Preencha todos os campos!
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        
            <!--CADASTRAR-->
            <div class="user signupBx">
                <div class="formBx">
                    <form method="POST">
                        <h1>Cadastrar</h1>
                        <input type="text" name="nome" placeholder="Nome Completo" maxlength="30">
                        <input type="text" name="telefone" placeholder="Telefone" id="celular" maxlength="11">
                        <input type="email" name="email" placeholder="Email do Usuário" maxlength="70">
                        <input type="password" name="senha" placeholder="Senha" maxlength="15">
                        <input type="password" name="confSenha" placeholder="Confirmar Senha" maxlength="15">
                        <input type="submit" value="Cadastrar" name="cadastrar">                      
                        <p class="signup">Already have an account? <a onclick="toggleForm();">Sign in.</a></p>
                    </form>
                </div>
                <div class="imgBx"><img src="images/img2.jpg"></div>
                <?php
                    if(isset($_POST['nome']))
                    {
                        $nome = addslashes($_POST['nome']);
                        $telefone = addslashes($_POST['telefone']);
                        $email = addslashes($_POST['email']);
                        $senha = addslashes($_POST['senha']);
                        $confirmarSenha = addslashes($_POST['confSenha']);
                        //verificar se está vazio ou não
                        if(!empty($nome) && !empty($telefone) &&!empty($email) && !empty($senha) && !empty($confirmarSenha))
                        {
                            $u->conectar("projeto_login", "localhost", "root", "");
                            if($u->msgErro == "")
                            {
                                if($senha == $confirmarSenha)
                                {
                                    if($u->cadastrar($nome, $telefone, $email, $senha))
                                    {
                                        ?>
                                        <div id="msg-sucesso">
                                            Cadastrado com sucesso!
                                        </div>
                                        <?php
                                    }
                                        if(isset($_POST['cadastrar']))
                                        {
                                            header("location: index.php");
                                        }  
                                }
                            }
                        }         
                    }
                ?>
            </div>
        </div>
    </section>
    <script>
        function toggleForm() {
            section = document.querySelector('section');
            container = document.querySelector('.container');
            container.classList.toggle('active');
            section.classList.toggle('active');

            $(document).ready(function(){
                $("#").mask("");
            })

            $("#celular").mask("(00) 00000-0000");
        }
        
        
    </script>

</body>
</html>