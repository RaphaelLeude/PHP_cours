<?php
// 1. Lire le fichier
$jsonString = file_get_contents('pokemon.json');

// 2. Décoder (true pour obtenir un tableau, false pour un objet)
$data = json_decode($jsonString, false);

// Vérifier les erreurs éventuelles
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Erreur JSON : ' . json_last_error_msg());
}


// 3. Accéder aux données (exemple avec tableau)
// echo $data['cle']['sous_cle'];

// Ou avec objet :
// $obj = json_decode($jsonString);
// echo $obj->cle->sous_cle;

// echo '<pre>';
// echo var_dump($data);

foreach ($data as $pokemon) {
    // echo $pokemon["name"]['fr'];
    echo $pokemon->name->fr;
    echo '<br/>';
}
// echo '</pre>';
