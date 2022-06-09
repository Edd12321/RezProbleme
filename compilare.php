<?php
  #Folosim config.php

  session_start();
  include __DIR__ . '/config.php'; 
?>
<html>
  <head>
    <link rel="stylesheet" href=<?php echo "$root2/style.css";?>>
    <style>
      select, textarea {
        width: 100%;
        resize: vertical;

-webkit-box-sizing: border-box;
   -moz-box-sizing: border-box;
        box-sizing: border-box;
      }
      table {
        border-collapse: collapse;
      }
      hr {
        width: 100%;
      }
      #cutie {
        width: 100%;
      }
      textarea {
        height: 300px;
      }
    </style>
  </head>
  <body>
    <?php
      $title = 'Problema '.$bpwd;
      echo "<h2>$title</h2><title>$title - RezProbleme</title>";
    ?>
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
          #Ordine numerica, nu lexicografica.
          natsort($solutii);
          #Mai intai primele solutii...
          $solutii = array_reverse($solutii);

          #Scadem fisierele/folderele: ".", "..", "num.txt", "date" si "corecte".
          $oo = count($solutii) - 5;
          $i = 0;

          foreach($solutii as $solutie) {
            if (!is_dir('sol/'.$solutie) && $solutie != 'num.txt') {
              ++$i;
              $linie = file('sol/'.$solutie)[0];
              echo "<a href=\"sol/$solutie\">".$solutie."</a><b> $linie</b>".'<br />';

              #Am ajuns la ultima solutie?
              if ($i < $oo)
                echo '<hr />';
              #Nu mai afisam <hr>!
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
          <option value="py">Python</option>
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
      #Fallback C++
      $COMPILATOR = $_SERVER['cxx'];
      $EXTENSIE = '.cpp';

      #Alegem limbajul care va fi utilizat.
      if (isset($_POST['lang'])) {
        $num = file_get_contents('sol/num.txt');
        ++$num;
        file_put_contents('sol/num.txt', @$num);

        #Copie $num pt a fi folosit cu extensie.
        $fn = $num;

        #Limbajele/compilatoarele sunt definite in CONFIG.PHP !!

        $INTERP = "";
        $COMM = "//";

        switch($_POST['lang']) {
        case 'c':
          $COMPILATOR = $_SERVER['cc'].' -o '.$fn;
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
        case 'py':
          $INTERP = "#!/usr/bin/python".PHP_EOL;
          $COMM = "#";
          $EXTENSIE = '.py';
        }

        $fn = './' . $fn;

        #Mergem in directorul de solutii pt. problema.
        mkdir('sol');
        chdir('sol');

        #Compilam pe server... 
        if ($INTERP != "") {
          $fn .= $EXTENSIE;
          file_put_contents($fn, $INTERP.$_POST['solutie']);

          #facem executabil
          chmod($fn, 0777);
        } else {
          file_put_contents($num.$EXTENSIE, $_POST['solutie']);
          shell_exec($COMPILATOR.' '.$num.$EXTENSIE);
        }

        $date = scandir("date");

        #Punctajul este un string definit ca "$corecte/$totale".
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
              $timpInceput = floor(microtime(true) * 100);
              #Executam dintr-un pipe, in "wrap" (pentru a evita executarea de cod arbitrar).
              $rez = trim(shell_exec('echo "'.$continut.'"|'.$root.'/wrap '.$fn));
              $timpFinal = floor(microtime(true) * 100) - $timpInceput;
              echo htmlspecialchars($rez).
                  '</td>
                   <td>';
              ++$totale;
              if (!strcmp($rez, $corect) && $timpFinal <= 107) {
                ++$corecte;
                echo '✅';
              } else echo '❌';
              echo '~'.$timpFinal.'ms</td></tr>';
              #Afisam borderoul de evaluare.
            }
          }
        }

        if ($INTERP == "") {
          #Stergem binarele rezultate dupa compilare.
          unlink($fn);
        }
        $var = file_get_contents($num.$EXTENSIE);
        $var = $COMM.' '.$corecte.'/'.$totale.', '.$_SESSION["nume"].PHP_EOL.$var;
        file_put_contents($num.$EXTENSIE, $var);

        #Ne intoarcem de unde am plecat.
        chdir('..');
      }
    ?>
  </table></div></div>
  </body>
</html>
