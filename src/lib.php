<?php

/**
 * TDM: Insert module at cursor.
 *
 * @author Luke Carrier <luke@tdm.co>
 * @copyright (c) 2014 The Development Manager Ltd
 */

defined('MOODLE_INTERNAL') || die;

global $PAGE;

if (substr($PAGE->url->out_omit_querystring(), strlen($CFG->wwwroot)) === '/course/view.php') {
    $PAGE->requires->css('/local/tdmmodatcursor/style.css');
    $PAGE->requires->yui_module('moodle-local_tdmmodatcursor-modatcursor',
                                'Y.Moodle.local_tdmmodatcursor.modatcursor.init', array(array(
        'addString' => get_string('addtype', 'local_tdmmodatcursor'),

        'modules' => array(
            'file' => get_string('modulename', 'resource'),
            'url'  => get_string('modulename', 'url'),
        ),

        'course' => $PAGE->url->get_param('id'),
    )));
}