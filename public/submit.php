<?php
// Connexion à la DB
$host = "localhost";
$db = "contact";
$user = "root";    // à adapter selon ton serveur
$pass = "";        // idem

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

// Sauvegarder dans la DB
$stmt = $conn->prepare("INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $name, $email, $subject, $message);
$stmt->execute();
$stmt->close();
$conn->close();

// Envoyer un email
$to = "liorangezgeg@gmail.com"; // ton adresse
$body = "Nom: $name\nEmail: $email\nSujet: $subject\nMessage: $message";
$headers = "From: no-reply@ONTech-cloud.com";

mail($to, "Nouveau message formulaire", $body, $headers);

// Redirection après envoi
header("Location: merci.html");
exit();
?>
