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
 * API Service class for block anotasi
 *
 * @package    block_anotasi
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace block_anotasi;

defined('MOODLE_INTERNAL') || die();

/**
 * API Service class
 */
class api_service {

    /**
     * Get module data from API (dummy data for now)
     *
     * @return array
     */
    public function get_module_data() {
        // This is dummy data based on your API response format
        return [
            "status" => "success",
            "data" => [
                "modul_name" => "Algoritma",
                "course_id" => "CSE101",
                "modul_id" => "MOD2025A",
                "annotations" => [
                    [
                        "page" => "Page 1",
                        "text" => "Sistem operasi mengelola sumber daya perangkat keras dan perangkat lunak. Kernel berfungsi sebagai inti dari sistem operasi. User interface memungkinkan interaksi antara pengguna dan sistem."
                    ],
                    [
                        "page" => "Page 2", 
                        "text" => "Manajemen memori bertanggung jawab atas alokasi dan pembebasan memori. Paging digunakan untuk memetakan memori logis ke memori fisik. Fragmentasi dapat dikurangi dengan teknik manajemen memori yang efisien."
                    ],
                    [
                        "page" => "Page 3",
                        "text" => "Multitasking memungkinkan beberapa proses berjalan secara bersamaan. Multithreading memungkinkan eksekusi beberapa thread dalam satu proses. Sinkronisasi diperlukan agar thread tidak saling mengganggu."
                    ]
                ]
            ]
        ];
    }

    /**
     * Get all modules list (can be extended to multiple modules)
     *
     * @return array
     */
    public function get_modules_list() {
        return [
            [
                "modul_name" => "Algoritma",
                "course_id" => "CSE101",
                "modul_id" => "MOD2025A",
                "annotation_count" => 3
            ],
            // Future: Add more modules here
        ];
    }

    /**
     * Get annotations for specific module and page
     *
     * @param string $modul_id
     * @param int $page_number
     * @return array
     */
    public function get_annotation_by_page($modul_id, $page_number = 1) {
        $data = $this->get_module_data();
        $annotations = $data['data']['annotations'];
        
        // Get annotation for specific page (array is 0-indexed, page is 1-indexed)
        $page_index = $page_number - 1;
        
        if (isset($annotations[$page_index])) {
            return [
                'annotation' => $annotations[$page_index],
                'current_page' => $page_number,
                'total_pages' => count($annotations),
                'has_next' => $page_number < count($annotations),
                'has_previous' => $page_number > 1,
                'modul_name' => $data['data']['modul_name']
            ];
        }
        
        return null;
    }
}