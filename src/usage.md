# How to get Usage from WP Engine, without the API

- Once we have a CSV of sites/installs at WP Engine, we can then make a list of installs

```bash
awk -F "\"*,\"*" '{print $6}' wpesites.csv > installs.txt 
```

- Then we can get usage stats from WP Engine by opening a Chrome window that's already logged into my.wpengine.com

```bash
./getusage.sh
```

This will download a bunch of CSV files to the ./csvs folder 