/**
 * Implements hook_library_alter().
 */
function <?php print $basename; ?>_library_alter(&\$libraries, \$module) {
  ${1:// Update Farbtastic to version 2.0.
  if (\$module == 'system' && isset(\$libraries['farbtastic'])) {
    // Verify existing version is older than the one we are updating to.
    if (version_compare(\$libraries['farbtastic']['version'], '2.0', '<')) {
      // Update the existing Farbtastic to version 2.0.
      \$libraries['farbtastic']['version'] = '2.0';
      \$libraries['farbtastic']['js'] = array(
        drupal_get_path('module', 'farbtastic_update') . '/farbtastic-2.0.js' => array(),
      );
    \}
  \}}
}

$2