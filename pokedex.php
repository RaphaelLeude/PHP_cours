<?php
// 1. Lire le fichier
$jsonString = file_get_contents('pokemon.json');

// 2. Décoder (true pour obtenir un tableau, false pour un objet)
$data = json_decode($jsonString, false);

// Vérifier les erreurs éventuelles
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Erreur JSON : ' . json_last_error_msg());
}
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pokedex</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap');

        body {
            font-family: "Lato", sans-serif;
        }

        img {
            display: block;
            width: 100%;
            aspect-ratio: 1/1;
            object-fit: cover;
        }

        #container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin: 5%;
            margin-top: 50px;
        }

        .pokemon {
            display: flex;
            flex-direction: column;
            border-radius: 10px;
            background-color: rgba(198 198 198);
            border: 5px solid rgb(0 0 0);
            transition: all 300ms ease 100ms;
        }

        .pokemon:hover {
            transform: scale(1.05);
            background-color: rgb(255, 255, 255);
        }

        .txt {
            position: relative;
            flex-grow: 1;
            border-radius: 0 0 5px 5px;
            background-color: rgba(255, 255, 255, 0.61);
        }

        h1 {
            text-align: center;
        }

        ul {
            list-style: none;
            padding-left: 10px;
        }

        .type {
            position: absolute;
            top: 0;
            left: 10px;
            transform: translateY(-50%);
            display: flex;
            gap: 5px;
        }

        .type p {
            margin: 0;
            padding: 2px 10px;
            border-radius: 10px;
            background-color: black;
            color: white;
        }
    </style>
</head>

<body>
    <div id="container">
        <?php foreach ($data as $pokemon) { ?>
            <?php
            // MissingNo. n'a pas de types ni de stats, on le saute
            if ($pokemon->stats == null) {
                continue;
            }
            ?>
            <div class="pokemon">
                <div class="img">
                    <img src="<?php echo $pokemon->sprites->regular; ?>" alt="image de <?php echo $pokemon->name->fr; ?>" loading="lazy" />
                </div>
                <div class="txt">
                    <div class="type">
                        <?php foreach ($pokemon->types as $type) { ?>
                            <p><?php echo $type->name; ?></p>
                        <?php } ?>
                    </div>
                    <h1><?php echo $pokemon->name->fr; ?></h1>
                    <ul>
                        <li>Points de vie : <?php echo $pokemon->stats->hp; ?></li>
                        <li>Attaque : <?php echo $pokemon->stats->atk; ?></li>
                        <li>Défense : <?php echo $pokemon->stats->def; ?></li>
                        <li>Attaque spécial : <?php echo $pokemon->stats->spe_atk; ?></li>
                        <li>Vitesse : <?php echo $pokemon->stats->vit; ?></li>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </div>
</body>

</html>
