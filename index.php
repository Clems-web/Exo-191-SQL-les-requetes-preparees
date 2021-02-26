<?php

/**
 * Reprenez le code de l'exercice précédent et transformez vos requêtes pour utiliser les requêtes préparées
 * la méthode de bind du paramètre et du choix du marqueur de données est à votre convenance.
 */

function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = addslashes($data);
    return $data;
}

try {
$server = "localhost";
$db = "table_test_php";
$user = "root";
$password = "";

$pdo = new PDO("mysql:host=$server;dbname=$db", $user, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$nom = "Waterstar";
$prenom = "Patrick";
$email = "Pat@gnegne.com";
$password = "azerty";
$adresse = "13 Rue du gros caillou Bikini Bottom";
$code_postal = 59874;
$pays = "France";
$date_join = "26/02/21";

sanitize($nom);
sanitize($prenom);
sanitize($email);
sanitize($password);
sanitize($adresse);
sanitize($code_postal);
sanitize($pays);
sanitize($date_join);


$stm = $pdo->prepare("
    INSERT INTO table_test_php.utilisateur(nom, prenom, email, password, adresse, code_postal, pays, date_join)
    VALUES (:nom, :prenom, :email, :password, :adresse, :code_postal, :pays, :date_join);   
");

$stm->bindParam(':nom', $nom);
    $stm->bindParam(':prenom', $prenom);
    $stm->bindParam(':email', $email);
    $stm->bindParam(':password', $password);
    $stm->bindParam(':adresse', $adresse);
    $stm->bindParam(':code_postal', $code_postal);
    $stm->bindParam(':pays', $pays);
    $stm->bindParam(':date_join', $date_join);

    $stm->execute();



    echo "utilisateur ajouté";
}
catch (PDOException $exception) {
    echo $exception->getMessage();
}