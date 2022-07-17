# bccvm
bccvm is a <del>procedural</del> two-dimensional stack-based esoteric programming language, inspired by Befunge98, ><> and Forth. All programs written in bccvm are stored on a 2D plane/grid, and they are navigated through using arrow operators.

For instance, this is a valid bccvm program, that loops ad infinitum:
```
#!/usr/bin/bccvm
>v
^<
```

...same for this, program that takes a number as input and prints its square to the screen:
```
#!/usr/bin/bccvm
vveeeeeeeeeeeeeeeeeeeeeeeee"Please enter an integer: "<
>                                                     ^
 >&:*$@
```
