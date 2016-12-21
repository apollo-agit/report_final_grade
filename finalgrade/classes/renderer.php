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
 * @package    report_finalgrade
 * @copyright  2016 onwards Ian Hamilton  {@link http://moodle.com}
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

class report_finalgrade_renderer extends plugin_renderer_base {

	
    public function render_course_final_grade($form, $coursefiltername) { 
    	global $PAGE;

    	$title = get_string('pluginname', 'report_finalgrade');
    	$html = $this->output->header();
        $html .= $this->output->heading($title);

        ob_start();
        $form->display();
        $html .= ob_get_contents();
        ob_end_clean();

        $html .= $this->render_finalgrade_detail($coursefiltername);

        $html .= $this->output->footer();
        return $html;

    }


    public function render_finalgrade_detail($coursefiltername) {
        global $DB;
        global $SESSION;
        $html = '';
        if($coursefiltername) {

            

            $table = new html_table();
              $table->head = array(
                get_string('headerterm', 'report_finalgrade'),
                get_string('headercrn', 'report_finalgrade'),
                get_string('headerbannerid', 'report_finalgrade'),
                get_string('headerfinalgrade', 'report_finalgrade'));    

            $select = 'select id, idnumber from {course} where ';
            $like = $DB->sql_like('idnumber', ':idnum', false, false, false);
            $courseRecords = $DB->get_records_sql($select . $like, 
                array('idnum' => '%'. $coursefiltername . '%'));  
                
            foreach($courseRecords as $rec) {                              

                $sql = 'SELECT distinct u.username, g.rawgrade, g.finalgrade FROM moodle.mdl_grade_grades g';
                $sql .= ' inner join mdl_user u on u.id = g.userid';
                $sql .= ' inner join mdl_grade_items gi on gi.id = g.itemid';
                $sql .= ' where gi.itemtype = \'course\'';
                $sql .= ' and gi.courseid = :courseid';

                $studentRecords = $DB->get_records_sql($sql, array('courseid' => $rec->id));
                $split = explode('.', $rec->idnumber); 

                foreach($studentRecords as $studentRec) {
                    $table->data[] = array($split[1], $split[0], $studentRec->username, 
                        $studentRec->finalgrade);
                }

                $SESSION->gradedata = $table->data;
            }

            $html =  html_writer::link('download.php?dl=true', 'Download');
            $html .= html_writer::table($table);

        }

        return $html;
    }


}


