<?php
//déclarer les variables d'affichage
$message ='';



//création de ma fonction de nettoyage des données
function nettoyage($data){
    return htmlentities(strip_tags(stripslashes(trim($data))));
}

//vérifier que le formulaire est submut
if(isset($_POST["submit"])){

    //vérifier que les données ne sont pas vides avec isset() et empty()

    if (
        isset($_POST["user_mail"]) && !empty($_POST["user_mail"]) && 
        isset($_POST["user_newname"]) && !empty($_POST["user_newname"]) && 
        isset($_POST["user_newmdp"]) && !empty($_POST["user_newmdp"])
    ) {
        // deuxième étape de sécurité : vérifier le format des données

        //on va vérifier que l'email a bien un format d'email et que l'âge est bien un entier

        // filte_var(): permet grâce à un ensemble de filtres de s'assurer du format de nos données

        if(filter_var($_POST["user_mail"], FILTER_VALIDATE_EMAIL)) {



                //3ème étape de sécurité : nettoyer les données --> on veut enlever tout code malveillant

                //htmlentities(): transforme les balises HTML en texte

                // strip_tags() : supprime les balises HTML et PHP

                //trim() : supprime les espace en début et fin de chaîne de caractère

                //stripslashes() : supprime les antislash

                // on va pouvoir stocker nos variables nettoyées 
                $user_mail= nettoyage($_POST["user_mail"]);
                $user_newname= nettoyage($_POST["user_newname"]);
                $user_newmdp= nettoyage($_POST["user_newmdp"]);

                // étape bonus si inscription en BDD : chiffrer les données (hasher le mot de passe par exemple)

                $password = password_hash($password, PASSWORD_BCRYPT);

                // --> on peut enfin communiquer avec la BDD et lui envoyer des données propres

                //communiquer avec la BBD
                //étape 1 : instanciation de l'objet de connexion à la BDD
                //il faut précise plusieurs paramètres : host, dbname, nom d'utilisateur et mot de passe utilisateur
                $bdd = new PDO('mysql:host=localhost;dbname=users', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                
                //try... catch pour gérer des erreurs de communication avec la BDD
                try {
                    //étape 2 : la bonne méthode
                    //avec une requête SQL préparée
                    //étape 2.1 : méthode prepare()
                    $req = $bdd->prepare("INSERT INTO users (`user_mail`, `user_newname`, `user_newmdp`) VALUES (?, ?, ?)");
                    //étape 2.2 : compléter les ? avec un binding des paramètres
                    $req->bindParam(1, $user_mail, PDO::PARAM_STR);
                    $req->bindParam(2, $user_newname, PDO::PARAM_STR);
                    $req->bindParam(3, $user_newmdp, PDO::PARAM_STR);
                    //étape 2.3 : éxecuter la requête avec execute() :
                    $req->execute();
                    //étape bonus : si retour de la BDD : récupérer la réponse de la BDD
                    //ce sera un tableau contenant les enregistrements sous forme de tableau associatifs (ou d'objet)
                    //$data = $req->fetchAll();
                    //message de confirmation à l'utilisateur
                    $message = "L'enregistrement de $user_newname, dont l'email est : $user_mail, a été affecté avec succès.";
                }catch(EXCEPTION $error){
                    //en cas de pb, je récupère le message d'erreur et je l'affiche
                    $message = $error->getMessage();
                }

            }
        } else { // on gère une erreur de format de mail

            $message = "Votre mail n'est pas au bon format !";

        }

    } else { // on gère une erreur de données non remplie

        // on affiche un message d'erreur à l'utilisateur

        $message = "veuillez remplir les champs obligatoires !";
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name ="description" content ="Découvrez les meilleurs hébergements adaptés aux chiens : hôtels, campings, maisons d'hôte et gîtes. Partez partout avec votre chien en toute sérénité !"> 
    <link rel="stylesheet" href="style.css" >
    <script src="pageDeConnexion.js"></script>
    <title>Page de connexion</title>
</head>
<!--Header-->
<header>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
    <img class ="logo" src="logoc12.webp" alt ="logo Site" />
 
    <nav class="navbar">
        <ul class="menu">
            <li><a href="pageAccueil.html">Accueil</a></li>
            <li class="dropdown">
                <a href="#">Hébergements</a>
                <ul class="submenu">
                    <li><a href="#">Campings</a></li>
                    <li><a href="#">Hôtels</a></li>
                    <li><a href="#">Gîtes</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Transports</a>
                <ul class="submenu">
                    <li><a href="#">Avion</a></li>
                    <li><a href="#">Train</a></li>
                    <li><a href="#">Transports urbains</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#">Activitées</a>
                <ul class="submenu">
                    <li><a href="#">Restaurants</a></li>
                    <li><a href="#">Boutiques</a></li>
                    <li><a href="#">Lieux publics</a></li>
                </ul>
            </li>
            <li><a href="pageDeConnexion.html">Connexion / Inscription</a></li>
            <li><a href="pageDeContact.html">Contact</a></li>
        </ul>
    </nav>
</header>
<body>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&family=Patrick+Hand&display=swap" rel="stylesheet">
    <form method="POST" action="formulaire.php">
        <div class="formulaireContainer">
            <div class="FormulaireDeConnexion">
                <h1> Connexion au compte</h1>
                <input type="text" id="pseudo" maxlength="20" minlength="2" placeholder="Nom d'utilisateur"/>
                </br>
                <input type="text" id="mdp" maxlength="20" minlength="2" placeholder="Mot de Passe"/>
                <div id="check">
                    <input type="checkbox" name="remember" id="remember" checked >
                    <label for="remember" class="checkbox"> Se souvenir de moi </label>
                </div>
                <div id="connexion">
                    <input type="submit" value="Envoyer" id="send">
                </div>
                <p><a href="#">Mot de passe oublié ?</a></p>
            </div>
            <div class="dividerVertical">
            </div>
            <div class="FormulaireDInscription">
                <h1> Inscription</h1>
                <input type="text" id="mail" maxlength="20" minlength="2" placeholder="Adresse email"/>
                </br>
                <input type="text" id="newpseudo" maxlength="20" minlength="2" placeholder="Nom d'utilisateur"/>
                </br>
                <input type="text" id="newmdp" maxlength="20" minlength="2" placeholder="Mot de passe"/>
                </br>
                <input type="text" id="confmdp" maxlength="20" minlength="2" placeholder="Confirmation du mot de passe"/>
                <div id="inscrire">
                    <input type="submit" value="S'inscrire" id="submit">
                </div>
            </div>
        </div>
    </form>
</body>
<footer>
        <!--Footer-->
        <div class="footer">
            <p>Nom | mail@exemple.com | Téléphone | ©2024</p>
        </div>
</footer>
</html>

<!--faire des li avec des hoover pour le menu déroulant
essayer de laisser une marge entre le menu déroulant et la fin du header
faire une animation (hoover) pour les boutons "envoyer" et "s'inscrire"-->