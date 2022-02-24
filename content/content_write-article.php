<?php

function generateForm_writearticle($def_titre, $def_contenu, $target) {
    echo '<div class="container-fluid">
    <form method="post" action="index.php?page=' . $target . '" enctype="multipart/form-data">
        <textarea name="titre" placeholder="Titre de votre article" style="width:50%; resize:horizontal">' . $def_titre . '</textarea>
        <br> <br>
        <label>Choisissez une image pour illustrer votre article:</label><br>
        <input type="file" name="img"/>
        <br> <br>
        <textarea name="contenu" id = "contenu" style="width:90%; height:800px" placeholder="Ecrivez votre article ici...">' . $def_contenu . '</textarea>
        <br>
        <input type="submit" value="Soumettre cet article">
    </form></div>';
}
