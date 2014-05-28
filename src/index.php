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

require_once dirname(dirname(__DIR__)) . '/config.php';

$add      = required_param('add',      PARAM_ALPHA);
$course   = required_param('course',   PARAM_INT);
$section  = required_param('section',  PARAM_INT);
$addabove = required_param('addabove', PARAM_INT);

if (!property_exists($SESSION, 'local_tdmmodatcursor_addabove')) {
    $SESSION->local_tdmmodatcursor_addabove = array();
}

/* This array is utilised in the post-course module creation observer, after the usual creation process. This allows us
 * to quietly move the module to the designated location after creation. The values are IDs of the CMs immediately below
 * the desired location and are indexed by course ID. Indexing by course ID helps prevent weird behaviour when editing
 * multiple courses in one browser session (cheers David Mudrák!). */
$SESSION->local_tdmmodatcursor_addabove[$course] = $addabove;

redirect(new moodle_url('/course/modedit.php', array(
    'add'     => $add,
    'course'  => $course,
    'section' => $section,
    'return'  => 0,
)));
