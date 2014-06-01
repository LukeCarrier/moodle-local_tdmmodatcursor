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
require_once "{$CFG->libdir}/adminlib.php";

admin_externalpage_setup('local_tdmmodatcursor');

$mform = new local_tdmmodatcursor_manage_form();
if ($mform->save_data()) {
    $flash = $OUTPUT->notification(new lang_string('updatesuccessful', 'local_tdmmodatcursor'), 'notifysuccess');
} elseif ($mform->is_cancelled()) {
    $flash = $OUTPUT->notification(new lang_string('updatecancelled', 'local_tdmmodatcursor'), 'notifyproblem');
} else {
    $flash = '';
}

echo $OUTPUT->header(),
     $flash,
     $OUTPUT->heading(new lang_string('managequicklinks', 'local_tdmmodatcursor')),
     $OUTPUT->box(new lang_string('managequicklinksdesc', 'local_tdmmodatcursor'));
$mform->display();
echo $OUTPUT->footer();
