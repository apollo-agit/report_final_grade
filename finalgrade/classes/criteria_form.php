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
 * Final Grade report renderer.
 *
 * @package    report_eventlist
 * @copyright  2016 onwards Ian Hamilton  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/formslib.php');

/**
 * Event list filter form.
 *
 * @package   report_eventlist
 * @copyright 2014 Adrian Greeve <adrian@moodle.com>
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class report_finalgrade_criteria_form extends moodleform {

	public function definition() {

        $mform = $this->_form;
        $mform->disable_form_change_checker();

        $mform->addElement('header', 'displayinfo', get_string('coursefilter', 'report_finalgrade'));

        $mform->addElement('text', 'coursefiltername', get_string('name', 'report_eventlist'));
        $mform->setType('coursefiltername', PARAM_NOTAGS);

        $this->add_action_buttons(true, 'Search');
    }
}


