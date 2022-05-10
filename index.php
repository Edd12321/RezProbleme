<?php
  session_start();
  include 'config.php';
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>RezProbleme</title>

    <link rel="stylesheet" href="/style.css">
    <style>
      html, body {
        background-color: #eeeeee;
      }
      body {
        margin: 0px;
        color: #ffffff;
      }
      .wrap {
        margin: 0 auto;
        margin-top: 30px;
        width: 90%;
        height: 100vh;

        border: 0px;
      }
      iframe {
        border: 0px;
        box-shadow: 2px 2px 4px #cccccc;
      }
    </style>
  </head>
  <body>
    <ul>
      <li>
        <a href="/index.php" 
          <?php
            #Da, este butonul selectat.
            if (!isset($_GET['q']))
              echo 'class="curent"';
          ?>
        >
          Acasa
        </a>
      </li>
      <li>
        <a href="/index.php?q=pb"
          <?php
            #Idem
            if ($_GET['q'] == 'pb')
              echo 'class="curent"';
          ?>
        >
          Probleme
        </a>
      </li>
      <li>
        <a href="/index.php?q=cr"
          <?php
            if ($_GET['q'] == 'cr')
              echo 'class="curent"';     
          ?>
        >
          Compune
        </a>
      </li>
      <span style="float:right;">
        <li>
          <i>Ma cheama... </i>
        </li>
        <form method="post">
          <input type="text" name="util" placeholder=<?php echo '"'.$_COOKIE["nume"].'"'; ?>>
          <button class="button" id="button2" type="submit">OK</button>
          <?php
            #TODO: repara
            if (isset($_POST["util"])) {
              echo "<meta http-equiv=\"refresh\">";
            }
          ?>
        </form>
      </span>
    </ul>
    <div id="pagina">
      <i>RezProbleme</i>
    </div>
    <div class="wrap"><iframe src=
      <?php
        if (isset($_POST["util"])) {
          setcookie("nume", $_POST["util"], 0, "/");
        }
        switch($_GET['q']) {
        case 'pb':
          echo '"/probleme.php"';
          break;
        case 'cr':
          echo '"/inv.php"';
          break;
        default:
          echo '"/home.php"';
          break;
        }
      ?>
      scrolling="no" 
      id="Ifr"

      style="width:100%;"
    ></iframe>
    <script>
      let frame = document.querySelector("#Ifr");

      // Facem iframe sa acopere tot spatiul disponibil.

      frame.addEventListener('load', function() {
        frame.style.height = frame.contentDocument.body.scrollHeight + 300 + 'px'
      });
    </script>
    </div>
  </body>
</html>
