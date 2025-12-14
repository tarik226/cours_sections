<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include_once 'courses_list.php';
    // si les champs existent ...
    if (isset($_POST['title'])&&isset($_POST['description'])&&isset($_POST['level'])) {
        # code...
        // tester le regex de titre (seulement des lettres) ,description (lettres et espaces) et level pour avoir une des trois valeur
        if (preg_match('/[a-zA-Z]+/',$_POST['title'])&&preg_match('/[a-zA-Z]+\s?/',$_POST['description'])&&preg_match('/(debutant|intermédiaire|avance)/i',$_POST['level'])) {
            # code...
            // recuperation des valeurs du champs
            $title=$_POST['title'];
            $description=$_POST['description'];
            $level=$_POST['level'];
$query = "INSERT INTO courses (title, description, level) 
          VALUES ('$title', '$description', '$level')";
          // ajout du course et affichage de message de reussite ou echec
                      $result=$conn->query($query);
            // $result->fetch_assoc();
            if ($result === TRUE) {
    echo "Insertion réussie.";
} else {
    echo "Erreur : " . $conn->error;
        }
    }}
    ?>
</body>
</html>