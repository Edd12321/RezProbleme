<?php
  if (!isset($_SESSION)) { 
    session_start(); 
  } 
  include "config.php";
  include "navbar.php";
  
  ini_set('display_errors', 0);
  error_reporting(E_ERROR | E_WARNING | E_PARSE); 
?>

<!DOCTYPE HTML>
<html>
  <head>
	<link rel="stylesheet" href="style.css">
	<style>
      form { height: fit-content; margin-bottom: 0;}
	</style>
  </head>
  <body>
    <h2>Lista de probleme</h2>
  <?php
      #Problemele sunt stocate in folderul "comp".
      $pb = scandir('comp');
      foreach($pb as $problema) {
        if ($problema[0] != '.') {
          #Afisam "fereastra" si cerinta inauntrul ei.
          echo '<div id="box">';
          echo '<b>'.basename($problema).'</b>';
          echo '<div id="box_text">' . 
                  file_get_contents('comp/' . $problema . '/cerinta.html') .
                 '<form method="post" action="comp/'.$problema.'">
                    <button type="submit" class="button" name="rez">Rezolva!</button>
                  </form>
                </div></div><br />';
        }
      }
  ?>
  <center><hr />
    <i>Prea putine probleme? <a href="<?=$root2?>/inv.php">Compune-ti propria problema!</a></i>
  </center>
  </body>
</html>
