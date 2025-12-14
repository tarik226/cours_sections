<?php
// Database connection
include_once 'config.php';

// recuppration d id
$section_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($section_id > 0) {
    // preparation du requete
    $delete = "DELETE FROM sections WHERE id = $section_id";
    // execution du requete
    if ($conn->query($delete)) {
        // Success message + redirect
        echo "<p style='color:green;'>Section deleted successfully!</p>";
        header("Refresh:2; url=sections_list.php"); // redirect after 2 seconds
        exit;
    } else {
        echo "<p style='color:red;'>Error deleting section: " . $conn->error . "</p>";
    }
} else {
    echo "<p style='color:red;'>Invalid section ID.</p>";
}
?>
