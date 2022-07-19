# bccvm
bccvm este un limbaj ezoteric de programare, inspirat de catre Befunge98, ><> si Forth. Toate programele scrise in bccvm sunt stocate pe un "plan 2D", instructiunile manipuland stiva/schimband pozitia instruction pointer-ului.

De exemplu, acesta poate fi considerat un program valid BCCVM (loop infinit):
```
#!/usr/bin/bccvm
>v
^<
```

...si acesta poate fi considerat un program valid, care calculeaza patratul unui numar citit de la tastatura.
```
#!/usr/bin/bccvm
vveeeeeeeeeeeeeeeeeeeeeeeee"Please enter an integer: "<
>                                                     ^
 >&:*$@
```

Puteti gasi multe alte exemple in folder-ul "examples"...
