<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("../connexion_BDD.php");
$pdo=connexion_BDD();

if (!empty($_GET['id'])) {
    $idres = $_GET['id'];
}

$id = $_SESSION['id_user'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>Gestion du planning</title>
</head>



<body>
<form name="form1" method="post" action="delete.php"> 
    <h1>Êtes-vous sur de vouloir supprimer cette réservation ?</h1>
    <p><input type="hidden" value="<?php echo $idres?>" name="test"></p>
    <p><input name = "submit" type="submit" value="OUI"></p>


    <button><a href="../index.php">Retour à  l'accueil</a></button>
</body>






<?php
if(isset($_POST['submit']))
{
    $idres = $_POST['test'];
    $stmt = $pdo->prepare("DELETE FROM reservation WHERE reservation.id_reservation='$idres'");
    $stmt ->execute();

?>

<script type="text/javascript">
alert("Réservation supprimée avec succés");
window.location.href = "../index.php";
</script>

<?php
}
?>





