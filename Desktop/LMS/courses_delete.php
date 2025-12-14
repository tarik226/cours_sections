<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    // appel du fichier qui etablit la connexion
    include_once 'courses_list.php';
    // verification d existance d id
    if (isset($_POST['course_id'])) {
        # code...
        // casting to int
        $id=(int)$_POST['course_id'];
        $query="delete from courses where id=$id";
        // executiondu requete
        $result=$conn->query($query);
        // verification du suppression
        if ($conn->affected_rows>0) {
            # code...
            echo 'suppression reussie';
                include_once 'courses_list.php';
            // appel au fichier d affichage
        }else{
             echo "Erreur : " . $conn->error;
        }
    }

    ?>
</body>
</html>