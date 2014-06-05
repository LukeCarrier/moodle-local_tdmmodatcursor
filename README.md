Add course module at cursor
===========================

This plugin is an extension to the Moodle course editing functionality. It enables editing teachers to add activities
and resources above the activity the cursor is hovering over.

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/LukeCarrier/moodle-local_tdmmodatcursor/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/LukeCarrier/moodle-local_tdmmodatcursor/?branch=master)

License
-------

    Copyright (c) The Development Manager Ltd

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

Requirements
------------

* Moodle 2.6+, as we make use of the new observer system for consuming events.

Building
--------

1. Clone this repository, and ````cd```` into it
2. Execute ````make```` to generate a zip file containing the plugin
3. Upload to the ````moodle.org```` plugins site

Installation
-------------

1. Copy the zip file to your server
2. Extract the zip file and move the ````tdmmodatcursor```` directory to your Moodle's ````local```` directory
3. Browse to Site Administration -> Notifications and allow the database upgrades to execute
4. Browse to Site Administration -> Purge caches
