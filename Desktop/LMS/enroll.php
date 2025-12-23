<?php
session_start();
require_once 'config.php'; // fichier de connexion à la base
// include_once 'courses_list.php';

// Vérifier que l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    die("Vous devez être connecté pour vous inscrire à un cours.");
}

// Récupérer l'id du cours (GET ou POST)
if (isset($_GET['id'])) {
    $course_id = (int) $_GET['id'];
}

$user_id = $_SESSION['id'];

// Vérifier si déjà inscrit
$sql_check = "SELECT * FROM enrollement WHERE user_id = ? AND course_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ii", $user_id, $course_id);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    echo "Vous êtes déjà inscrit à ce cours.";
} else {
    // Insérer l'inscription
    $sql_insert = "INSERT INTO enrollement (user_id, course_id) VALUES (?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("ii", $user_id, $course_id);

    if ($stmt_insert->execute()) {
        echo "Inscription réussie au cours.";
        sleep(2);
        header('location:my_courses.php');
    } else {
        echo "Erreur lors de l'inscription : " . $conn->error;
    }
}

// class enroll extends connect{
//     private $user_id;
//     private $course_id;

    
//     public function checklogin(){
//         if (isset($_SESSION['id'])) {
//             # code...
//             $this->user_id=$_SESSION['id'];
//             $this->course_id=$_GET['id'];
//             return true;
//         }else{
//             die('Vous devez être connecté pour vous inscrire à un cours.');
//         }
//     }

//     public function checkenrolled(){
//         $sql_check = "SELECT * FROM enrollement WHERE user_id = ? AND course_id = ?";
//         $stmt_check = $this->conn->prepare($sql_check);
//         $stmt_check->bind_param("ii", $this->user_id, $course_id);
//         $stmt_check->execute();
//         $result = $stmt_check->get_result();
//         $result->num_rows > 0 ? is_enrolled() : not_enrolled();
//     }

//     public function is_enrolled(){
//         echo "Vous êtes déjà inscrit à ce cours.";
//     }

//     public function not_eronlled(){
//         $sql_insert = "INSERT INTO enrollement (user_id, course_id) VALUES (?, ?)";
//         $stmt_insert = $this->conn->prepare($sql_insert);
//         $stmt_insert->bind_param("ii", $this->user_id, $this->course_id);

//         if ($stmt_insert->execute()) {
//             echo "Inscription réussie au cours.";
//             header('location:my_courses.php');
//         } else {
//         echo "Erreur lors de l'inscription : " . $conn->error;
//         }
//     }
// }

?>
