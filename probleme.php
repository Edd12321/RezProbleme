<!DOCTYPE HTML>
<html>
  <head>
    <link rel="stylesheet" href="/style.css">
    <style>
      #cutie {
        height: fit-content;
        width: fit-content;
      }
      input {
        left: 0px;
      }
    </style>
  </head>
  <body>
    <h2>Lista de probleme</h2>
    <?php
      $pb = scandir('comp');
      foreach($pb as $problema) {
        if ($problema[0] != '.') {
          echo '<div id="cutie">
                <b>' .
                  basename($problema) .
               '</b>
                <div id="cerinta">' . 
                  file_get_contents('comp/' . $problema . '/cerinta.html') .
                 '<form method="post" action="' . 'comp/' . $problema . '/compilare.php">
                    <button type="submit" class="button" name="rez">Rezolva!</button>
                  </form>
                </div></div><br />';
        }
      }
  ?>
  <center><hr />
    <i>Prea putine probleme? <a href="/inv.php">Compune-ti propria problema!</a></i>
  </center>
  </body>
</html>
