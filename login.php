<?php
session_start();
include 'connexion.php';
$title = "Connexion";
include 'header.php';

$message = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mdp = mysqli_real_escape_string($conn, $_POST['mdp']);

    $sql = "SELECT * FROM membre WHERE email = '$email' AND mdp = '$mdp'";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) == 1) {
        $membre = mysqli_fetch_assoc($res);
        $_SESSION['id_membre'] = $membre['id_membre'];
        $_SESSION['nom'] = $membre['nom'];
        header("Location: liste_objets.php");
        exit;
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>

<div class="card p-4 shadow-sm">
    <h2>Connexion</h2>
    <p class="text-danger"><?= $message ?></p>

    <form method="POST">
        <input class="form-control" type="email" name="email" placeholder="Email" required>
        <input class="form-control" type="password" name="mdp" placeholder="Mot de passe" required>
        <button class="btn btn-primary mt-2" type="submit" name="login">Se connecter</button>
    </form>
</div>

<?php include 'footer.php'; ?>