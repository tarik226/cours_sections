<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    session_start();
    include_once 'config.php';
    if (isset($_POST['title'])&&isset($_POST['description'])&&isset($_POST['level'])) {
        # code...
        // print_r($_SESSION);
        $id=$_SESSION['id'];
        $query = "UPDATE courses 
          SET title='" . $_POST['title'] . "', 
              description='" . $_POST['description'] . "', 
              level='" . $_POST['level'] . "' 
          WHERE id=" . (int)$id;


        $result=$conn->query($query);
        // var_dump($result);
        if ($result) {
            # code...
            echo 'modification reussie';
        }else{
            echo 'error'.$conn->error;
        }
    }
    ?>
</body>
</html>