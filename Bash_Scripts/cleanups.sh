#!/usr/bin/env bash

cleanUp() {
  shopt -s nullglob
  files=($1)
  filesCount=${#files[@]}
  echo "$2 before count: $filesCount."
  if [ $filesCount -gt 7 ]; then
    rm -f "$(ls -1 $1 | head -1)"
  fi
  afterFiles=($1)
  afterFilesCount=${#afterFiles[@]}
  echo "$2 after count: $afterFilesCount."
}

# RUN FUNCTIONS:
cleanUp "/{DIRECTORY}/*.{FILE_EXT}" "{OPTIONAL_NAME}"
