<!-- Connexion à la base de données -->

<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

include("../connexion_BDD.php");
$pdo=connexion_BDD();

if (!empty($_GET['id_reservation'])) {
    $idres = checkInput($_GET['id_reservation']);
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


<!-- Gestion id -->


<!-- Formulaire d'ajout d'une réservation -->


<form name="form1" method="post" action="edit.php">
<?php
if (isset($_GET['id'])){
    $idres = $_GET['id'];
 }
 ?>

<!-- DEBUT // Selection de la salle -->

    <h3><label for="listsalle">Selectionner une salle</label></h3>
        <select name="listsalle">
            <?php
            $reponse = $pdo->prepare("SELECT * FROM salle");
            $reponse->execute();
            while ($donnees = $reponse->fetch()) {

            echo "<option value=".$donnees['id_salle'].">".$donnees['libelle_salle']."</option>";

            }
            ?>     
            <?php
            if (isset($_POST['listsalle'])){
                echo $_POST['listsalle'];
            }
            
        ?> 
         <br>   
        </select>

<!-- FIN // Selection de la salle -->
        
        
<!-- DEBUT // Selection heure -->
        

        <h3><label for="listheure">Selectionner une heure</label></h3>
        <select name="listheure">
            <?php
            $reponse = $pdo->prepare("SELECT * FROM heure");
            $reponse->execute();
            while ($donnees = $reponse->fetch()) {

            echo "<option value=".$donnees['id_heure'].">".$donnees['libelle_heure']."</option>";

            }
            ?>     
            <?php
            if (isset($_POST['listheure'])){
                echo $_POST['listheure'];
            }
            
        ?> 
         <br>   
        </select>


<!-- FIN // Selection heure -->

<!-- DEBUT // Selection Date -->


        <h3><label for="listdate">Selectionner une date</label></h3>
        <input type="date" name="dateres">

<!-- FIN // Selection Date -->


<!-- Validation du formulaire -->
    <p><input type="hidden" value=" <?php echo $idres?>" name="test"></p>
    <p><input name = "submit" type="submit" value="OK"></p>


    </form>

<!-- Fin du formulaire -->
    
    <button><a href="../index.php">Retour à  l'accueil</a></button>



<?php
    if(isset($_POST['submit']))
    {
        $idres = $_POST['test'];
        $listsalle = $_POST['listsalle'];
        $listheure = $_POST['listheure'];
        $listdate = $_POST['dateres'];


        $stmt = $pdo->prepare("UPDATE reservation SET id_Salle='$listsalle', id_Heure='$listheure', DateReservation='$listdate' WHERE reservation.id_reservation='$idres'");
        $stmt ->execute();
?>

        <script type="text/javascript">
        alert("Réservation modifiée avec succés");
        window.location.href = "../index.php";
        </script>
        <?php
    }


?>

</body>
</html>





