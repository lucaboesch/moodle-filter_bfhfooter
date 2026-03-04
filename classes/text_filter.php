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

namespace filter_bfhfooter;

use moodle_url;

/**
 * The filter to print out the custom BFH footer on top of Boost Union,
 * when there is "bfhfootnote" in the "theme_boost_union | footnote"
 * field.
 *
 * @package     filter_bfhfooter
 * @copyright   2026 Luca Bösch <luca.boesch@bfh.ch>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class text_filter extends \moodle_text_filter {
    #[\Override]
    public function filter($text, array $options = []) {
        global $PAGE, $OUTPUT;

        $openingtags = "\n        <div class=\"col-12 row\">";
        $closingtags = "\n        </div>";

        // Avoid calling methods that depend on $PAGE->url when the page
        // hasn't called $PAGE->set_url(). This can happen on certain admin pages.
        $logininfo = '';
        $homelink = '';
        $footnotedoclink = '';
        if (isset($PAGE) && $PAGE->has_set_url()) {
            $logininfo = $OUTPUT->login_info(true);
            $homelink = $OUTPUT->home_link();
            // Only fetch the footnote doc link when PAGE->url is available.
            $footnotedoclink = $this->footnote_page_doc_link();
        }

        $fourthcolumn = "      <div class=\"col-sm-3\">" .
            $footnotedoclink .
            $logininfo .
            $this->get_matomolink() .
            "<div class=\"tool_usertours-resettourcontainer\"></div>" .
            $homelink .
            "</div>";

        $replacementtext = get_config('filter_bfhfooter', 'footertext');
        $pattern = '/<p>\s*bfhfootnote\s*<\/p>/i';
        return preg_replace($pattern, $openingtags . $replacementtext . $fourthcolumn . $closingtags, $text);
    }

    /**
     * Returns the necessary Matomo link.
     *
     * @return string
     * @throws \coding_exception
     */
    public function get_matomolink(): string {
        global $OUTPUT, $_COOKIE;
        // Build the Matomo link.
        $matomolink = '';
        $matomolink .= '<div class="matomoinfo">';
        if (isset($_COOKIE['matomo_ignore'])) {
            $matomolink .= '<a href="#piwikcontrol" title ="' . get_string('whatispiwik', 'filter_bfhfooter') .
                '" class="nested-link" onClick="eraseCookie(\'matomo_ignore\')">';
            $matomolink .= '<img src="' . $OUTPUT->image_url('i/completion-manual-n', 'core') . '" alt="' .
                get_string('piwik-optin', 'filter_bfhfooter') . '"></a> ';
            $matomolink .= '<a href="#piwikcontrol" title ="' . get_string('whatispiwik', 'filter_bfhfooter') .
                '" class="simple-link" onClick="eraseCookie(\'matomo_ignore\')">' . get_string('piwik-optin', 'filter_bfhfooter') .
                '</a>';
        } else {
            $matomolink .= '<a href="#piwikcontrol" title ="' . get_string('whatispiwik', 'filter_bfhfooter') .
                '" class="nested-link" onClick="setCookie(\'matomo_ignore\',\'yes\',3650);">';
            $matomolink .= '<img src="' . $OUTPUT->image_url('i/completion-manual-enabled', 'core') . '" alt="' .
                get_string('piwik-optin', 'filter_bfhfooter') . '"></a> ';
            $matomolink .= '<a href="#piwikcontrol" title ="' . get_string('whatispiwik', 'filter_bfhfooter') .
                '" class="simple-link" onClick="setCookie(\'matomo_ignore\',\'yes\',3650);">' .
                get_string('piwik-optout', 'filter_bfhfooter') .
                '</a>';
        }
        $matomolink .= '<a name="piwikcontrol">&#160;</a>';
        $matomolink .= '</div>';
        return $matomolink;
    }

    /**
     * Returns the footnote "Dokumentation zu dieser Seite" link as external link without (i) icon.
     *
     * Passed to footnote.mustache by core_renderer.php.
     *
     * @param string|null $text The link text, if any.
     */
    public function footnote_page_doc_link($text = null) {
        global $PAGE;
        if ($text === null) {
            $text = get_string('moodledocslink');
        }
        $path = page_get_doc_link_path($PAGE);
        if (!$path) {
            return '';
        }
        return $this->footnote_doc_link($path, $text, false);
    }

    /**
     * Returns a string containing a link to the user documentation.
     * But without the icon and with target="_blank". Shown to teachers and admin only.
     *
     * @param string $path The page link after doc root and language, no leading slash.
     * @param string $text The text to be displayed for the link
     * @param boolean $forcepopup Whether to force a popup regardless of the value of $CFG->doctonewwindow
     * @return string
     */
    public function footnote_doc_link($path, $text = '', $forcepopup = false) {
        global $CFG;

        $url = new moodle_url(get_docs_url($path));

        $attributes = ['href' => $url, 'class' => 'simple-link', 'target' => '_blank'];
        if (!empty($CFG->doctonewwindow) || $forcepopup) {
            $attributes['class'] = 'helplinkpopup';
        }

        return \html_writer::tag('a', $text, $attributes);
    }
}
