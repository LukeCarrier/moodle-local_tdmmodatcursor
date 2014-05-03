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

$observers = array(

    /*
     * Course module created.
     */
    array(
        'eventname' => '\core\event\course_module_created',
        'callback'  => 'local_tdmmodatcursor_observer::course_module_created',
    ),

);
