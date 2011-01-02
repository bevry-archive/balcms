# ======================
# Standard Make Vars

MAKEFLAGS = --no-print-directory --always-make
MAKE = make $(MAKEFLAGS)

# ======================
# Special Variables

# Current BalCMS Version
BALCMS_VERSION = v1.0.0

# ======================
# Commands

default:
	$(MAKE) setup;

init-new:
	git init;
	git remote add balcms git://github.com/balupton/balcms.git;
	git fetch balcms;
	rm Makefile;
	git checkout -b $(BALCMS_VERSION)-balcms balcms/$(BALCMS_VERSION);
	git branch $(BALCMS_VERSION)-dev;
	git branch $(BALCMS_VERSION);
	git branch master;
	git checkout $(BALCMS_VERSION)-dev;
	sed '1,7d' .gitignore > .gitignore; # removes ignores that are for the base balcms repo only
	git add .gitignore;
	git commit -m "Updated .gitignore for our application. Welcome.";

init-existing:
	git remote add balcms git://github.com/balupton/balcms.git;
	git fetch balcms;
	git fetch origin;
	rm Makefile;
	git checkout -b $(BALCMS_VERSION)-balcms balcms/$(BALCMS_VERSION);
	git checkout -b $(BALCMS_VERSION)-dev origin/$(BALCMS_VERSION)-dev;
	git checkout -b $(BALCMS_VERSION) origin/$(BALCMS_VERSION);
	git checkout -b master origin/master;

clean:
	$(MAKE) clean-config; $(MAKE) clean-js; $(MAKE) clean-css;

clean-config:
	rm -Rf \
		application/config/compiled/* \
		application/data/schema/compiled/* \
		application/data/schema/compiled/* \
		application/modules/*/config/compiled/*;

clean-js:
	rm -Rf \
		public/media/cache/scripts/*;

clean-css:
	rm -Rf \
		common/scaffold/cache/* \
		public/media/cache/styles/*;

configure:
	php5 ./scripts/configure;

permissions:
	php5 ./scripts/setup.php permissions;

install:
	php5 ./scripts/setup.php install;

setup:
	php5 ./scripts/setup.php;

ignore:
	edit .gitignore;

cron:
	php5 ./scripts/cron.php;

add:
	git add -u;

stable:
	git checkout $(BALCMS_VERSION);

dev:
	git checkout $(BALCMS_VERSION)-dev;

master:
	git checkout master;

upgrade:
	git checkout $(BALCMS_VERSION)-balcms; git pull balcms $(BALCMS_VERSION); git checkout $(BALCMS_VERSION)-dev; git merge $(BALCMS_VERSION)-balcms;

update:
	git pull; $(MAKE) configure;

deploy:
	git checkout $(BALCMS_VERSION); git merge $(BALCMS_VERSION)-dev; git checkout master; git merge $(BALCMS_VERSION); git checkout $(BALCMS_VERSION)-dev; git push origin --all;
