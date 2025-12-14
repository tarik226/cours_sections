<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php 
    // appel du fichier qui etablit la connexion
    include_once 'config.php';
    // include 'header.php';
    // requete sql
    $sql = "select * from courses";
    // echo "<br>";
    // execution du requete avrc $conn variable de connexion
    $result=$conn->query($sql);
    // var_dump($result);   
    // tableau des images pour avoir des images aleatoires
    $image=['assets/figma.webp','assets/js.webp','assets/react.webp','assets/ux.webp','assets/php.jpg'];
    if ($result->num_rows > 0) {
      // verification que la requette retourne des lignes
    // Loop through each row
    echo '<section id="courses">
  <div class="courses-container">
    <div class="card-grid">
    ';
    while ($row = $result->fetch_assoc()) {
      //iteration pour afficher les course dès la base de donnees
        echo '<form class="course-card" method="POST" action="">
        <img src='.$image[rand(0,4)].' alt="Figma Course" class="course-card__image">
        <div class="course-card__body">
          <h3 class="course-card__title">'.$row['title'] .'</h3>
          <input type="hidden" name="course_id" value="'.$row['id'].'" >
          <div class="course-card__stats">
            <div class="stat-item">
              <span class="stat-item__value">4.6</span>
            </div>
            <div class="stat-item">
              <span class="stat-item__label">'.$row['created_at'].'</span>
            </div>
            <div class="stat-item">
              <span class="stat-item__value">'. $row['level'].'</span>
            </div>
          </div>
          <div class="course-card__price">122.20$</div>
          <div class="course-card__actions">
          
            <button class="btn btn--modification" id="edit_card" type="submit" formaction="courses_edit.php">Edit</button>
            <button class="btn btn--delete"  type="submit"  formaction="courses_delete.php">Supprimer</button>
<a href="courses_details.php?id='.$row['id'].'" class="btn btn--details">Details</a>

          </div>
        </div>
      </form>';}
      echo '</div>
    <button class="add-button">add</button>
  </div>
</section>';
echo '<div class="container">
        <form class="form-box" action="courses_create.php" method="POST">

            <input type="text" placeholder="Title" name="title" class="input-field">

            <textarea placeholder="Description" name="description" class="textarea-field"></textarea>

            <select name="level" class="input-field">
    <option value="Débutant">Débutant</option>
    <option value="Intermédiaire">Intermédiaire</option>
    <option value="Avancé">Avancé</option>
  </select>
  <button type="submit">soumettre</button>
                      </form>
    </div>
    
              
';
} else {
    echo "No results found.";
}
    
    // var_dump($sql);
    // importer le bas du page
    include_once 'footer.php';
    ?>
<script>
     document.querySelector('.add-button').addEventListener('click',()=>{
        document.getElementById('courses').style.display='none';
        document.querySelector('.container').style.display='flex';
    })
    // document.querySelector('.add-btn').addEventListener('click',()=>{
    //     document.querySelector('.add_sction').style.display='block';
    // })
</script>
</body>
</html>