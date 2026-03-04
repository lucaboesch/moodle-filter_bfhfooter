@editor @filter @filter_bfhfooter
Feature: Render BFH footer content using filters
  To have a footer that is the same as previously user and features four columns
  I need to render BFH footer content.

  Background:
    Given the following "courses" exist:
      | shortname | fullname |
      | C1        | Course 1 |
    And the following "users" exist:
      | username | firstname | lastname | email                |
      | teacher1 | Teacher   | 1        | teacher1@example.com |
      | student1 | Student   | 1        | student1@example.com |
    And the following "course enrolments" exist:
      | user     | course | role           |
      | teacher1 | C1     | editingteacher |
      | student1 | C1     | student        |
    And the "bfhfooter" filter is "on"
    And the "multilang" filter is "on"
    And the "multilang" filter applies to "content and headings"
    And the following config values are set as admin:
      | config             | value                  | plugin            |
      | footnote           | <p>bfhfootnote</p>     | theme_boost_union |
      | enablefooterbutton | enablefooterbuttonnone | theme_boost_union |

  @javascript
  Scenario: View the BFH footer content on a page
    Given I log in as "admin"
    And I navigate to "Appearance > Themes" in site administration
    And I click on "Select theme 'Boost Union'" "button"
    And I navigate to "Plugins > Filters > Manage filters" in site administration
    And I click on "Settings" "link" in the "BFH Footer" "table_row"
    And I set the field "Footer text" to multiline:
    """
<div class="col-sm-3"><span class="multilang" lang="en"><a class="simple-link"
      href="https://moodle.bfh.ch/local/bfh_requestform">Request course/Help
      contact</a></span> <span class="multilang" lang="de"><a
      class="simple-link"
      href="https://moodle.bfh.ch/local/bfh_requestform">Kurs
      beantragen/Help-Kontakt</a></span> <span class="multilang" lang="fr"><a
      class="simple-link"
      href="https://moodle.bfh.ch/local/bfh_requestform">Demande d'un
      cours/Contact aide</a></span><br><span class="multilang" lang="en"><a
      class="simple-link"
      href="https://www.bfh.ch/en/about-bfh/services-counselling/university-didactics-e-learning"
      target="_blank" rel="noopener">Virtual Academy</a></span> <span
    class="multilang" lang="de"><a class="simple-link"
      href="https://bfh.ch/virtuelle-akademie" target="_blank"
      rel="noopener">Virtuelle Akademie</a></span> <span class="multilang"
    lang="fr"><a class="simple-link"
      href="https://www.bfh.ch/fr/la-bfh/services-conseils/academie-virtuelle"
      target="_blank" rel="noopener">Académie Virtuelle</a></span><br><span
    class="multilang" lang="en"><a class="simple-link"
      href="https://bernerfachhochschule.sharepoint.com/sites/mybfh-Home-en"
      target="_blank" rel="noopener">BFH Intranet</a></span> <span
    class="multilang" lang="de"><a class="simple-link"
      href="https://bernerfachhochschule.sharepoint.com/sites/mybfh-Home-de"
      target="_blank" rel="noopener">BFH Intranet</a></span><span
    class="multilang" lang="fr"><a class="simple-link"
      href="https://bernerfachhochschule.sharepoint.com/sites/mybfh-Home-fr"
      target="_blank" rel="noopener">BFH Intranet</a></span><br><span
    class="multilang" lang="en"><a class="simple-link"
      href="https://campusapp.bfh.ch/dashboard" target="_blank"
      rel="noopener">BFH Campus app</a></span> <span class="multilang"
    lang="de"><a class="simple-link" href="https://campusapp.bfh.ch/dashboard"
      target="_blank" rel="noopener">BFH Campus App</a></span><span
    class="multilang" lang="fr"><a class="simple-link"
      href="https://campusapp.bfh.ch/dashboard" target="_blank"
      rel="noopener">Appli BFH Campus</a></span></div>
<div class="col-sm-3"><span class="multilang" lang="en"><a class="simple-link"
      href="https://portfolio.switch.ch" target="_blank" rel="noopener">Mahara
      E-Portfolio</a></span> <span class="multilang" lang="de"><a
      class="simple-link" href="https://portfolio.switch.ch" target="_blank"
      rel="noopener">Mahara E-Portfolio</a></span> <span class="multilang"
    lang="fr"><a class="simple-link" href="https://portfolio.switch.ch"
      target="_blank" rel="noopener">Mahara E-Portfolio</a></span> <span
    class="multilang" lang="it"><a class="simple-link"
      href="https://portfolio.switch.ch" target="_blank" rel="noopener">Mahara
      E-Portfolio</a></span> <span class="multilang" lang="es"><a
      class="simple-link" href="https://portfolio.switch.ch" target="_blank"
      rel="noopener">Mahara E-Portfolio</a></span><br><span class="multilang"
    lang="en"><a class="simple-link"
      href="https://moodle.bfh.ch/local/differentiator">Differentiator</a></span>
  <span class="multilang" lang="de"><a class="simple-link"
      href="https://moodle.bfh.ch/local/differentiator">Differentiator</a></span>
  <span class="multilang" lang="fr"><a class="simple-link"
      href="https://moodle.bfh.ch/local/differentiator">Differentiator</a></span>
  <span class="multilang" lang="it"><a class="simple-link"
      href="https://moodle.bfh.ch/local/differentiator">Differentiator</a></span>
  <span class="multilang" lang="es"><a class="simple-link"
      href="https://moodle.bfh.ch/local/differentiator">Diferenciador</a></span>
</div>
<div class="col-sm-3"><span class="multilang" lang="en"><a class="simple-link"
      href="https://moodle.org/?lang=en" target="_blank" rel="noopener">Moodle
      Community</a></span> <span class="multilang" lang="de"><a
      class="simple-link" href="https://moodle.org/?lang=de" target="_blank"
      rel="noopener">Moodle Community</a></span> <span class="multilang"
    lang="fr"><a class="simple-link" href="https://moodle.org/?lang=fr"
      target="_blank" rel="noopener">Moodle Community</a></span><br><span
    class="multilang" lang="en"><a class="simple-link"
      href="https://docs.moodle.org/501/en/Managing_a_Moodle_course"
      target="_blank" rel="noopener">Moodle help for each tool</a></span> <span
    class="multilang" lang="de"><a class="simple-link"
      href="https://docs.moodle.org/501/de/Moodle-Kurs_verwalten"
      target="_blank" rel="noopener">Moodle Hilfe zu einzelnen
      Werkzeugen</a></span> <span class="multilang" lang="fr"><a
      class="simple-link"
      href="https://docs.moodle.org/5x/fr/Gestion_d%27un_cours_Moodle"
      target="_blank" rel="noopener">Moodle aide pour chaque outil</a></span>
</div>
    """
    And I press "Save changes"
    And I navigate to "Appearance > User tours" in site administration
    And I click on "Enable" "link" in the "Course editing" "table_row"
    And I click on "//a[@title=\"Edit\"]" "xpath_element" in the "Course editing" "table_row"
    And I set the field "id_filter_theme" to "Boost Union"
    And I press "Save changes"
    When I am on the "C1" "Course" page logged in as "teacher1"
    Then I should see "Reset user tour on this page"
