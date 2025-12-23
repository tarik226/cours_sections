<?php
session_start();
require_once 'config.php'; // connexion à la base

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    die("Vous devez être connecté pour voir vos cours.");
}

$user_id = $_SESSION['id'];

$sql = "
    SELECT c.id, c.title as title, c.description as descr ,c.level as level
    FROM users u
     JOIN enrollement e ON u.id = e.user_id
     JOIN courses c ON e.course_id = c.id
    WHERE u.id = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Courses</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #e3f2fd;
            padding: 2rem;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        header {
            margin-bottom: 2rem;
        }

        header h1 {
            font-size: 2rem;
            color: #2d3748;
            margin-bottom: 0.5rem;
        }

        header p {
            color: #718096;
            font-size: 1rem;
        }

        .table-wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #42a5f5;
        }

        thead th {
            color: white;
            font-weight: 600;
            text-align: left;
            padding: 1.2rem 1.5rem;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tbody tr {
            border-bottom: 1px solid #e2e8f0;
            transition: background-color 0.2s ease;
        }

        tbody tr:last-child {
            border-bottom: none;
        }

        tbody tr:hover {
            background-color: #f7fafc;
        }

        tbody td {
            padding: 1.2rem 1.5rem;
            color: #2d3748;
        }

        .course-title {
            font-weight: 600;
            color: #1a202c;
            font-size: 1rem;
        }

        .course-date {
            color: #718096;
            font-size: 0.9rem;
        }

        .level-badge {
            display: inline-block;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .level-beginner {
            background: #c6f6d5;
            color: #22543d;
        }

        .level-intermediate {
            background: #bee3f8;
            color: #2c5282;
        }

        .level-advanced {
            background: #fed7d7;
            color: #742a2a;
        }

        .actions {
            display: flex;
            gap: 0.5rem;
        }

        .btn {
            padding: 0.5rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .btn-primary:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #edf2f7;
            color: #4a5568;
        }

        .btn-secondary:hover {
            background: #e2e8f0;
        }

        .empty-state {
            text-align: center;
            padding: 3rem;
            color: #718096;
        }

        @media (max-width: 768px) {
            body {
                padding: 1rem;
            }

            .table-wrapper {
                overflow-x: auto;
            }

            table {
                min-width: 600px;
            }

            thead th,
            tbody td {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Enrolled Courses</h1>
            <p>Manage and track your learning journey</p>
        </header>
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Course Title</th>
                        <th>Created At</th>
                        <th>Level</th>
                    </tr>
                </thead>
                <tbody>
<?php if ($result->num_rows > 0) {
    echo "<h2>Mes cours</h2><ul>";
    while ($row = $result->fetch_assoc()) :;?>
     <tr>
                        <td class="course-title"><?= $row['title'] ?></td>
                        <td class="course-date"><?= $row['descr'] ?></td>
<td><span class="level-badge <?= $row['level'] == 'Débutant' ? 'level-beginner': ($row['level'] == 'Intermédiaire' ? 'level-intermediate' : 'level-advanced') ?>">
        <?= $row['level'] ?>
    </span>
</td>                    </tr>
<?php 
endwhile;

} else {
    echo "Vous n'êtes inscrit à aucun cours.";
}

?>



        
</tbody>
                   
                   
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
