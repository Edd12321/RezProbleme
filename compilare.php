<?php
  #Folosim config.php

  session_start();
  include __DIR__ . '/config.php'; 
?>
<html>
  <head>
    <link rel="stylesheet" href="/style.css">
    <style>
      select, textarea {
        width: 100%;

-webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
        box-sizing: border-box;
      }
      textarea {
        height: 300px;
        resize: vertical;
      }
      table {
        border-collapse: collapse;
      }
    </style>
  </head>
  <body>
    <h2>
      Problema <?php echo $bpwd; ?>
    </h2>
    <!--Cutia de text in care se trimite codul-->
    <div id="cutie">
      <b>Cerinta</b>
      <div id="cerinta">
        <?php echo file_get_contents('cerinta.html'); ?>
      </div>
    </div>
    <br />
    <div id="cutie">
      <b>Solutii trimise</b>
      <div id="cerinta">
        <?php
          $solutii = scandir("sol");
          foreach($solutii as $solutie) {
            if (!is_dir('sol/'.$solutie) && $solutie != 'num.txt') {
              $linie = file('sol/'.$solutie)[0];
              echo "<a href=\"sol/$solutie\">".$solutie."</a><b> $linie</b>".'<br />';
            }
          }
          #Lista tuturor solutiilor
        ?>
      </div>
    </div>
    <br />
    <div id="cutie">
      <!--Titlul "ferestrei"-->
      <b>Incarcare solutie</b>
      <form method="post" name="cod">
        <textarea name="solutie"></textarea>
        <select method="post" name="lang">
          <option value="cpp">C++</option>
          <option value="c">C</option>
          <option value="d">D</option>
        </select>
        <br />
        <button type="submit" class="button">Trimite!</input>
      </form>
    </div>
    <br />
    <div id="cutie" style="width:fit-content;
                           min-width:100px">
    <b>I/O Standard</b><div id="cerinta"><table border="1px solid">
    <?php

      #Nu vrem un singur ./a.out, pot fi mai multi utilizatori
      #care incarca in acelasi timp !!!
      $num = file_get_contents('sol/num.txt');
      ++$num;
      file_put_contents('sol/num.txt', @$num);

      $fn = $num;

      #Fallback C++  
      $COMPILATOR = $_SERVER['cxx'];
      $EXTENSIE = '.cpp';

      if (isset($_POST['lang'])) {
        switch($_POST['lang']) {
        case 'c':
          $COMPILATOR = $_SERVER['cc'].'-o '.$fn;
          $EXTENSIE = '.c';
          break;
        case 'cpp':
          $COMPILATOR = $_SERVER['cxx'].' -o '.$fn;
          $EXTENSIE = '.cpp';
          break;
        case 'd':
          $COMPILATOR = $_SERVER['dc'].' -of='.$fn;
          $EXTENSIE = '.d';
          break;
        }

        $fn = './' . $fn;

        #Mergem in directorul de solutii pt. problema.
        mkdir('sol');
        chdir('sol');

        #Compilam pe server... 
        file_put_contents($num.$EXTENSIE, $_POST['solutie']);
        shell_exec($COMPILATOR.' '.$num.$EXTENSIE);

        $date = scandir("date");

        $corecte = 0;
        $totale = 0;

        if ($date) {
          foreach ($date as $io) {
            if (!is_dir($io)) {
              $continut = file_get_contents('date/'.$io);
              $corect   = trim(file_get_contents('corect/'.$io));

              #Stergem spatiile albe.

              preg_replace('/[0-9][A-z] .', '', $corect);

              echo '<tr>
                      <td>'.
                        htmlspecialchars($continut).
                     '</td>
                      <td>'.
                        htmlspecialchars($corect).
                     '</td>
                      <td>';
              #Executam dintr-un pipe.
              $rez = trim(shell_exec('echo "'.$continut.'"|'.$root.'/wrap '.$fn));
              echo htmlspecialchars($rez).
                  '</td>
                   <td>';
              ++$totale;
              if (!strcmp($rez, $corect)) {
                ++$corecte;
                echo '✅';
              } else echo '❌';
              echo '</td></tr>';
              #Afisam orderou de evaluare
            }
          }
        }

        #Stergem binarele rezultate dupa compilare.
        unlink($fn);
        $var = file_get_contents($num.$EXTENSIE);
        $var = '// '.$corecte.'/'.$totale.', '.$_COOKIE["nume"].PHP_EOL.$var;
        file_put_contents($num.$EXTENSIE, $var);

        #Ne intoarcem de unde am plecat.
        chdir('..');
      }
    ?>
  </table></div></div>
  </body>
</html>
