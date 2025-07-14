<?php
session_start();
include 'connexion.php';
$title = "Inscription";
include 'header.php';

$message = "";

if (isset($_POST['inscription'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mdp = mysqli_real_escape_string($conn, $_POST['mdp']);
    $ville = mysqli_real_escape_string($conn, $_POST['ville']);
    $genre = $_POST['genre'];
    $date_naissance = $_POST['date_naissance'];
    $image_profil = $_FILES['image_profil']['name'];

    $upload_path = "uploads/" . basename($image_profil);
    move_uploaded_file($_FILES['image_profil']['tmp_name'], $upload_path);

    $sql = "INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp, image_profil)
            VALUES ('$nom', '$date_naissance', '$genre', '$email', '$ville', '$mdp', '$image_profil')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Inscription réussie. Connectez-vous.";
        header("Location: login.php");
        exit;
    } else {
        $message = "Erreur : " . mysqli_error($conn);
    }
}
?>

<div class="card p-4 shadow-sm">
    <h2>Inscription</h2>
    <p class="text-danger"><?= $message ?></p>

    <form method="POST" enctype="multipart/form-data">
        <input class="form-control" type="text" name="nom" placeholder="Nom" required>
        <input class="form-control" type="date" name="date_naissance" required>
        <select class="form-control" name="genre" required>
            <option value="">Genre</option>
            <option value="F">F</option>
            <option value="M">M</option>
        </select>
        <input class="form-control" type="email" name="email" placeholder="Email" required>
        <input class="form-control" type="text" name="ville" placeholder="Ville" required>
        <input class="form-control" type="password" name="mdp" placeholder="Mot de passe" required>
        <input class="form-control" type="file" name="image_profil" required>
        <button class="btn btn-success mt-2" type="submit" name="inscription">S'inscrire</button>
    </form>
</div>

<?php include 'footer.php'; ?>