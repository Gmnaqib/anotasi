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
 * Mobile output class for block anotasi
 *
 * @package    block_anotasi
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_anotasi\output;

defined('MOODLE_INTERNAL') || die();

/**
 * Mobile output class
 */
class mobile {
    
    /**
     * Returns the block content for mobile app - shows list of modules
     * 
     * @param array $args Arguments from block
     * @return array Template, JavaScript and other data
     */
    public static function view_anotasi_block($args) {
        global $OUTPUT, $USER;
        
        $args = (object) $args;
        
        // Get modules data
        $apiservice = new \block_anotasi\api_service();
        $modules = $apiservice->get_modules_list();
        
        return [
            'templates' => [
                [
                    'id' => 'main',
                    'html' => $OUTPUT->render_from_template('block_anotasi/mobile_modules_list', [
                        'modules' => $modules,
                        'has_modules' => !empty($modules)
                    ])
                ]
            ],
            'javascript' => '
                // JavaScript for any additional functionality if needed
                console.log("Block anotasi mobile loaded");
            ',
            'otherdata' => [
                'user_id' => $USER->id
            ]
        ];
    }
    
    /**
     * View annotations for specific module with pagination
     */
    public static function view_module_annotations($args) {
        global $OUTPUT;
        
        $args = (object) $args;
        $modul_id = $args->modul_id ?? '';
        $modul_name = $args->modul_name ?? '';
        $page = intval($args->page ?? 1);
        
        // Get annotation data for current page
        $apiservice = new \block_anotasi\api_service();
        $data = $apiservice->get_annotation_by_page($modul_id, $page);
        
        if (!$data) {
            // If no data found, show error or redirect back
            $data = [
                'annotation' => ['page' => 'Error', 'text' => 'Annotation not found'],
                'current_page' => 1,
                'total_pages' => 1,
                'has_next' => false,
                'has_previous' => false,
                'modul_name' => $modul_name
            ];
        }
        
        return [
            'templates' => [
                [
                    'id' => 'main',
                    'html' => $OUTPUT->render_from_template('block_anotasi/mobile_annotation_detail', [
                        'annotation' => $data['annotation'],
                        'current_page' => $data['current_page'],
                        'total_pages' => $data['total_pages'],
                        'has_next' => $data['has_next'],
                        'has_previous' => $data['has_previous'],
                        'modul_name' => $data['modul_name'],
                        'modul_id' => $modul_id,
                        'next_page' => $data['current_page'] + 1,
                        'previous_page' => $data['current_page'] - 1
                    ])
                ]
            ],
            'javascript' => '
                // JavaScript for any additional functionality if needed  
                console.log("Annotation detail page loaded - Page ' . $data['current_page'] . ' of ' . $data['total_pages'] . '");
            ',
            'otherdata' => [
                'modul_id' => $modul_id,
                'modul_name' => $modul_name,
                'current_page' => $data['current_page']
            ]
        ];
    }
}