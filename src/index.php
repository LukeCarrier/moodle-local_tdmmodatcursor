<?php

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
