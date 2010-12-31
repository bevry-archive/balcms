# Welcome to BalCMS!

**[BalCMS](http://www.balupton.com/projects/balcms)** is a [Zend Framework](http://framework.zend.com/) and [Doctrine ORM](http://www.doctrine-project.org/) powered [CMS](http://en.wikipedia.org/wiki/Cms).


### Difference

BalCMS is different from other CMS's as we can extend it directly by just adding a new module - or even by just modifying the CMS directly (as the CMS is merely a module and a series of dependencies). No other CMS that I know of actually allows developers to extend the CMS so easily and yet directly, usually you are locked into specific and limited plugin framework - which really sucks balls if you are trying to build a scalable and extendable CMS for custom applications. As such, if you don't like something about BalCMS or need to add new functionality you can get in there directly and do it! Think of it more as a foundation rather than a lock-in. It's liberating! BalCMS is also highly opinionated software, it follows the best practices religiously.


### Features

- i18n (Localisation)
- Multiple Users (and permissions for multiple users) / Access Control Lists
- Widgets
- Content Caching
- Themes
- Modules
- JavaScript and CSS Bundling
- Scaffold for CSS (SASS like Syntax for CSS)
- Automatic and Dynamic Image Resizing and Compression



## Before you Start


### The License

- BalCMS is licensed under the [New BSD License](https://github.com/balupton/balcms/raw/master/licenses/COPYING.txt).


### Note on Command Line Dependence

BalCMS is heavily dependent on the command line. If you are on a Unix/Mac/Linux platform you will find the installation and usage quite straightforward. If you are on a Windows platform, you may face quite a learning curve (and require to run commands through the Cygwin Terminal) - we suggest getting a mac.

There will never be a front end gui to replace the dependency on the command line, as we view this dependency as justified to be a best practice. Once you get familiar with it, you whizz by. Now that is empowering.


### Requirements / Dependencies

For Windows you will need to install:

- unix commands - http://www.cygwin.com/setup.exe
- git - http://git-scm.com/download
- zend server - http://www.zend.com/en/products/server-ce/downloads
- mysql server - http://www.mysql.com/downloads/mysql/
- mysql workbench - http://www.mysql.com/downloads/workbench/

For Unix/Mac/Linux you will need to install:

- git - http://git-scm.com/download
- zend server - http://www.zend.com/en/products/server-ce/downloads
- mysql server - http://www.mysql.com/downloads/mysql/
- mysql workbench - http://www.mysql.com/downloads/workbench/

These installations will provide you with the following requirements:

- curl
- chmod
- git
- php
- apache
- sqlite
- mysql


## Creating a New BalCMS Website

1.	Create a new git repository for your server on GitHub.

2.	Run the following commands:
		
		mkdir mywebsite
		cd mywebsite
		curl -OL http://github.com/balupton/balcms/raw/master/Makefile
		make init
		make configure
		make install
		git remote add origin {your git repos read/write uri} ;
		make deploy

3.	Visit your new BalCMS Website.


## Committing your Changes

1. Run the following commands:
		
		cd mywebsite
		git add -u
		git status (note: you will need to see which files need to be added, and use [git add {file}])
		git commit -m "My Changes... {this is your message}"
		git push origin --all
	

## Pushing your Changes to the Live Site

1. Run the following commands:
		
		cd mywebsite
		make deploy
		

## Upgrading your BalCMS Version

1. Run the following commands:
		
		cd mywebsite
		make update
		
