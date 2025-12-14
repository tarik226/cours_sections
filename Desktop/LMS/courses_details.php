<?php
// Database connection
// appel du fichier qui etablit la connexion
include_once 'config.php';

// recuperer le id passer avec le lien
// sil n existe pas la variable prend la vzleur 0
$course_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
var_dump($course_id);
$course = null;
if ($course_id > 0) {
    // preparaion du requete 
    $stmt = $conn->prepare("SELECT * FROM courses WHERE id = ?");
    // placer les variables pour plus securite
    $stmt->bind_param("i", $course_id);
    // executer la requete
    $stmt->execute();
    // recuperer les resultat
    $course = $stmt->get_result()->fetch_assoc();
}

// Fetch sections for this course
$sections = [];
if ($course_id > 0) {
    // prepartion du requete
    $stmt = $conn->prepare("SELECT * FROM sections WHERE course_id = ? ORDER BY position ASC");
    // placer les variables pour plus securite
    $stmt->bind_param("i", $course_id);
    // executer la requete
    $stmt->execute();
    // recuperer les resultat
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        // ajout au tableau sections a dernier case
        $sections[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Course Details</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f4f4f4; }
        .container { background: #fff; padding: 20px; border-radius: 8px; max-width: 700px; margin: auto; }
        h2 { margin-top: 0; }
        .course-info { margin-bottom: 20px; }
        .sections { margin-top: 20px; }
        .section { background: #f9f9f9; padding: 10px; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 10px; }
        .section h4 { margin: 0 0 5px 0; }
        a.button {
            display: inline-block; padding: 6px 12px; background: #007BFF; color: #fff;
            text-decoration: none; border-radius: 4px; margin-top: 10px;
        }
        a.button:hover { background: #0056b3; }
    </style>
</head>
<body>
<div class="container">
    <!-- si le cousrse existe afficjre le titre , description et level -->
    <?php if ($course): ?>
        <h2><?= htmlspecialchars($course['title']) ?></h2>
        <div class="course-info">
            <p><strong>Description:</strong> <?= htmlspecialchars($course['description']) ?></p>
            <p><strong>Level:</strong> <?= htmlspecialchars($course['level']) ?></p>
        </div>

        <h3>Sections</h3>
        <div class="sections">
            <!-- s i lexistedes sections affiche le titre,content,position et 2 buttons pour modifier ou suppimer en passant l id de sections -->
            <?php if (!empty($sections)): ?>
                <?php foreach ($sections as $section): ?>
                    <div class="section">
                        <h4><?= htmlspecialchars($section['title']) ?></h4>
                        <p><?= htmlspecialchars($section['content']) ?></p>
                        <p><em>Position: <?= $section['position'] ?></em></p>
                        <a href="sections_edit.php?id=<?= $section['id'] ?>" class="button">Edit Section</a>
                        <a href="sections_delete.php?id=<?= $section['id'] ?>" class="button" style="background:#dc3545;">Delete</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No sections assigned to this course yet.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <p style="color:red;">Course not found.</p>
    <?php endif; ?>
</div>
</body>
</html>
