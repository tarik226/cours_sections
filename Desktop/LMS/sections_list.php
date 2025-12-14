<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Section Card</title>

<style>
body {
        font-family: Arial, sans-serif;
        background: #f4f4f4;
        padding: 40px;
    }

    .section-card {
        width: 320px;
        background: white;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        margin-bottom: 20px;
        transition: 0.3s ease;
    }

    .section-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.15);
    }

    .section-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
    }
    .edit-button {
    display: inline-block;
    padding: 4px 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 20px;
    font-size: 12px;
    cursor: pointer;
    margin-left: 10px;
    transition: background 0.3s ease;
}

.edit-button:hover {
    background: #0056b3;
}


.section-info {
        font-size: 14px;
        color: #666;
        margin-bottom: 6px;
}

.label {
        font-weight: bold;
        color: #444;
}

.position-badge {
        display: inline-block;
        padding: 4px 10px;
        background: #007bff;
        color: white;
        border-radius: 20px;
        font-size: 12px;
        margin-top: 8px;
}
    
.form-group {
        margin-bottom: 20px;
        width: 320px;
}

label {
        font-weight: bold;
        color: #333;
        display: block;
        margin-bottom: 6px;
}

    /* Styled Select Box */
.styled-select {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ccc;
        background: #fff;
        color: #333;
        font-size: 14px;
        appearance: none; /* Removes the native arrow */
        -webkit-appearance: none;
        -moz-appearance: none;
        background-image: url('data:image/svg+xml;charset=UTF-8,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="%23666"><polygon points="0,0 16,0 8,10"/></svg>');
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 12px;
        cursor: pointer;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.styled-select:hover {
        border-color: #888;
}

.styled-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 4px rgba(0, 123, 255, 0.3);
        outline: none;
}

    /* Optional: matching card style */
.select-card {
        margin:auto;
        margin-bottom:20px;
        background: white;
        padding: 20px;
        width: 320px;
        border-radius: 10px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
</style>
<link rel="stylesheet" href="style.css">
</head>
<!-- fichier de connexin au db -->
<?php include_once 'config.php';
 ?>
<body>
    <div class="select-card">
    <h3 style="margin-top:0;">Choose a Section</h3>

    <form class="form-group" action="#"  method="POST">
        <label for="sectionSelect">Sections</label>
        <select id="sectionSelect" class="styled-select">
            <option value="" disabled selected>Choose a section...</option>
            <?php 
    // preparation du requete
    $query1="select title,id from courses ";
    // execution de requete
    $result=$conn->query($query1);
    // recuperation du resultat et affichage
    while ($row=$result->fetch_assoc()):
            ?> 
            <option value="<?= $row['id'] ?>"><?= $row['title'] ?></option>
            
    <?php endwhile; ?>
        </select>
            <input type="hidden" name="hidden_input" id="hidden_input" value="">

    </form>
</div>
<div style="display:flex;flex-wrap:wrap;gap:25px">
 <?php 
 if (empty($_POST)) :
    # code...
     $query="select * from sections";
    $result=$conn->query($query);
    while ($row=$result->fetch_assoc()):
        # code...
 
   
    ?>
<!-- Sample Card -->
<div class="section-card">
    <div class="section-title"><?= $row['title'] ?></div>

    <div class="section-info">
        <span class="label">Course ID:</span> <?= $row['course_id'] ?>
    </div>

    <div class="section-info">
        <span class="label">Position:</span> <?= $row['position'] ?>
    </div>

    <span class="position-badge"><?= $row['created_at'] ?></span>
<span><button class="edit-button"><a href="sections_edit.php?id=<?=$row['id'] ?>">edit</a></button></span>    <span><button class="edit-button"><a href="sections_delete.php?id=<?=$row['id'] ?>">supprimer</a></button></span>


</div>
<?php endwhile;
else:
    $id=(int)$_POST['hidden_input'];
    $query2="select * from sections where course_id=$id";
     $result=$conn->query($query2);
    while ($row=$result->fetch_assoc()):

?>
<div class="section-card">
    <div class="section-title"><?= $row['title'] ?></div>

    <div class="section-info">
        <span class="label">Course ID:</span> <?= $row['course_id'] ?>
    </div>

    <div class="section-info">
        <span class="label">Position:</span> <?= $row['position'] ?>
    </div>

    <span class="position-badge"><?= $row['created_at'] ?></span>
    <span><button class="edit-button"><a href="sections_edit.php?id='.<?=$row['id'] ?>.'">edit</a></button></span>    <span><button class="edit-button"><a href="sections_edit.php?id=<?=$row['id'] ?>">supprimer</a></button></span>

</div>
    </div>
<?php endwhile;endif; ?>
<button class="add-button"><a href="sections_create.php">ajouter</a></button>
    <script>
        document.querySelector('select').addEventListener('change',()=>{
                    document.getElementById('hidden_input').value=document.getElementById('sectionSelect').value;
                    document.querySelector('.form-group').submit();
        })
    </script>
</body>
</html>
