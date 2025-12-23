<?php session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            padding: 50px 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-header h1 {
            color: #333;
            font-size: 32px;
            margin-bottom: 10px;
        }

        .login-header p {
            color: #666;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 14px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            outline: none;
        }

        input:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input::placeholder {
            color: #aaa;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 14px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #666;
        }

        .remember-me input[type="checkbox"] {
            width: auto;
            cursor: pointer;
        }

        .forgot-password {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            color: #666;
            font-size: 14px;
        }

        .signup-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php  
        include_once 'config.php';
        if (isset($_POST['password'])&&isset($_POST['username'])) {
            
                # code...
                $password=$_POST['password'];
                $user_name=$_POST['username'];
                $pass=$conn->query("SELECT passworde from users where user_name='$user_name' ")->fetch_assoc();
                $hash=$pass['passworde'];
            $execute=$conn->query("SELECT  id from users where passworde='$hash' and user_name='$user_name'");
            if ($execute && password_verify("$password", "$hash")) {
                # code...
                $user = $execute->fetch_assoc();
                $user_id = (int)$user['id'];
                $_SESSION['id']=$user_id;
                header("Location:dashboard.php");
            } else {
                # code...
               echo "<p style='color:red;'>credentials incorrect</p>";

            };
        }



// class Login  extends connect{
//     private $user;
//     private $password;
//     public function __construct($user,$password) {
//         $this->user = $user;
//         $this->password=$password;
//     }

//     public function login() {
//         $stmt = $this->conn->prepare("SELECT id, passworde FROM users WHERE user_name = ?");
//         $stmt->bind_param("s", $this->username);
//         $stmt->execute();
//         $result = $stmt->get_result();

//         if ($result->num_rows === 1) {
//             $user = $result->fetch_assoc();
//             $hash = $user['passworde'];
//             if (password_verify($this->password, $hash)) {
//                 $_SESSION['id'] = (int)$user['id'];
//                 header("Location: dashboard.php");
//                 exit();
//             }
//         }
//          echo "<p style='color:red;'>credentials incorrect</p>";
//     }
// }

// // Usage
// if (isset($_POST['username']) && isset($_POST['password'])) {
//     $auth = new Login($_POST['username'], $_POST['password']);
//     $auth->login();
// }

        
?>
    <div class="login-container">
        <div class="login-header">
            <h1>Connexion</h1>
            <p>Bienvenue! Veuillez vous connecter</p>
        </div>

        <form id="loginForm" method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" placeholder="Entrez votre nom d'utilisateur" required value=<?= isset($_GET['username'])?$_GET['username']:''?>>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required>
            </div>

            <div class="remember-forgot">
                <label class="remember-me">
                    <input type="checkbox" id="remember" name="remember">
                    Se souvenir de moi
                </label>
                <a href="#" class="forgot-password">Mot de passe oublié?</a>
            </div>

            <button type="submit" class="btn-login">Se connecter</button>
        </form>

        <div class="signup-link">
            Pas encore de compte? <a href="register.php">S'inscrire</a>
        </div>
    </div>

    <!-- <script>
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const remember = document.getElementById('remember').checked;
            
            console.log('Connexion:', {
                username: username,
                password: password,
                remember: remember
            });
            
            alert('Connexion réussie! (Démo)');
        });
    </script> -->
</body>
</html>
