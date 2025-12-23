<?php 
// class logout(){
//     public function logout(){
//         session_unset();
//         session_destroy();
//         header('Location:login.php');

//     } 
// }
// if (isset($_SESSION['id'])) {
//     # code...
//     $logout=new logout();
//     $logout->logout();
// } 
        session_unset();
        session_destroy();
        header('Location:login.php');


?>
