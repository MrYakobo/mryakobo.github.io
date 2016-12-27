#!/bin/sh
CWD="$(cd -P -- "$(dirname -- "$0")" && pwd -P)"
for d in $(find -maxdepth 1 -type d)
do
  cd $CWD
  #Do something, the directory is accessible with $d:
  cd $d
  php newindex.php > index.html
done