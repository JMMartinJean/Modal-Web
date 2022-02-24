<?php

function getExtension($name) {
    $tmp = explode('.', $name);
    return end($tmp);
}

function checkImage($tmp_name, $name) {
    $taille_maxi = 100000;
    $taille = filesize($tmp_name);
    list($widthOrig, $heightOrig) = getimagesize($tmp_name);
    if (!in_array(getExtension($name), array('jpg', 'png', 'jpeg'))) {
        addAlert('Les types de fichier autorisés sont .png, .jpg, .jpeg', 'error');
        return false;
    }
    if ($taille>$taille_maxi) {
        addAlert('Le fichier doit faire moins de 100Ko', 'error');
        return false;
    }
    if (300 > $widthOrig || 350 < $widthOrig || 200 > $heightOrig || 250 < $heightOrig) {
        addAlert('La forme de l\'image n\'est pas adaptée. <br> La largeur doit être 325&plusmn;25 et la hauteur 225&plusmn;25, ', 'error');
        return false;
    }
    return true;
}
function resize($file, $chemin) {    
    list($widthOrig, $heightOrig) = getimagesize($file['tmp_name']);
    $newHeight = 236;
    $newWidth = 315;
    $tmpPhotoResized = imagecreatetruecolor($newWidth, $newHeight);
    //imagecreatetruecolor($newWidth, $newHeight)
    //$tmpPhotoResized = imagecreatetruecolor($newWidth, $newHeight);
    if (getExtension($file['name']) === 'png') {
        $image = imagecreatefrompng($file['tmp_name']);
    } else {
        $image = imagecreatefromjpeg($file['tmp_name']);
    }
    imagecopyresampled($tmpPhotoResized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $widthOrig, $heightOrig);

    // $photoLD est le chemin vers votre nouvelle photo LD

    imagejpeg($tmpPhotoResized, $chemin, 100);

}
