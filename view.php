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
 * View page for anotasi block
 *
 * @package    block_anotasi
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require_once('../../config.php');

$id = required_param('id', PARAM_INT); // Block instance ID

require_login();

$PAGE->set_url('/blocks/anotasi/view.php', ['id' => $id]);
$PAGE->set_title(get_string('anotasi_block_title', 'block_anotasi'));
$PAGE->set_heading(get_string('anotasi_block_title', 'block_anotasi'));

echo $OUTPUT->header();

// Get API data
$apiservice = new \block_anotasi\api_service();
$data = $apiservice->get_module_data();

echo html_writer::start_tag('div', ['class' => 'anotasi-block-view']);

echo html_writer::tag('h2', $data['data']['modul_name']);
echo html_writer::tag('p', 'Course ID: ' . $data['data']['course_id']);
echo html_writer::tag('p', 'Module ID: ' . $data['data']['modul_id']);

echo html_writer::start_tag('div', ['class' => 'annotations-list']);

foreach ($data['data']['annotations'] as $index => $annotation) {
    echo html_writer::start_tag('div', ['class' => 'annotation-item card mb-3']);
    echo html_writer::start_tag('div', ['class' => 'card-header']);
    echo html_writer::tag('h5', $annotation['page']);
    echo html_writer::end_tag('div');
    echo html_writer::start_tag('div', ['class' => 'card-body']);
    echo html_writer::tag('p', $annotation['text'], ['class' => 'card-text']);
    echo html_writer::end_tag('div');
    echo html_writer::end_tag('div');
}

echo html_writer::end_tag('div');
echo html_writer::end_tag('div');

echo $OUTPUT->footer();