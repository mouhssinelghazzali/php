<?php
// Inialize session
session_start();
// Check, if user is already login, then jump to secured page
if (isset($_SESSION['username'])) {
header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <title>Site de restitution</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="robots" content="noindex, nofollow">
	<META NAME="robots" CONTENT="noarchive">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="assets/js/html5shiv.js"></script>
    <![endif]-->
<style>
html { 
  margin:0;
  padding:0;
  background: #3e3e40 url(img/background.gif) fixed repeat;
}
body
{
	font-family:Verdana,Tahoma,Helvetica,Arial,sans-serif;
}
form {
    border: 3px solid #f1f1f1;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

button {
    background-color: #a8121a;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
	
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>

  </head>

  <body>
  <p style="text-align:center;"></p>
<h4 align="center"><font color="red"><?php if(isset($_GET['mdp'])){echo "Erreur de connexion";} ?></font></h4>
<form action="loginproc.php" style="background-color: white; width:100%; max-width:450px; text-align:center; margin:auto;box-shadow: 8px 8px 12px #aaa;" method="post" name="formulaire">
  <div class="imgcontainer">
    <img src="img/logo.png">
  </div>
  <div class="container">
    <label><b>Identifiant</b></label>
    <input type="text" name="username" required>
    <label><b>Mot de passe</b></label>
    <input type="password" name="password" required>
    <button class="soumettre" type="submit" style="background-color: #024a82;font-size: 15px;">Connexion</button>
  </div>
  <p><img src="img/mv2clientstrategy.png" alt="MV2 Client Experience" style="max-width:300px; width:40%;" /></p>
</form>


</body>
</html>