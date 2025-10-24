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
 * Block anotasi main class
 *
 * @package    block_anotasi
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_anotasi extends block_base {

    /**
     * Initialises the block.
     *
     * @return void
     */
    public function init() {
        $this->title = get_string('pluginname', 'block_anotasi');
    }

    /**
     * Gets the block contents.
     *
     * @return string The block HTML.
     */
    public function get_content() {
        global $OUTPUT;

        if ($this->content !== null) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->footer = '';

        // Get API data (dummy for now)
        $apiservice = new \block_anotasi\api_service();
        $data = $apiservice->get_module_data();

        $context = [
            'modul_name' => $data['data']['modul_name'],
            'course_id' => $data['data']['course_id'],
            'modul_id' => $data['data']['modul_id'],
            'annotation_count' => count($data['data']['annotations']),
            'view_url' => new moodle_url('/blocks/anotasi/view.php', ['id' => $this->instance->id])
        ];

        $this->content->text = $OUTPUT->render_from_template('block_anotasi/content', $context);

        return $this->content;
    }

    /**
     * Defines in which pages this block can be used.
     *
     * @return array of the pages where the block can be used.
     */
    public function applicable_formats() {
        return [
            'admin' => false,
            'site-index' => false,
            'course-view' => false,
            'course-view-social' => false,
            'mod' => false,
            'mod-quiz' => false,
            'my' => true,  // Dashboard
            'user-profile' => false,
        ];
    }

    /**
     * Returns true if this block has instance allow multiple setting.
     *
     * @return bool
     */
    public function instance_allow_multiple() {
        return false;
    }

    /**
     * Returns true if this block has global config.
     *
     * @return bool
     */
    public function has_config() {
        return false;
    }
}