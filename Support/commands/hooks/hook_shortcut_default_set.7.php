/**
 * Implements hook_shortcut_default_set().
 */
function <?php print $basename; ?>_shortcut_default_set(\$account) {
  ${1:// Use a special set of default shortcuts for administrators only.
  if (in_array(variable_get('user_admin_role', 0), \$account->roles)) {
    return variable_get('mymodule_shortcut_admin_default_set');
  \}}
}

$2