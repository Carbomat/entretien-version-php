<!DOCTYPE html>
<html>
<head>
    <title>TEST01</title>
    <link rel="stylesheet" href="css/default.css">
</head>
<body>
    <?php include('menu.html'); ?>
    <p>
        L'application suivante affiche un jeu de donnée dans une page HTML. Ce jeu de donnée est récupéré par le biais d'une API. Le jeu de donnée est stocké dans un fichier au format CSV. <br>
        Dans cette mis en situation, vous devez modifier l'application pour répondre aux demandes métiers ci-dessous.
    </p>
    <ul>
        <li>1 - Ajouter un lien cliquable permettant de rafraichir les données du tableau #nombreRaccordableByCodePostal</li>
        <li>2 - Ajouter un champ de recherche permettant de rechercher des lignes par code postal. La recherche se fera en ajax.</li>
        <li>3 - Ajouter un champ de recherche par code insee. La recherche par code insee devra faire en sorte de sommer le nombre de raccordable des différentes villes faisant partie de la commune. La recherche se fera en ajax.<ul>
            <li>
                Le code insee représente un code <b>unique</b> associé à une commune. Le code postal est lui aussi unique mais ne représente pas forcément une commune (ex: Le code postal de la plaine des cafres est 97418 alors que son code insee est 97422, qui correspond à la commune du Tampon).
        Pour obtenir les associations code insee <=> code postal vous devez utiliser le webservice suivant : <a href="https://datanova.laposte.fr/api/records/1.0/search//?dataset=laposte_hexasmal&q=974&rows=1000" target="_blank">https://datanova.laposte.fr/api/records/1.0/search//?dataset=laposte_hexasmal&q=974&rows=1000</a>
            </li>
        </ul></li>
        <li>4 - Ajouter un framework CSS pour améliorer l'aspect général de la page.</li>
        <li>5 - Proposer une autre amélioration qui vous semble pertinente.</li>
    </ul>
<hr>
    <p>
        Votre réalisation devra être transférée dans un patch git que vous nous transmettrez par e-mail. Le patch contiendra l'ensemble des commits que vous avez réalisé depuis origin/master. Le nom du fichier de patch devra respecter le format suivant : 
        <br><ul><li><i>nom_prenom_YYYYMMDD</i>.patch</li></ul>
        Une façon simple de générer un tel patch est d'executer la commande suivante depuis votre branche de travail : 
            <br><ul>
                <li>Sur un environnement linux : git format-patch origin/master --stdout &gt; <i>nom_prenom_YYYYMMDD</i>.patch</li>
            </ul>
    </p>
</body>
</html>