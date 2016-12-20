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
 * The admin report for final grade
 *
 * @package   report_finalgrade
 * @copyright 2016 onwards Ian Hamilton  {@link http://moodle.com}
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


require_once(__DIR__ . '/../../config.php');
require_once($CFG->libdir.'/adminlib.php');

require_login();

$courseLike = optional_param('like', '', PARAM_ALPHA);

$strfinalgrade = get_string('finalgradetitle', 'report_finalgrade');

$components = array('0' => get_string('all', 'report_finalgrade'));
$edulevel = array('0' => get_string('all', 'report_finalgrade'));
$crud = array('0' => get_string('all', 'report_finalgrade'));
$criteriasection = new report_finalgrade_criteria_form(null, array('components' => $components, 'edulevel' => $edulevel,
        'crud' => $crud));

$renderer = $PAGE->get_renderer('report_finalgrade');
echo $renderer->render_course_final_grade($criteriasection);



