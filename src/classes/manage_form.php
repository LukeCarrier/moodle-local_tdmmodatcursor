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
 * Form to manage displayed quick links.
 */
class local_tdmmodatcursor_manage_form extends moodleform {
    /**
     * @override \moodleform
     */
    public function definition() {
        $mform = $this->_form;

        $allmods = $this->get_module_names();
        $checked = local_tdmmodatcursor_config::get_quick_links();

        $mform->addElement('header', 'quicklinks', new lang_string('quicklinks', 'local_tdmmodatcursor'));
        foreach ($allmods as $mod) {
            $mform->addElement('checkbox', $mod, new lang_string('modulename', $mod));

            $mform->setDefault($mod, in_array($mod, $checked));
        }

        $this->add_action_buttons();
    }

    /**
     * Save configuration changes.
     *
     * @return boolean True if we had data and saved some configuration, else false.
     */
    public function save_data() {
        if (!$data = $this->get_data()) {
            return false;
        }

        unset($data->submitbutton);
        $checked = array_intersect($this->get_module_names(), array_keys(get_object_vars($data)));
        local_tdmmodatcursor_config::set_quick_links($checked);

        return true;
    }

    private function get_module_names() {
        return array_keys(core_component::get_plugin_list('mod'));
    }
}
