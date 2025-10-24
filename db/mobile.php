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
 * Mobile app support configuration
 *
 * @package    block_anotasi
 * @copyright  2025 Your Name
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$addons = [
    'block_anotasi' => [
        'handlers' => [
            'anotasi' => [
                'delegate' => 'CoreBlockDelegate',
                'method' => 'view_anotasi_block',
                'displaydata' => [
                    'title' => 'anotasi_block_title',
                    'class' => 'block_anotasi',
                    'type' => 'title'
                ],
                'styles' => [
                    'url' => '/blocks/anotasi/styles/mobile.css',
                    'version' => '2025102400'
                ]
            ]
        ],
        'lang' => [
            ['anotasi_block_title', 'block_anotasi'],
            ['view_modules', 'block_anotasi'],
            ['module_annotations', 'block_anotasi'],
            ['page_counter', 'block_anotasi'],
            ['previous_page', 'block_anotasi'],
            ['next_page', 'block_anotasi'],
            ['no_modules', 'block_anotasi'],
            ['view_annotations', 'block_anotasi'],
            ['back_to_modules', 'block_anotasi'],
        ]
    ]
];