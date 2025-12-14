<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $page_title ?? 'My LMS' ?></title>
    <style>
        body { font-family: Arial, sans-serif; margin:0; padding:0; background:#f4f4f4; }
        header { background:#007BFF; color:#fff; padding:15px; }
        header h1 { margin:0; font-size:24px; }
        nav a { color:#fff; margin-right:15px; text-decoration:none; }
        nav a:hover { text-decoration:underline; }
        .container { padding:20px; }
    </style>
</head>
<body>
<header>
    <h1>My LMS</h1>
    <nav>
        <a href="courses_list.php">Courses</a>
        <a href="sections_list.php">Sections</a>
        <a href="course_create.php">Add Course</a>
        <a href="sections_create.php">Add Section</a>
    </nav>
</header>
