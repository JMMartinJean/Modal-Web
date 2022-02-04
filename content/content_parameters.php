<?php

function display_parameters() {
    echo '<div class="container-fluid">
        <h1>Paramètres du compte</h1>
        
        <p><br><br></p>
        <h4>Modifier le nom d\'utilisateur</h4>
        <form>
            <input id="username" type= "text" value="' . ($_SESSION['username']) . '">  '. // Inutile d'utiliser htmlspecialchars dans un input + username est 100% alphanumérique
            '<button id="change_username">Changer</button>
            <div id="alert_username"></div>
        </form>
        <br><br>
        
        <h4>Modifier le mot de passe</h4>
        <form>
            <input id="currpassword" type="password" placeholder="Mot de passe actuel"> <br>
            <input id="new-password" type="password" placeholder="Nouveau mot de passe"><br>
            <input id="new-password-confirm" type="password" placeholder="Répéter le mot de passe"><br>
            <button id="change_password">Changer</button>
            <div id="alert_password"></div>
        </form>
        <br><br>
        
        <h4>Supprimer le compte</h4>
        <p>Si, après avoir longuement pesé le pour et le contre, j\'estime que je ne veux plus rien faire avec le kI, <a id="supprime" href="#">je clique ici</a> et je pars sans me retourner.
        Attention, vous ne pourrez plus lire d\'article si vous supprimez votre compte. Cela supprimera également toutes vos contributions sur le kI (articles et commentaires).
        Vos likes seront toutefois conservés, de manière totalement anonyme.</p>
        <p>Vous pouvez aussi <a href="https://www.commentcamarche.net/s/d%C3%A9missionner%20de%20l\'ecole%20polytechnique" target="_blank"> démissionner de l\'X</a>, ça va plus vite.</p>
        </div>';
}