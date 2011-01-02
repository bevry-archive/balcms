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
- make
- git
- php
- apache
- sqlite
- mysql


## Creating a New BalCMS Website

1.	Run the following commands:
		
		mkdir mywebsite
		cd mywebsite
		curl -OL http://github.com/balupton/balcms/raw/master/Makefile
		make init-new; make configure; make install

	> Explanation: What we are doing here is creating our new website directory (folder), then fetching a Makefile. A Makefile is a index of a series of instructions we can run. Having this file, we can then run `make init-new; make configure; make install` - this command is actually three separate commands (as denominated by the `;` symbol). The `make init-new` initialises our local repository (as a new repository), and grabs the core of the CMS. We then run `make configure` which fetches the CMS's dependencies and requirements and configures the directory structure. Finally the `make install` installs the CMS's database, adjusts the permissions and runs any cron jobs.

2.	While that is running, your website will need it's own Git Repository.
	You can create one on [GitHub](https://github.com) (if you have a paid account), or [you can find an alternative private git host](http://stackoverflow.com/questions/109440/best-git-repository-hosting-for-commercial-project).

3.	One those commands have run, and your remote git repository is set up. We want to associate our local repository with the remote repository. We do this by copying our remote repository's read+write url, it should look something like this `git@github.com:balupton/balcms.git`. With that we will run the following commands:

		git remote add origin {your git repos read/write url} ; make deploy
	
	> Explanation: The second command here `make deploy` will send our changes from our development branch to our stable branch, then from the stable branch to the `master` branch. Finally, it'll then send all those changes to our remote repository.
	
	> We want to send our changes to the remote repository as that we can deploy to our remote server (where our website will actually be hosted and accessed). Other benefits are also in case our development environment crashes, we will have a remote backup. The last benefit and perhaps the best one, is that if we are working with other people, it allows us to all collaborate together seamlessly.

3.	Once all that is done, you'll now be able to visit your new BalCMS website. So lets navigate to our localhost and the directory we installed it in. Eg. `http://localhost/sites/mynewwebsite`.


## Configuring BalCMS

BalCMS has configuration files in the following locations:

	config.php - Used detect and set our environment (i.e. development, staging or production).
	application/
		config/
			application.yml - Used to specify the configuration for our environments.
			core.yml - Used to specify the paths that our environments will use.
			nav.yml - Used to specify navigation items used in our CMS.
			routes.yml - Used to specify how requests are directed in our CMS.

The files that you will be interested in are mainly `config.php` and `application.yml`, sometimes `nav.yml`, and hopefully you'll never have to touch `core.yml` and `routes.yml` - you will though if you are planning to write your own modules to extend BalCMS.

They either include inline documentation (docs inside them) or they are self explanatory. After you have modified your configuration files, you will want to run `make clean-config` to ensure that the configuration is applied correctly - we do try to autodetect, but pedanticness can come in handy.


## Committing your Changes

1.	To commit your changes, you'll want to run the following commands:
		
		cd mywebsite
		git status
		git add -u
		git status
		git add {the untracked files reported by the git status}
		git commit -m "My Changes... {this is your message}" (note: this commits your changes)
		git push origin --all (note: this sends your changes to the remote repository)
	
	> Explanation: What the `git status` does is show us the changes we have made, we use this the first time to check what changes are being made (so we can tell whether or not we want to make those changes). We can actually see the changes in detail by running `git diff`. We then add the files we want to the next commit by using `git add`. In the above example we use `git add -u` as that will save us a lot of typing, it automatically adds the changes to all tracked files (files that the git repository already knows about). After running the `git add -u`.


## Setting up the Live Server for Deployment of the Live Site

Setting up the live server can be done by either of the following two ways.

-	**Recommended Option:** SSH+Git. This option is purely awesome, it's speedy, simple, easy to use, and allows us to edit files on the remote server. Although, few servers support both SSH and Git (your server needs both) - but the benefits are massive. We recommend hosting with  [MediaTemple](http://mediatemple.net/) as they too are pure awesome, so they do support this pure awesome feature (their plans are also extremely cheap for what they offer, support is fantastic, and their system is extremely flexible and customisable for all your needs) - again, they are pure awesome. If your server does not support SSH+Git, then that is fine, as we can use the fallback option. Let's cover how we will do this.

	1. You'll want to login to your server via SSH (refer to your server's manual for how to do this).
	
	2. Once done, you'll then want to `cd` into your websites directory (eg. `public_html`).
	
	3. This directory should be empty as we are doing a clean install (if it is not empty, back it up, and empty it). Now that it is empty, we want to run the following commands:
	
			curl -OL http://github.com/balupton/balcms/raw/master/Makefile
			git init
			git remote add origin {your git repos read/write url}
			make init-existing; make configure; make install

		> Explanation: These commands should look quite similar to our local installation commands, although there are some differences. We start off by fetching the Makefile, but then we call `git init`, this tells our environment to treat the current directory as a git repository. We then proceed to associate our directory with the remote repository. Finally we run the commands `make init-existing; make configure; make install`. This is the same as before, but this time we run `make init-existing`, instead of `make init-new` - as we now have an existing git repository that we are working with (so we just fetch it), whereas before we had to create the git repository from scratch (it's branches, structure, etc).

	4. You're all done now, you're website is now live.


-	**Fallback Option:** Use a 3rd Party Deployment System. This option involves registering an account with a 3rd party, setting up your git repository with them, giving them your server details, and specifying deployment settings. It's nice, but can get costly when you are deploying to multiple sites and does not allow you to edit files on your live site (instead you have to make the change on your local site, then deploy). It can also take a fair while to deploy changes (from a few minutes to a few hours). If you go this route, we recommend [DeployHQ](http://www.deployhq.com/) - their system works very well, and they have affordable prices. Refer to your chosen system's documentation for how to use this option.

- 	**Silly Option:** Manually transfer the files over FTP. The reason this option is silly, is that it inherits the problems of not using any version control - you quickly end up with discrepancies between your live server and your local copy, causing inconsistency and debugging and maintenance nightmares. Please do not use this option, unless you are a masochist. We will not cover this option.


## Deploying to the Live Site

*Note: Before you deploy to the live site, you will need to have added a production environment to your `config.php` file, and set up your database for the production environment in the `application/config/application.yml` file.*

1.	Once we are happy with our local copy and we want to deploy it to the live site, we just have to run the already familiar command `make deploy` in our websites directory.
		
2.	Once we have deployed our changes to our remote git repository, we will then want to pull those changes onto our live server. This depends on the option we chose.

	- Using the fallback option (3rd Party System): With this option, deployment from our remote git repository to our live server may either happen automatically, or we may need to login to their system and manually deploy the changes and wait a very long time.
	
	- Using the recommended option (SSH+Git): We will want to ssh into our web server and cd into our live sites directory (as we did when we setup the git repository). Once there will want to simply run the command `make update`. That will fetch all the recent changes, and ensure that our configuration is up-to-date.


## Upgrading your BalCMS Version

1.	To upgrade your application to the latest BalCMS version, you'll just need to run `make upgrade` in your application's directory.

	>	Explanation: What this will do is fetch the latest BalCMS version into the balcms branch, and merge it into our dev branch. It will then run `make configure` to ensure the configuration and structure of BalCMS is up to date.


## Thanks!

Thanks for choosing BalCMS for your next commercial or even open-source project. If you have any feedback at all, feel free to post it on our [support forums](http://getsatisfaction.com/balupton/products/balupton_balcms) and someone will give you the support that your after :-)

Happy Coding :-)
- [Benjamin "balupton" Lupton](http://www.balupton.com)
