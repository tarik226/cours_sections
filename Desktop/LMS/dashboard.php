<?php session_start();
 ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f6fa;
            min-height: 100vh;
        }

        .header {
            background: linear-gradient(135deg, #4FC3F7 0%, #29B6F6 100%);
            color: white;
            padding: 20px 40px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header h1 {
            font-size: 28px;
            margin-bottom: 5px;
        }

        .header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0,0,0,0.15);
        }

        .stat-card h3 {
            color: #666;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 36px;
            font-weight: 700;
            color: #29B6F6;
            margin-bottom: 5px;
        }

        .stat-label {
            color: #999;
            font-size: 12px;
        }

        .tables-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(600px, 1fr));
            gap: 30px;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }

        .table-header {
            background: linear-gradient(135deg, #4FC3F7 0%, #29B6F6 100%);
            color: white;
            padding: 20px 25px;
        }

        .table-header h2 {
            font-size: 18px;
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead {
            background: #f8f9fa;
        }

        th {
            text-align: left;
            padding: 15px 25px;
            font-weight: 600;
            color: #555;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 15px 25px;
            color: #666;
            border-bottom: 1px solid #f0f0f0;
        }

        tbody tr:hover {
            background: #E1F5FE;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .badge-success {
            background: #d4edda;
            color: #155724;
        }

        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }

        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }
            
            .tables-section {
                grid-template-columns: 1fr;
            }
            
            .header {
                padding: 20px;
            }
            
            th, td {
                padding: 12px 15px;
                font-size: 13px;
            }
        }
    </style>
</head>
<body>

<?php 
include_once 'config.php';
// $user_id=(int)$_SESSION['id'];
$user_id=1;
$total_courses=$conn->query("select count(*) total_courses from courses")->fetch_assoc();
// var_dump($total_courses);
$total_utilisateurs=$conn->query("SELECT count(*) total_utilisateurs from users")->fetch_assoc();
$inscriptions_cours=$conn->query("SELECT COUNT(*) AS total_enrollement
FROM enrollement 
join users 
on enrollement.user_id=users.id 
join courses 
on courses.id=enrollement.course_id 
WHERE users.id=$user_id")->fetch_assoc();
$plus_populaire=$conn->query("SELECT courses.id, courses.title, COUNT(enrollement.user_id) AS total_enrollments
FROM enrollement 
JOIN courses ON enrollement.course_id = courses.id
GROUP BY courses.id 
ORDER BY total_enrollments DESC
LIMIT 1;")->fetch_assoc();
$avg_sections_cours=$conn->query("SELECT AVG(section_count) AS avg_sections_per_course
FROM (
    SELECT COUNT(sections.id) AS section_count
    FROM courses
    JOIN sections ON sections.course_id = courses.id
    JOIN enrollement ON enrollement.course_id = courses.id
    WHERE enrollement.user_id = $user_id
    GROUP BY courses.id
) AS s;
")->fetch_assoc();
$cours_5_section=$conn->query("SELECT c.id, c.title, COUNT(s.id) AS section_count,e.user_id ,c.level
FROM courses c
INNER JOIN sections s ON s.course_id = c.id JOIN enrollement e on e.course_id=c.id
WHERE e.user_id=$user_id
GROUP BY c.id, c.title
HAVING COUNT(s.id) > 2
;");
$current_year_courses=$conn->query("SELECT courses.id,year(CAST(created_at AS DATE)) AS OnlyDate,enrollement.user_id, users.user_name as name,users.email as email
 from courses 
 join enrollement 
 on enrollement.course_id=courses.id  join users on users.id=enrollement.user_id
 where year(CAST(created_at AS DATE)) = Year(NOW())-1 and enrollement.user_id=1;");
$unsucribed_courses=$conn->query("SELECT courses.title ,courses.level,courses.created_at 
from courses 
where courses.id
NOT in (
    SELECT courses.id 
    from courses 
    join enrollement 
    on courses.id=enrollement.course_id 
    join users 
    on enrollement.user_id=users.id 
    where enrollement.user_id=$user_id );");
$last_users=$conn->query("SELECT email,prenom,user_name from users ORDER BY id DESC limit 3");
?>

    <div class="header">
        <h1>📊 Dashboard</h1>
        <p>Vue d'ensemble des statistiques et données</p>
    </div>

    <div class="container">
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Nombre Total de Cours</h3>
                <div class="stat-value"><?= $total_courses['total_courses']?></div>
                <div class="stat-label">Cours disponibles</div>
            </div>

            <div class="stat-card">
                <h3>Total des Utilisateurs</h3>
                <div class="stat-value"><?= $total_utilisateurs['total_utilisateurs'] ?></div>
                <div class="stat-label">Utilisateurs actifs</div>
            </div>

            <div class="stat-card">
                <h3>Total des Inscriptions</h3>
                <div class="stat-value"><?= $inscriptions_cours['total_enrollement']?></div>
                <div class="stat-label">Inscriptions par cours</div>
            </div>

            <div class="stat-card">
                <h3>Cours le Plus Populaire</h3>
                <div class="stat-value"><?= $plus_populaire['title'] ?></div>
                <div class="stat-label">324 inscriptions</div>
            </div>

            <div class="stat-card">
                <h3>Moyenne Sections/Cours</h3>
                <div class="stat-value"><?= isset($avg_sections_cours['avg_sections_per_course'])?(int)$avg_sections_cours['avg_sections_per_course']:0 ?></div>
                <div class="stat-label">Sections par cours</div>
            </div>
        </div>

        <div class="tables-section">
            <div class="table-container">
                <div class="table-header">
                    <h2>📚 Cours Ayant Plus de 5 Sections</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nom du Cours</th>
                            <th>Sections</th>
                            <th>Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row=$cours_5_section->fetch_assoc()) :
                            # code...
                         ?>
                        <tr>
                            <td><?=  $row['title'] ?></td>
                            <td><span class="badge badge-success"><?= $row['section_count'] ?></span></td>
                            <td><?= $row['level'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h2>👥 Utilisateurs Inscrits cette Année</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row=$current_year_courses->fetch_assoc()) :?>
                        <tr>
                            <td><?= $row['name'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['OnlyDate'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h2>⚠️ Cours Sans Inscription</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Nom du Cours</th>
                            <th>Level</th>
                            <th>Date de Creation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row=$unsucribed_courses->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['title'] ?></td>
                            <td><?= $row['level'] ?></td>
                            <td><span class="badge badge-warning"><?= $row['created_at'] ?></span></td>
                        </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h2>🎯 Dernières Inscriptions</h2>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Utilisateur</th>
                            <th>Cours</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row=$last_users->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['prenom'] ?></td>
                            <td><?= $row['user_name'] ?></td>
                            <td><?= $row['email'] ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
