<?php
include __DIR__."/config.php";
session_start();

function
real_path($fisier)
{
  return is_link($fisier)? readlink($fisier) : $fisier; 
}

#Numele script-ului
$script=real_path($_SERVER["SCRIPT_FILENAME"]);
$script=basename($script,".php");
?>

<html>
<head>
<style>
  #pagina {
        color: #fff;
        background: url('<?php $v = array_slice(scandir(__DIR__."/res"), 2); echo "$root2/res/".$v[array_rand($v)];?>');
        height: 300px;
        background-attachment: fixed;
        position: relative;
  }
  
  #pagina i {
    font-size: 30px;
    position: absolute;
    bottom: 0;
    font-weight: 200;
  }
    
  html, body {
    margin: 0;
  }

  #bdiv {
    background-color: #ddd;
  }

  .wrapper {
    background-color: #fff;
    display: block;

    width: 95%;
    min-height: 100vh;
    padding: 10px;
    margin: 0 auto;

    box-shadow: 2px 2px 4px #ccc;
  }

  @media only screen and (max-device-width:800px) {
    .wrapper {
      width: 98%;
	}
	ul li {
	  font-size: 13px;
	}
  }
</style>
<link rel="stylesheet" href=<?="$root2/dark.css"?> />

<!--Modificam afisarea pt mobil-->
<meta name="viewport" content="width=device,width,
                               initial-scale=1,
                               maximum-scale=0.80,
                               minimum-scale=0.80,
                               user-scalable=no,
                               user-scrollable=no,
                               minimal-ui" />
<link rel="icon" type="x-image/icon" href=<?="$root2/favicon.ico"?> />
<title>RezProbleme</title>

<link rel="stylesheet" href=<?="$root2/dark.css" ?> />
<link rel="stylesheet" href=<?="$root2/style.css"?> />

</head>
<body style="position:relative">

<!--Merge si fara JS, aici este doar un bonus!-->
<script src="<?=$root2?>/extra.js"></script>
<input autocomplete="off" type="checkbox" id="cbox1" onclick="kmode();" style="top:0 !important;
                                                                               right:0;
                                                                               z-index:999999999;
                                                                               height: 10;
                                                                               position:fixed;"/>

<div id="bdiv">
<ul>
  <li>
    <a href=<?="$root2/index.php"?>
      <?php
        if ($script == "index")
          echo ' class="curent" ';
       ?>
    >
      Acasa
    </a>
  </li>
  <li>
    <a href=<?="$root2/probleme.php"?>
      <?php
        if ($script == "probleme"
        ||  $script == "compilare")
          echo ' class="curent" ';
       ?>
    >
      Probleme
    </a>
  </li>
  <li>
    <a href=<?="$root2/inv.php"?>
      <?php
        if ($script == "inv")
          echo ' class="curent" ';
       ?>
    >
      Compune
    </a>
  </li>
  <span style="float:right;">
    <li>
      <a href=<?="$root2/leaderboard.php"?>
        <?php
          if ($script == "leaderboard")
            echo ' class="curent" ';
         ?>>Leaderboard</a>
    </li>
    <li>
      <a href=<?="$root2/auth.php"?>
        <?php
          if ($script == "auth")
            echo ' class="curent" ';
         ?>>
        <?php
          if ($_SESSION["nume"] == "Anonim")
            echo "Autentificare";
          else
            echo $_SESSION["nume"];
         ?>
      </a>
    </li>
    <li style="background:#222;">
      <?php
        if ($_SESSION["nume"] != "Anonim")
          echo "<a href=\"$root2/profile/".$_SESSION["nume"]."\">Profil</a>";
       ?>
	</li>
  </span>
</ul>

<div id="pagina">
  <i>RezProbleme</i>
</div>
<br />
<div class="wrapper">
<!--[...]includem din alte fisiere-->
