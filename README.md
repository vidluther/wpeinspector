# WPE Inspector
WP Engine Inspector 

## What is it? 

This is a set of scripts that will give us insight into what's going on within our account at WP Engine. 


### What it does
This builds a CSV of sites that my account has access to, and all the installs as well. 

- Show me a list of all the sites I have hosted at WP Engine and it's details
- Site Details meaning 
    - Site Id 
    - Site Name
    - The Account under which this site belongs 
- Installs under the site
    - install name
    - install environment
    - install cname
    - primary domain if any,associated with this install
    - php version 
    - is this a multi site?

**A site at WP Engine can be a collection of 3 installs, you may call it a group, or a project for all I care, WPE calls it a site**
**An install, is a specific instance of WordPress at WP Engine**

### What's missing? 

I would love to have the following information. 


- Instead of outputting to my terminal in a CSV format, this should update a Google Sheet automatically. 
- Automatically generate a list of sites I should be monitoring based on if environment is production, and what the primary domain is.
- Dockerize this.. cuz it's 2021 
- storage used per install (hopefully, WPE will expose this via API soon)
- bandwidth used per install (hopefully, WPE will expose this via API soon)
- visits per install (hopefully, WPE will expose this via API soon)

## How does it do it? 

It uses the [WP Engine API](https://wpengineapi.com/reference) , strips out all the useless UI/Chrome of the my.wpengine.com control panel and gives us things we need
to know about at WP Engine. 

## Why? 

Because I can't be the only one who has run into the following questions..

- WP Engine is saying I'm over my disk quota.. how TF did that happen?
    - [The Plan Usage](https://my.wpengine.com/plan_usage#/Details) page is a start, but I need more details.
- I need to figure out if I'm reselling/charging my clients the right amount of money based on their actual usage.
- I need to know if I'm actually making a profit from my Agency plan
- I need a comprehensive list of sites I need to be monitoring uptime for.
- Eventually, I need similar information from FlyWheel, and Pressable, and possibly the next WPaaS du jour

## How do I make it work for me?

This assumes you have composer installed and working on your system.

- Clone the repo
- cd cloned_repo_directory/src
- composer install
- php index.php > foo.csv 
- open your CSV and wonder what you can do with that data.