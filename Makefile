.PHONY: c

c:
	find var/cache/* -maxdepth 0 -type d | xargs rm -rf
