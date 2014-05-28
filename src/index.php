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

$SESSION->local_tdmmodatcursor_addabove = $addabove;

redirect(new moodle_url('/course/modedit.php', array(
    'add'     => $add,
    'course'  => $course,
    'section' => $section,
    'return'  => 0,
)));
