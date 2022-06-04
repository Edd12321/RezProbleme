<?php
  session_start();
  include 'config.php';
?>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div id="cutie" style="padding:3px;">
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
          <button class="button" id="button2">OK</button> 
        </form>
      </div>
    </div>
    <?php
      if (isset($_POST)) {
        $nume = $_POST["name"];
        $pass = $_POST["pass"];
        $fisNume = "$root/pass/$nume.txt";

        if (!file_exists($fisNume)) {
          file_put_contents($fisNume, password_hash($pass, PASSWORD_DEFAULT));
        } else if (password_verify($pass, file_get_contents($fisNume))) {
          $_SESSION["nume"] = $nume;
        }
      }
    ?>
  </body>
</html>
