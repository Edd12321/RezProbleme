<?php
  session_start();
  include 'config.php';
?>

<!DOCTYPE HTML>
<html>
  <head>
    <title>RezProbleme</title>
    <link rel="stylesheet" href=<?php echo "\"$root2/style.css\""; ?>>
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

      #pagina {
        background: url('<?php $v = array_slice(scandir(__DIR__."/res"), 2); echo "res/".$v[array_rand($v)];?>');
        height: 300px;
        background-attachment: fixed;
        position: relative;
      }
      #pagina i {
        font-size: 30px;
        position: absolute;
        bottom: 0px;
        font-weight: 200;
      }
      @media only screen and (max-device-width: 800px) {
        .wrap {
          width: 100%;
        }
      }
    </style>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=0.80, minimum-scale=0.80, user-scalable=no, user-scrollable=no, minimal-ui">
  </head>
  <body>
    <ul>
      <li>
      <a href=<?php echo "\"$root2/index.php\"";?> 
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
      <a href=<?php echo "\"$root2/index.php?q=pb\"";?>
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
        <a href=<?php echo "\"$root2/index.php?q=cr\"";?>
          <?php
            if ($_GET['q'] == 'cr')
              echo 'class="curent"';     
          ?>
        >
          Compune
        </a>
      </li>
      <span style="float:right;">
        <li style="background-color:#222;">
        <a href=<?php echo "\"$root2/index.php?q=au\"";?>
            <?php
              if ($_GET['q'] == 'au')
                echo 'class="curent"';
            ?>
          >
          <?php
            if ($_SESSION["nume"] == "Anonim") {
              echo 'Autentificare';
            } else {
              echo $_SESSION["nume"];
            }
          ?>
        </a>
        </li>
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
          echo "\"$root2/probleme.php\"";
          break;
        case 'cr':
          echo "\"$root2/inv.php\"";
          break;
        case 'au':
          echo "\"$root2/auth.php\"";
          break;
        default:
          echo "\"$root2/home.php\"";
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
