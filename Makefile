.PHONY: c d t

c:
	find var/cache/* -maxdepth 0 -type d | xargs rm -rf

d:
	bin/console setup:reset
	bin/console setup:install
	bin/console demo:data
#	bin/console collector:all

t:
	SYMFONY_ENV=test vendor/bin/codecept run --coverage --coverage-html
