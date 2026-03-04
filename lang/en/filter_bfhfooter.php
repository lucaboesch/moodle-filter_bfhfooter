<?php
// This file is part of Moodle - https://moodle.org/
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
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/**
 * Plugin strings are defined here.
 *
 * @package     filter_bfhfooter
 * @category    string
 * @copyright   2026 Luca Bösch <luca.boesch@bfh.ch>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$string['filtername'] = 'BFH Footer';
$string['footertext'] = 'Footer text';
$string['footertext_desc'] = 'Text to put into the BFH Footer.
This is put into a div with id "footnote", then a div with class "container-fluid px-0",
then a div with class "col-12 row", where three div with class "col-sm-3" shall be added.
The rest (fourth column and the closing tags) is added automatically.
Don\'t forget to add the Matomo code to "additionalhtmlhead".
The footnote should take the value "&lt;p&gt;bfhfootnote&lt;/p&gt;" and enablefooterbutton
should be set to "Hide on all devices".';
$string['piwik-optin'] = 'Take part in Matomo website analysis';
$string['piwik-optout'] = 'Matomo website analysis opt-out';
$string['pluginname'] = 'BFH Footer';
$string['whatispiwik'] = 'We use Matomo to measure and analyse the usage of this site. All data collected is completely anonymous, it does not identify you as an individual in any way.';
