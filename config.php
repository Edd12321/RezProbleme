<?php
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
