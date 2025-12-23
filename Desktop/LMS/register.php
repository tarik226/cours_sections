<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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

        .container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 450px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
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
            padding: 12px 15px;
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

        .btn-submit {
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
            margin-top: 10px;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php 
    include_once 'config.php';
    if ($_SERVER['REQUEST_METHOD']=="POST") {
        # code...
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $password=password_hash($_POST['password'],PASSWORD_DEFAULT) ;
//         echo $nom,$prenom;
        $execute=$conn->query("INSERT into users (nom,prenom,user_name,email,passworde) values ('$nom','$prenom','$username','$email','$password'); ");
        // $execute->fetch_assoc();
        if ($execute=="TRUE") {
            # code...
            header("Location: login.php?username=$username");
                    echo "<p style='color:green;'>user added successfully!</p>"; 
        } else {
            # code...
                    echo "<p style='color:red;'>Error adding user: " . $conn->error . "</p>";

        }
        
    };
    // class Register extends connect {
    //     private $nom;
    //     private $prenom;
    //     private $username;
    //     private $email;
    //     private $password;
    //     private $hash;

    //     public function __construct($nom,$prenom,$username,$email,$password){
    //         $this->nom=$nom;
    //         $this->prenom=$prenom;
    //         $this->username=$username;
    //         $this->email=$email;
    //         $this->password=$password;
    //     }
    //     public function pass_hash(){
    //         $this->hash=password_hash($this->password,PASSWORD_DEFAULT);
    //     }
    //     public function user_insert(){
    //         $stmt=$this->conn->prepare("INSERT into users (nom,prenom,user_name,email,passworde) values (?,?,?,?,?);");
    //         $stmt->bind_param('sssss',$this->nom,$this->prenom,$this->username,$this->email,$this->hash);
    //         $stmt->execute();
    //         $result=$stmt->affected_rows;
    //         if ($result>0) {
    //             # code...
    //                 $_SESSION['id']=$this->conn->insert_id;
    //                 header("Location: login.php");
    //                 echo "<p style='color:green;'>user added successfully!</p>"; 

    //         } else {
    //             # code...
    //             echo "<p style='color:red;'>Error adding user: " . $conn->error . "</p>";

    //         }
            
            
    //     }


    // }

    ?>
    <div class="container">
        <h2>Créer un compte</h2>
        <form id="registrationForm" method="POST">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Entrez votre nom" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
            </div>

            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" placeholder="Choisissez un nom d'utilisateur" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="votre.email@exemple.com" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Créez un mot de passe" required>
            </div>

            <button type="submit" class="btn-submit">S'inscrire</button>
        </form>

        <div class="login-link">
            Vous avez déjà un compte? <a href="login.php">Se connecter</a>
        </div>
    </div>

    <!-- <script>
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = {
                nom: document.getElementById('nom').value,
                prenom: document.getElementById('prenom').value,
                username: document.getElementById('username').value,
                email: document.getElementById('email').value,
                password: document.getElementById('password').value
            };
            
            console.log('Données du formulaire:', formData);
            alert('Inscription réussie! (Démo)');
        });
    </script> -->
</body>
</html>
