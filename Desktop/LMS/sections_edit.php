<?php
// Database connection
include_once 'config.php';
// recupreation d id
$section_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// preparation de requete
$query="SELECT * FROM sections WHERE id = $section_id";
// execution et recuperation des resultat
$section=$conn->query($query)->fetch_assoc();

// Fetch all courses
$query1="SELECT id, title FROM courses";
$courses = $conn->query($query1);

//recuperer les champs
    $new_title = $_POST['title'];
    $new_content = $_POST['content'];
    $new_course_id = (int)$_POST['course_id'];

$stmt = $conn->prepare("UPDATE sections SET title = ?, content = ?, course_id = ? WHERE id = ?");
$stmt->bind_param("ssii", $new_title, $new_content, $new_course_id, $section_id);
$stmt->execute();
    echo "<p style='color:green;'>Section updated successfully!</p>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Section</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f4f4f4; }
        form { background: #fff; padding: 20px; border-radius: 8px; max-width: 500px; margin: auto; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input[type="text"], textarea, select {
            width: 100%; padding: 10px; margin-top: 5px; border: 1px solid #ccc; border-radius: 4px;
        }
        button {
            margin-top: 20px; padding: 10px 20px; background: #007BFF; color: white;
            border: none; border-radius: 4px; cursor: pointer;
        }
        button:hover { background: #0056b3; }
    </style>
</head>
<body>
<h2>Edit Section</h2>
<form method="POST">
    <label for="title">Section Title</label>
    <input type="text" name="title" id="title" value="<?=$section['title'] ?>" required>

    <label for="content">Content</label>
    <textarea name="content" id="content" rows="5" required><?=$section['content'] ?></textarea>

    <label for="course_id">Assigned Course</label>
<select name="course_id" id="course_id" required>
    <?php while ($course = $courses->fetch_assoc()): ?>
        <option value="<?= $course['id'] ?>" <?= $course['id'] == $section['course_id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($course['title']) ?>
        </option>
    <?php endwhile; ?>
</select>

    <button type="submit">Update Section</button>
</form>

</body>
</html>
