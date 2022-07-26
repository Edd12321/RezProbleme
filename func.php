<?php
function
dp_rank($nr_pb)
{
  if ($nr_pb < 50) {
    $rank = "<font color=\"green\">Incepator</font>";
  } else if ($nr_pb < 100) {
	$rank = "<font color=\"yellow\">Rezolvitor</font>";
  } else if ($nr_pb < 150) {
    $rank = "<font color=\"orange\">Bun</font>";
  } else if ($nr_pb < 200) {
    $rank = "<font color=\"red\">Informatician</font>";
  } else if ($nr_pb < 250) {
  	$rank = "<font color=\"blue\">Maestru</font>";
  }
  echo @$rank;
}

function
sort_solve($a, $b)
{
  $ca = count(scandir("profile/$a/sol"));
  $cb = count(scandir("profile/$b/sol"));

  if ($ca == $cb)
    return 0;

  return ($ca>$cb) ? -1 : 1;
}

