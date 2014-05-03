#
# TDM: Insert module at cursor.
#
# @author Luke Carrier <luke@tdm.co>
# @copyright (c) 2014 The Development Manager Ltd
#

.PHONY: all clean

TOP := $(dir $(CURDIR)/$(word $(words $(MAKEFILE_LIST)), $(MAKEFILE_LIST)))

all: build/local_tdmmodatcursor.zip

clean:
	rm -rf $(TOP)build

build/local_tdmmodatcursor.zip:
	mkdir -p $(TOP)build
	cp -rv $(TOP)src $(TOP)build/tdmmodatcursor
	cp $(TOP)README.md $(TOP)build/tdmmodatcursor/README.txt
	cd $(TOP)build \
		&& zip -r local_tdmmodatcursor.zip tdmmodatcursor
	rm -rfv $(TOP)build/tdmmodatcursor

