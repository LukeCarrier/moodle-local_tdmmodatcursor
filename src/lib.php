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

global $PAGE;

if (substr($PAGE->url->out_omit_querystring(), strlen($CFG->wwwroot)) === '/course/view.php') {
    $PAGE->requires->css('/local/tdmmodatcursor/style.css');
    $PAGE->requires->yui_module('moodle-local_tdmmodatcursor-modatcursor',
                                'Y.M.local_tdmmodatcursor.modatcursor.init', array(array(
        'addString' => get_string('addtype', 'local_tdmmodatcursor'),

        'modules' => array(
            'resource' => get_string('modulename', 'resource'),
            'url'      => get_string('modulename', 'url'),
        ),

        'course' => $PAGE->url->get_param('id'),
    )));
}
