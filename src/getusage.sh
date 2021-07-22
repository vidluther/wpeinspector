#!/bin/bash
## Based on email sent by Bryce, using a hack get usage stats from
## my.wpengine.com/site/install

## Assume the list of installs is in a file called installs.txt and then loop through it.

cat installs.txt | while read install
do
   # do something with $line here
   #echo $install
   /usr/bin/open -a "/Applications/Google Chrome.app" https\:\/\/my\.wpengine\.com\/installs\/$install\/usage_stats;
done
