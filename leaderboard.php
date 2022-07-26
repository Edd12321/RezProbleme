<?php
 include "config.php";
 include "navbar.php";
 include "identicon.php";
 include "func.php"
?>

<html>
  <head>
    <link rel="stylesheet" href=<?="$root2/style.css"?>>
    <style>
      .iden {
        font-size: 1.7px;
        font-family: monospace;
        line-height: 1;
      }
      td, th {
        border: 2px solid #ccc;
        padding: 5px;
      }
      th {
        background-color: #ddd;
      }
      table {
        border-collapse: collapse;
        width: 100%;
      }
      .util_wrap * {
        display: inline-block;
      }
      .list_wrap {
      }
    </style>
  </head>
  <body>
    <h1>
      Cei mai harnici rezolvitori
    </h1>
    <!-----LIST BEGIN----->
    <table class="list_wrap"><tbody>
    
    <tr>
    <th width=10>Nr.crt</th>
    <th>Nume de utilizator</th>
    <th width=100>Solutii trimise</th>
    <th>Grad</th>
    </tr>
<?php
  $utilizatori = array_splice(scandir("profile"), 2);
  # Sortam utilizatorii in functie de nr. de pb rezolvate ...
  usort($utilizatori, "sort_solve");
  
  $k = 0;
  foreach ($utilizatori as $utilizator) {
    # Urmatorul rank  
    ++$k;
    echo "<tr>";
  
     ########################
     ## Afisam clasamentul ##
     ########################
    echo "<td>";
    $rank = "black";

    # Premiantii+Mentiuni
    if ($k <= 3) {
      echo '🏆';
      switch($k) {
      case 1: #gold
        $rank = "orange";
        break;
      case 2: #silver
        $rank = "gray";
        break;
      case 3: #bronze
        $rank = "brown";
        break;
      }
    } else if ($k <= 8) /**k-3<=5 |+3**/ {
      $rank = "green";
    }

    # Mentiunile
    echo "<font color=\"$rank\">#$k</font>";
    echo "</td>";
    
     ###################################
     ## Afisam numele si identicon-ul ##
     ###################################
    echo '<td>
          <span class="util_wrap">';
    get_identicon($utilizator);
    echo "<b>&nbsp;<a href=\"profile/$utilizator\">$utilizator</a></b>
          </span>
          </td>";

     ############################################
     ## Vedem cate probleme a rezolvat fiecare ##
   ############################################
  $nr_pb = count(scandir("profile/$utilizator/sol"))-2;
    echo "<td>$nr_pb</td>";

     ###################
     ## Afisam gradul ##
     ###################
  echo "<td>";
  dp_rank($nr_pb);
  echo "</td>";

    echo "</tr>";
  }
 ?>
  </tbody></table>
    <br />
  <!-----LIST END----->
  (Pe aceasta lista sunt afisati toti utilizatorii site-ului...)
    <br />
    Crezi ca poti fi urmatorul campion informatic? <a href="probleme.php">Testeaza-ti cunostiintele!</a>
  </body>
</html>
