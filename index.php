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
      #cal {
        background-color: #d6f0aa;
        border: 2px solid #d4e8a9
        width: 100px;
      }
    </style>
  </head>
  <body>
  <h1><center>Bine ati venit, <i><?php echo $_SESSION["nume"]; ?></i>!</center></h1>
    <h2>Noutati</h2><table>
    <?php
      $k2 = $k = 0;
      #Afisare "blog"
      $f = fopen("bl.csv", "r");
      while (($linie = fgetcsv($f)) !== false) {
        echo '<tr>';
        foreach($linie as $cel) {
          echo '<td>';
          if ($k2)
            echo '<div id="postare">' . $cel . '</div>';
          else if ($k) {
            #Reprezentare grafica a datei
            echo '<div id="cal">' . $cel[0] . $cel[1] . ', ' .
                                    $cel[3] . $cel[4] . '<h2 style="margin:0px;"><center>
                                ' . $cel[6] . $cel[7] . 
                                    '</center></h2></div>';
          }
          echo '</td>';
          if ($k2)
            $k2 = 0;
          else $k2 = 1;
        }
        echo '</tr>';
        ++$k;
      }
  ?></table>
</html>
