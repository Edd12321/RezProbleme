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

  $_SERVER['cc'] = 'gcc';
  $_SERVER['cxx'] = 'g++';
  $_SERVER['dc'] = 'dmd';

  if (!isset($_COOKIE["nume"])) {
    setcookie("nume", "Anonim", 0, "/");
  }  
?>
