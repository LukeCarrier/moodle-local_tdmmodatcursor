<?php

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

        if (!isset($SESSION->local_tdmmodatcursor_addabove)) {
            return;
        }

        $cm = get_coursemodule_from_id($event->other['modulename'], $event->objectid, $event->courseid);

        $beforemod = get_coursemodule_from_id('', $SESSION->local_tdmmodatcursor_addabove, $event->courseid);
        $beforemod = $DB->get_record('course_modules', array(
            'id' => $SESSION->local_tdmmodatcursor_addabove,
        ), '*', MUST_EXIST);

        $section = $DB->get_record('course_sections', array(
            'course' => $cm->course,
            'id'     => $cm->section,
        ), '*', MUST_EXIST);

        moveto_module($cm, $section, $beforemod);

        unset($SESSION->local_tdmmodatcursor_addabove);
    }
}
