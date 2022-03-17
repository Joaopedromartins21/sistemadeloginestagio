<?php

include("conexao.php");

if(isset($_POST[ok])){
    
    $email = mysqli->escape_string($_POST['email']);

    if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        $erro[] ="E-mail invalido";
    }

    $sql_code = "SELECT senha, codigo FROM usuario WHERE email";
    $sql_query =$mysqli->query($sql_code) or die ($mysqli->error);
    $dado = $sql_query->fetch_assoc();
    $total = $sql_query->num_rows;

    if($total ==0)
        $erro[] = "o email informado nao existe no banco de dados";

        if(count($erro) == 0 && $total>0){
            $novasenha = substr(md5(time(), 0, 6));
            $nscriptografada = md5(md5($novasenha));
        

            if(mail($email, "Sua senha","Sua nova senha:".$novasenha)){

    $sql_code = "UPDATE usuario SET senha = 'nscriptografada' WHERE email = '$email'";
    $sql_query = $mysqli->query($sql_code) or die($mysqli->error);

    }
        }

}


?>

<?php if(count($erro)> 0)
        foreach($erro as $msg){
            echo "<p>$msg</p>";
        }

?>
<body>
    <section class="hero is-success is-fullheight">
        <div class="hero-body">
            <div class="container has-text-centered">
                <div class="column is-4 is-offset-4">
                    <h3 class="title has-text-grey">Informe o seu email</h3>
                    
                    <div class="box">
                        <form id="login"method="POST">
                            <input class="input is-large" type="text" placeholder="email">
                            </div>
                            <button type="submit" class="button is-block is-link is-large is-fullwidth">Enviar</button>
                        </form>
                  
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
