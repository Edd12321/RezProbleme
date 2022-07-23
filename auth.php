<?php
  if (!isset($_SESSION))
	  session_start();
  include "config.php";
  include "navbar.php";

  #####################################################################################
  ### SCHIMBA VARIABILA PENTRU A STOCA PAROLELE ALTUNDEVA DACA NU MERGE .htaccess ! ###
  #####################################################################################
  $ROOTPASS = "$root/pass";

  ini_set('display_errors', 0);
  error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div id="box" style="padding:3px;">
    <h2>Autentificare/Inregistrare</h2>
    <div class="table">
      <form method="post">
        <div class="tr">
          <div class="td">
            <label for="name">
              <b>Nume de utilizator</b>
            </label>
          </div>
          <div class="td" id="pt2">
            <input required type="text" name="name">
          </div>
          <div>
            <label for="pass">
              <b>Parola</b>
            </label>
          </div>
          <div class="td" id="pt2">
            <input required type="text" name="pass" autocomplete="off" style="-webkit-text-security: disc;">
          </div>
          <?php
            require "$root/verify.php";
            echo $_SESSION["captcha"].'<br /><br /><br />';
            
            echo "<input required type=\"text\" placeholder=\"CAPTCHA\" name=\"captcha\" autocomplete=\"off\">";
           ?>
		  <button class="button" id="button2">OK</button> 
        </form>
      </div>
    </div>
    <?php
      if (isset($_POST)) {
        $nume = @$_POST["name"];
        $pass = @$_POST["pass"];
        $fisNume = "$ROOTPASS/$nume.txt";

        if ($_SESSION["solve"] == @$_POST["captcha"]) {
          if (!file_exists($fisNume)) {
            # Creeam profilul daca nu exista
            mkdir("profile/$nume");
            mkdir("profile/$nume/sol");
			file_put_contents("profile/$nume/bio.txt", "Hello, world!");
            
            # Facem un symbolic link
            symlink("../../profile.php", "profile/$nume/index.php");
  
            file_put_contents($fisNume, password_hash($pass, PASSWORD_DEFAULT));
          } else if (password_verify($pass, file_get_contents($fisNume))) {
            $_SESSION["nume"] = $nume;
          }
        }
      }
    ?>
  </body>
</html>
