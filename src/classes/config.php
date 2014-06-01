<?php

// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * TDM: Insert module at cursor.
 *
 * @package   local_tdmmodatcursor
 * @author    Luke Carrier <luke@tdm.co>
 * @copyright (c) 2014 The Development Manager Ltd
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;

/**
 * Module at cursor configuration.
 */
class local_tdmmodatcursor_config {
    /**
     * Default quick links.
     *
     * @var string[]
     */
    protected static $defaultquicklinks = array(
        'resource',
        'url',
    );

    /**
     * Get an array of enabled quick links.
     *
     * @return string[] The frankenstyle names of the modules configured as quick links.
     */
    public static function get_quick_links() {
        $raw = get_config('local_tdmmodatcursor', 'quicklinks');

        return ($raw) ? unserialize($raw) : static::$defaultquicklinks;
    }

    /**
     * Get an array of enabled quick links with their friendly names.
     *
     * @return string[] An array of friendly names of the modules configured as quick links, indexed by their
     *                  frankenstyle counterparts.
     */
    public static function get_quick_links_list() {
        $quicklinks = static::get_quick_links();
        $result     = array();

        foreach ($quicklinks as $mod) {
            $result[$mod] = new lang_string('modulename', $mod);
        }

        return $result;
    }

    /**
     * Set quick links.
     *
     * @param string[] $quicklinks An array of module names for which quick links should be inserted.
     *
     * @return void
     */
    public static function set_quick_links($quicklinks) {
        set_config('quicklinks', serialize($quicklinks), 'local_tdmmodatcursor');
    }
}
