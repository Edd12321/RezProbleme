<?php
  session_start();
  include 'config.php';
?>

<!DOCTYPE HTML>
<html>
  <head>
    <link rel="stylesheet" href="/style.css">
    <style>
      textarea {
        max-width: 600px;
        min-width: 600px;

        max-height: 300px;
        min-height: 300px;
      }
    </style>
  </head>
  <body><div id="cutie" style="width:fit-content;padding:3px;">
    <h2>Creeaza o problema</h2>
    <div class="table">
      <form method="post">
        <div class="tr">
          <div class="td">
            <label for="titlu">
              <b>
                Titlu
              </b>
            </label>
          </td>
          <div class="td" id="pt2">
            <input required type="text" name="titlu">
            <br />
          </div>
        </div>
        <div class="tr">
          <div class="td">
            <label for="cerinta">
              <b>
                Cerinta
              </b>
            </label>
          </div>
          <div class="td" id="pt2">
            <textarea required name="cerinta"></textarea>
            <br />
          </div>
        </div>
        <div class="tr">
          <div class="td">
            <label for="exemplu">
              <b>
                Exemplu
              </b>
            </label>
          </div>
          <div class="td" id="pt2">
            <input required type="text" name="input" placeholder="Date de intrare">
            <br />
            <input required type="text" name="output" placeholder="Date de iesire">
            <br />
          </div>
        </div>
        <div class="tr">
          <div class="td">
            <b>
              Date verificare
            </b>
          </div>
          <div class="td" id="pt2">
            <div id="grd">
            <?php
              for ($i = 1; $i <= 10; ++$i) {
                echo "<div id=\"xyz\"><code>#$i";
                if ($i < 10)
                  echo '&ensp;';
                echo "</code>
                      <input type=\"text\" name=\"ex$i\"";
                  if ($i == 1)
                    echo ' required';
                  echo '><br /></div>';
                }
              ?>
            </div>
          </div>
        </div>
        <div class="tr">
          <div class="td">
            <b>
              Raspunsuri corecte
            </b>
          </div>
          <div class="td" id="pt2">
            <div id="grd">
            <?php
              for ($i = 1; $i <= 10; ++$i) {
                echo "<div id=\"xyz\"><code>#$i";
                if ($i < 10)
                  echo '&ensp;';
                echo "</code>
                      <input type=\"text\" name=\"rp$i\"";
                  if ($i == 1)
                    echo ' required';
                  echo '><br /></div>';
                }
            ?>
            </div>
          </div>
        </div>
        <button type="submit" class="button" id="button2">Trimite!</button>
      </form>
    </div></div>
    <?php
        if (isset($_POST)) {
          $unde = $root.'/comp/'.htmlspecialchars($_POST["titlu"]);
          if (is_dir($unde))
            goto anulare;
          mkdir($unde);
          mkdir("$unde/sol");

          $cer = "<a style=\"color:#cccccc;\">Problema a fost propusa de catre: <i>".$_COOKIE["nume"]."</i>.<br /></a>".
                  htmlspecialchars($_POST["cerinta"]).
                 '<br /><br />
                  <b>Exemple:</b>
                  <br />
                  Date de intrare:
                  <pre>'.
                    htmlspecialchars($_POST["input"]).
                 '</pre>
                  Date de iesire:
                  <pre>'.
                    htmlspecialchars($_POST["output"]).
                 '</pre>';
          file_put_contents("$unde/cerinta.html", @$cer);
          
          #Facem pagina de compilare accesibila.
          symlink('../../compilare.php', "$unde/compilare.php");

          mkdir("$unde/sol/date");
          mkdir("$unde/sol/corect");

          file_put_contents("$unde/sol/num.txt", '0');

          for ($i = 1; $i <= 10; ++$i) {
            if (isset($_POST["ex$i"]) && isset($_POST["rp$i"])) {
              file_put_contents("$unde/sol/date/$i.txt", $_POST["ex$i"]);
              file_put_contents("$unde/sol/corect/$i.txt", $_POST["rp$i"]);
            }
          }
        }
anulare:
    ?>

  </body>
</html>
