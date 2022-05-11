# RezProbleme
Platforma interactiva pentru probleme de informatica.

# Software necesar
 - Un server web cu suport PHP (ex. Apache);
 - Colectia de compilatoare GNU GCC;
 - Compilatorul DMD;
 - Un browser cu suport Javascript;
 - Nucleul Linux, pentru seccomp(2);
 - POSIX sh, pentru compilare.php;

# Configuratie
`gcc src/wrap.c -lseccomp -o wrap`

Mai intai, wrap.c face un whitelist cu toate syscall-urile acceptabile, apoi nu lasa anumite syscall-uri din a fi executate (ex stat, unlink)

`style.css` contine design-ul grafic al paginii,
`index.php` contine pagina in sine (bara, etc.),
`config.php` contine variabile aleatorii,
`inv.php` stocheaza codul pentru incarcarea problemelor noi,
`home.php` stocheaza pagina principala,
`compilare.php` contine pagina de rezolvare a problemelor,
...iar `probleme.php` face posibila afisarea listei de probleme.
