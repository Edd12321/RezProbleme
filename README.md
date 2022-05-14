# RezProbleme
Platforma interactiva & modulara pentru probleme de informatica.

# Software necesar
 - Un server web cu suport PHP (ex. Apache);
 - Colectia de compilatoare GNU GCC;
 - Compilatorul DMD;
 - Un browser cu suport Javascript;
 - Nucleul Linux, pentru seccomp(2);
 - libseccomp
 - POSIX sh, pentru compilare.php;

# Configuratie
`gcc src/wrap.c -lseccomp -o wrap`

Mai intai, wrap.c face un whitelist cu toate syscall-urile acceptabile, apoi nu lasa anumite syscall-uri din a fi executate (ex stat, unlink)

`wrap.c` este un filtru pentru a evita executarea de cod arbitrar.

`bl.csv` este un istoric al modificarilor majore al proiectului

`style.css` contine design-ul grafic al paginii,

`index.php` contine pagina in sine (bara, etc.),

`config.php` contine variabile aleatorii,

`inv.php` stocheaza codul pentru incarcarea problemelor noi,

`home.php` stocheaza pagina principala,

`compilare.php` contine pagina de rezolvare a problemelor,

...iar `probleme.php` face posibila afisarea listei de probleme.

# Utilitate
Scopul proiectului este de a-ti putea personaliza cu usurinta codul care ruleaza pe server:

Proiectul poate fi rulat pe un server local, pentru o metoda rapida de a puncta probleme de informatica fara conturi, scor, etc.

Poate fi utilizat de catre cadre didactice ca o alternativa modulara la alte platforme asemanatoare. Adaugarea unui limbaj nou, de exemplu, se poate face modificand doar un rand in config.php, apoi adaugand o optiune noua in switch case-ul din compilare.php.

Un alt exemplu de modularitate este fisierul wrap.c: puteti adauga doar numele un element nou in vectorul blocare[], si syscall-ul respectiv va fi filtrat in mod automat din orice solutie trimisa de catre utiizator.
