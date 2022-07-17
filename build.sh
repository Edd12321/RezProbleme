#!/bin/sh

gcc src/wrap.c -lseccomp -o wrap
g++ src/eso.cpp -o eso/bccvm
