<?php

require_once 'locationsearch.civix.php';
use CRM_Locationsearch_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function locationsearch_civicrm_config(&$config) {
  _locationsearch_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function locationsearch_civicrm_xmlMenu(&$files) {
  _locationsearch_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function locationsearch_civicrm_install() {
  _locationsearch_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function locationsearch_civicrm_postInstall() {
  _locationsearch_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function locationsearch_civicrm_uninstall() {
  _locationsearch_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function locationsearch_civicrm_enable() {
  _locationsearch_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function locationsearch_civicrm_disable() {
  _locationsearch_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function locationsearch_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _locationsearch_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function locationsearch_civicrm_managed(&$entities) {
  _locationsearch_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function locationsearch_civicrm_caseTypes(&$caseTypes) {
  _locationsearch_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function locationsearch_civicrm_angularModules(&$angularModules) {
  _locationsearch_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function locationsearch_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _locationsearch_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function locationsearch_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function locationsearch_civicrm_navigationMenu(&$menu) {
  _locationsearch_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _locationsearch_civix_navigationMenu($menu);
} // */

/**
 * Implements hook_civicrm_entityTypes().
 */
function locationsearch_civicrm_entityTypes(&$entityTypes) {
  $entityTypes['CRM_Contact_DAO_Contact']['fields_callback'][]
    = function ($class, &$fields) {
      $config = CRM_Core_Config::singleton();
      // Extend search builder with proximity search
      if (!empty($config->geocodeMethod)) {
        $fields['prox_distance'] = array(
          'title' => ts('Proximity Distance'),
          'name' => 'prox_distance',
          'type'  => 2,
          'export' => TRUE,
        );

        $fields['prox_distance_unit'] = array(
          'title' => ts('Proximity Distance Unit'),
          'name' => 'prox_distance_unit',
          'type'  => 2,
          'export' => TRUE,
        );
      }
    };
}

/**
 * Implements hook_civicrm_buildForm().
 */
function locationsearch_civicrm_buildForm($formName, &$form) {
  if ('CRM_Contact_Form_Search_Builder' == $formName) {
    // Enqueue table.js
    CRM_Core_Resources::singleton()
      ->addScriptFile('com.lema.locationsearch', 'templates/CRM/Contact/Form/Search/table.js', 1, 'page-footer');
  }
}
