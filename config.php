<?php
  #                  __ _               _           
  #  ___ ___  _ __  / _(_) __ _   _ __ | |__  _ __  
  # / __/ _ \| '_ \| |_| |/ _` | | '_ \| '_ \| '_ \ 
  #| (_| (_) | | | |  _| | (_| |_| |_) | | | | |_) |
  # \___\___/|_| |_|_| |_|\__, (_) .__/|_| |_| .__/ 
  #                       |___/  |_|         |_|    
  session_start();

  $pwd = getcwd();
  $bpwd = basename($pwd);
  
  $root = realpath(__DIR__);

  #Compilatoare
  $_SERVER['cc'] = 'gcc';
  $_SERVER['cxx'] = 'g++';
  $_SERVER['dc'] = 'dmd';
  $_SERVER['py'] = 'python';

  #Username temporar
  if (!isset($_SESSION["nume"])) {
    $_SESSION["nume"] = "Anonim";
  }  
?>
