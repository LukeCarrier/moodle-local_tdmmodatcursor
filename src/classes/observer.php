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
 * Event observer.
 */
class local_tdmmodatcursor_observer {
    /**
     * Course module created.
     *
     * @param \core\event\course_module_created $event The event that triggered our execution.
     *
     * @return void
     */
    public static function course_module_created(\core\event\course_module_created $event) {
        global $DB, $SESSION;

        if (!isset($SESSION->local_tdmmodatcursor_addabove)
                || !array_key_exists($event->courseid, $SESSION->local_tdmmodatcursor_addabove)) {
            return;
        }

        $cm = get_coursemodule_from_id($event->other['modulename'], $event->objectid, $event->courseid);

        $beforemod = $DB->get_record('course_modules', array(
            'id' => $SESSION->local_tdmmodatcursor_addabove[$event->courseid],
        ), '*', MUST_EXIST);

        $section = $DB->get_record('course_sections', array(
            'course' => $cm->course,
            'id'     => $cm->section,
        ), '*', MUST_EXIST);

        moveto_module($cm, $section, $beforemod);

        unset($SESSION->local_tdmmodatcursor_addabove[$event->courseid]);
    }
}
