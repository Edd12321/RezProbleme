<?php
#################################
# IMPLEMENTARE SIMPLA IDENTICON #
#################################
session_start();

function
get_identicon($text)
{
	# Calculam hash-ul textului.
	$hash = hash("sha3-512", $text);

	# Culoarea este determinata de ultimii 3 octeti
	$rgb = '#';
	for ($k = 61; $k <= 63; ++$k) {
		if (ord($hash[$k]) > 255)
			$hash[$k] = chr(25);
		$rgb .= dechex(ord($hash[$k]));
	}

	for ($i = 1; $i <= 10; ++$i)
		for ($j = 1; $j <= 5; ++$j)
			(int)$hash[$i*$j] & 1 ? $mat[$i][$j] = '██' : $mat[$i][$j] = '▒▒';

	echo "<div class=\"iden\" style=\"color:$rgb;\">";
	for ($i = 1; $i <= 10; ++$i) {
		for ($j = 1; $j <= 5; ++$j)
			echo $mat[$i][$j];
		for ($j = 5; $j >= 1; --$j)
			echo $mat[$i][$j];
		echo "<br />";
	}
	echo "</div>";
}
