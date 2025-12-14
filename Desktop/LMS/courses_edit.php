<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<style>

     .container {
        width: 500px;
        margin: auto;
        background: #ddd;
        padding: 30px;
        border-radius: 10px;
    }
    input, textarea, select, button#ert {
        width: 100%;
        padding: 8px;
        margin: 10px 0;
        border-radius: 4px;
        border: 1px solid #ccc;
    }
    .section-item {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    .section-item input {
        flex: 1;
    }
    .output-box {
        background: white;
        padding: 20px;
        border-radius: 6px;
        margin-top: 20px;
    }
</style>
<body>
    <?php 
    session_start();
    include_once 'config.php';
    if (isset($_POST['course_id'])):   
    $id=(int)$_POST['course_id'];
    $_SESSION['id']=$id;
    $query="select title,description,level from courses where id=$id ";
    $result=$conn->query($query)->fetch_assoc();
    ?>
    <form class="container" action="courses_edit_recup.php" method="POST">
    <h2>modifier un cours</h2>

    <label>Titre</label>
    <input type="text" id="title" name="title" value="<?= $result['title'] ?>">

    <label>Description</label>
    <textarea id="description" rows="5" name="description"><?= $result['description'] ?></textarea>

    <label>Niveau</label>
    <select id="level" name="level" value="<?= $result['level'] ?>">
        <option value="Débutant">Débutant</option>
        <option value="Intermédiaire">Intermédiaire</option>
        <option value="Avancé">Avancé</option>
    </select>

    <!-- <h3>Sections</h3> -->
    <!-- <div id="sections"></div> -->

    <!-- <button onclick="addSection()">+ Ajouter une section</button> -->
    <button type="submit" id="ert">Soumettre</button>

    <!-- <div id="output" class="output-box"></div> -->
</form>
    
    <?php endif;  ?>
    <script>
        // document.getElementById('edit_card').addEventListener('click',()=>{
        //     document.querySelector('form.container').style.display='block';
        //     document.getElementById('courses').style.display='none';
        // })
    </script>
</body>
</html>