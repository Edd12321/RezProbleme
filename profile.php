<?php
  if (!isset($_SESSION)) {
    session_start();
  }

  require "../../config.php";
  require "../../navbar.php";

  ini_set('display_errors', 0);
  error_reporting(E_ERROR | E_WARNING | E_PARSE);

  $nr_pb = count(scandir("sol"))-2;

  if ($nr_pb < 50) {
    $rank = "<font color=\"green\">Incepator</font>";
  } else if ($nr_pb < 100) {
	$rank = "<font color=\"yellow\">Rezolvitor</font>";
  } else if ($nr_pb < 150) {
	$rank = "<font color=\"orange\">Bun</font>";
  } else if ($nr_pb < 200) {
    $rank = "<font color=\"red\">Informatician</font>";
  } else if ($nr_pb < 250) {
  	$rank = "<font color=\"blue\">Maestru</font>";
  }
?>

<!DOCTYPE HTML>
<html>
  <head>
    <link rel="stylesheet" href="<?=$root2?>/style.css">
    <style>
      span {
        display:flex;
      }
      span div {
		margin:  3px;
		padding: 3px;
      }

      #pt1 {
        width: 30vw;
      }

      input {
        position: relative;
        bottom: 7px;
      }

      @media only screen and (max-device-width: 800px) {
        #pt1 {
          width: 100%;
        }
      }
    </style>
  </head>
  <body>

    <span>
      <div id="pt1">
        <center>
          <div id="box">
            <div id="box_text">
              <?php
                require "../../identicon.php";
                echo get_identicon(basename(realpath('.')));
               ?>
            </div>
          </div>
        </center>
        <div id="box" style="width:100%;">
          <center>
            <h2><?=basename(realpath('.'))?></h2>
            <?php
              # Afisam bio-ul profilului
              if (basename(realpath('.')) == $_SESSION["nume"]) {
                echo "<form method=\"post\">
                        <input type=\"text\" name=\"bio\" placeholder=\"".file_get_contents("bio.txt")."\"></input>
                        <input type=\"submit\" hidden />
                      </form>";
                if (!empty($_POST["bio"])) {
                    @file_put_contents("bio.txt", $_POST["bio"]);
                }
              } else {
                echo "<i>".file_get_contents("bio.txt")."</i>";
              }
             ?>
          </center>
        </div>
        <br />
        <div id="box" style="width:100%;height:100%;">
          <b>Solutii trimise: <?=$nr_pb?></b>
            <hr />
          <b>Data crearii contului: <?=date("F d, Y @H:i:s.",filemtime('.'))?></b>
            <hr />
          <b>Grad: <?=$rank?></b>
            <hr />
        </div>
      </div>
      <div>
      <div id="box" style="width:65vw;">
         <b>Solutii</b>
         <div id="box_text" style="height:85%";>
          <?php
            $sol     = array_splice(scandir("sol"), 2);
            $s_total = count($sol);
            $g       = 0;

			# Sortam solutiile in functie de data lor de incarcare utilizand o func. lambda
			usort($sol, function
				        ($x,$y)
			            {
			                return filemtime("sol/$y")-filemtime("sol/$x");	
			            });

			# Incepem cu cele mai noi solutii
			array_reverse($sol);

			# Afisam solutiile
            foreach($sol as $solutie) {	
			  ++$g;

              # Locatia solutiei
              $path_solutie = readlink("sol/$solutie");

              # Titlul problemei
              $titlu_problema = basename(dirname($path_solutie, 2));

              # Solutia (client-path)
              $fisr_solutie = "$root2/x/y/z/$path_solutie";

              # Solutia (server-path)
              $fis2_solutie = "$root/comp/$titlu_problema/sol/".basename($path_solutie);

               #################################
               # AFISAM DATA SI ORA REZOLVARII #
               #################################
              echo date("F d, Y @H:i:s", filemtime($fis2_solutie)).' ';

               ###########################
               # AFISAM TITLUL PROBLEMEI #               
               ###########################
              echo "<b>Problema $titlu_problema: </b>";

               ############################
               # AFISAM SOLUTIA PROBLEMEI #
               ############################
              echo "<a href=\"$fisr_solutie\">".basename($path_solutie)."</a>";
              if ($g < $s_total)
                echo "<hr />";
            }
           ?>
          </div>
        </div>
      </div>
    </span>

  </body>
</html>
