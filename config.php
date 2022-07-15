<?php
  #                  __ _               _           
  #  ___ ___  _ __  / _(_) __ _   _ __ | |__  _ __  
  # / __/ _ \| '_ \| |_| |/ _` | | '_ \| '_ \| '_ \ 
  #| (_| (_) | | | |  _| | (_| |_| |_) | | | | |_) |
  # \___\___/|_| |_|_| |_|\__, (_) .__/|_| |_| .__/ 
  #                       |___/  |_|         |_|    
  if (!isset($_SESSION)) { 
    session_start(); 
  } 

  ini_set('display_errors', 0);
  error_reporting(E_ERROR | E_WARNING | E_PARSE); 

  $pwd = getcwd();
  $bpwd = basename($pwd);
  
  $root = realpath(__DIR__);

  #SCHIMBA ASTA DACA INDEX.PHP NU SE AFLA IN FOLDERUL RADACINA !!
  $root2 = "";

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
