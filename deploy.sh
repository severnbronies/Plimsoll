#!/usr/bin/env bash

rsync -av \
      --exclude 'bin/' \
      --exclude 'docs/' \
      --exclude 'gulpfiles/' \
      --exclude 'node_modules/' \
      --exclude 'src/' \
      * \
      querkmachine@berly.kim:webapps/severnbronies_2020/wp-content/themes/plimsoll/