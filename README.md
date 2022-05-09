# RezProbleme
Platforma interactiva pentru probleme de informatica.

# Software necesar
 - Un server web cu suport PHP (ex. Apache);
 - Colectia de compilatoare GNU GCC;
 - Compilatorul DMD;
 - Un browser cu suport Javascript;
 - Nucleul Linux, pentru seccomp(2);

# Configuratie
`gcc src/wrap.c -lseccomp -o wrap`

Pasul acesta este necesar deoarece binara finala _wrap_ va avea rolul unui filtru pentru codul trimis de catre utilizatori. Asa, ne asiguram ca rezolvitorii sa nu poate sa strice serverul pe care ruleaza site-ul apeland alte syscall-uri in afara de `read`, `write`, `exit` si `rt_sigreturn`.

`style.css` contine design-ul grafic al paginii,
`index.php` contine pagina in sine (bara, etc.),
`config.php` contine variabile aleatorii,
`inv.php` stocheaza codul pentru incarcarea problemelor noi,
`home.php` stocheaza pagina principala,
`compilare.php` contine pagina de rezolvare a problemelor,
...iar `probleme.php` face posibila afisarea listei de probleme.
