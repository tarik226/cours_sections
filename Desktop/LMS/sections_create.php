<?php
// Database connection
include_once 'config.php';

// recuperation des courses
$query = "SELECT id, title FROM courses";
// execution de query
$courses = $conn->query($query);

// recuperer les chmaps d ajout
    $title = $_POST['title'];
    $content = $_POST['content'];
// chnager le type en int
    $course_id = (int)$_POST['course_id'];
    $position=(int)$_POST['position'];
//ajout de sections au tableau
$insert = "INSERT INTO sections (course_id, title, content, position)
           VALUES ($course_id, '".$title."',
                   '".$content."', $position)";
                       $conn->query($insert);

var_dump($conn->query($insert));
// message dajout ou echec
    if ($conn->query($insert)) {
        echo "<p style='color:green;'>Section added successfully!</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Section</title>
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
<h2>Add Section</h2>
<form method="POST">
    <label for="title">Section Title</label>
    <input type="text" name="title" id="title" required>

    <label for="content">Content</label>
    <textarea name="content" id="content" rows="5" required></textarea>

    <label for="course_id">Assign to Course</label>
    <select name="course_id" id="course_id" required>
        <?php while ($course = $courses->fetch_assoc()): ?>
            <option value="<?= $course['id'] ?>"><?= htmlspecialchars($course['title']) ?></option>
        <?php endwhile; ?>
    </select>

    <label for="position">Position</label>
    <input type="text" name="position" id="position" required>

    <button type="submit">Add Section</button>
</form>

</body>
</html>
