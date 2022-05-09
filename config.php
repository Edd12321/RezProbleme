<?php
  session_start();

  $pwd = getcwd();
  $bpwd = basename($pwd);
  
  $root = realpath(__DIR__);

  $_SERVER['cc'] = 'gcc';
  $_SERVER['cxx'] = 'g++';

  if (!isset($nume))
    $nume = "Anonim";
?>
