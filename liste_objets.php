<?php
session_start();
include 'connexion.php';
$title = "Liste des Objets";
include 'header.php';

if (!isset($_SESSION['id_membre'])) {
    header("Location: login.php");
    exit;
}


$filtre_categorie = isset($_GET['categorie']) ? (int) $_GET['categorie'] : 0;


$cat_res = mysqli_query($conn, "SELECT * FROM categorie_objet");

$sql = "SELECT o.*, c.nom_categorie, m.nom AS proprio
        FROM objet o
        JOIN categorie_objet c ON o.id_categorie = c.id_categorie
        JOIN membre m ON o.id_membre = m.id_membre";

if ($filtre_categorie > 0) {
    $sql .= " WHERE o.id_categorie = $filtre_categorie";
}

$res = mysqli_query($conn, $sql);
?>

<h2> Liste des objets</h2>

<form method="GET" class="mb-4">
    <label for="categorie">Filtrer par categorie :</label>
    <select name="categorie" id="categorie" class="form-select w-auto d-inline-block">
        <option value="0">Toutes les categories</option>
        <?php while ($cat = mysqli_fetch_assoc($cat_res)) : ?>
            <option value="<?= $cat['id_categorie'] ?>" <?= ($filtre_categorie == $cat['id_categorie']) ? 'selected' : '' ?>>
                <?= htmlspecialchars($cat['nom_categorie']) ?>
            </option>
        <?php endwhile; ?>
    </select>
    <button type="submit" class="btn btn-primary">Filtrer</button>
</form>


<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Propriétaire</th>
            <th>Statut</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($o = mysqli_fetch_assoc($res)) : ?>
            <?php
            $id = $o['id_objet'];
            $img_req = mysqli_query($conn, "SELECT nom_image FROM images_objet WHERE id_objet = $id LIMIT 1");
            $img = mysqli_fetch_assoc($img_req);
            $image_path = "uploads/" . $img['nom_image'];

            $emprunt_req = mysqli_query($conn, "SELECT date_retour FROM emprunt WHERE id_objet = $id ORDER BY date_emprunt DESC LIMIT 1");
            $emprunt = mysqli_fetch_assoc($emprunt_req);
            $statut = $emprunt && strtotime($emprunt['date_retour']) >= time()
                ? "Emprunté (retour le " . $emprunt['date_retour'] . ")"
                : "Disponible";
            ?>
            <tr>
                <td><img src="<?= $image_path ?>" width="100" class="img-thumbnail"></td>
                <td><?= htmlspecialchars($o['nom_objet']) ?></td>
                <td><?= htmlspecialchars($o['nom_categorie']) ?></td>
                <td><?= htmlspecialchars($o['proprio']) ?></td>
                <td><?= $statut ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>