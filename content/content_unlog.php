<?php

function generateForm_login($default) {
    echo <<<FIN_FORM
    <div class="container-fluid">
        <div class="col-md-4 offset-md-4" id="login-main">
            <h4 style="text-align:center">Connectez-vous à <br> votre compte personnel</h4>
            <br>
            <form method="post" action="index.php?page=login">
                <input type = "text" name = "username" id = "username" placeholder="Nom d'utilisateur" value='$default' /> <br>
                <input type = "password" name = "password" id = "mdp" placeholder="Mot de passe"/> <br> <br>
                <input type = "submit" value = "Se connecter"/>
            </form>
            <br>
        </div>
        <div class="col-md-12" style="text-align:center">
            <a style="text-align:center" href="index.php?page=new-account">Toujours pas de compte ?</a>
        </div>
    </div>
    FIN_FORM;
}
