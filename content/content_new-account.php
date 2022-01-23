<?php

function generateForm_newaccount($default) {

    echo <<<END_FORM
    <div class="col-md-4 offset-md-4 container-fluid" id="new-acc-main">
        <h4 style="text-align:center">Créez un compte kI</h4>
        <br>
        <form method="post" action="index.php?page=new-account">
            <input type = "text" name = "username" placeholder="Nom d'utilisateur" value="$default"/> <br>
            <input type = "password" name = "password" id = "password" placeholder="Mot de passe"/> <br>
            <input type = "password" name = "checkPassword" id = "checkPassword" placeholder="Confirmer le mot de passe"/> <br> <br>
            <input type = "submit" id = "creercompte" value = "Créer un compte" disabled = "true"/>
        </form>
        <p id = "messagePassw"></p>
    </div>
    <script>
        
    </script>
END_FORM;
}
