/**
 * Implements hook_entity_prepare_view().
 */
function <?php print $basename; ?>_entity_prepare_view(\$entities, \$type) {
  ${1:// Load a specific node into the user object for later theming.
  if (\$type == 'user') {
    \$nodes = mymodule_get_user_nodes(array_keys(\$entities));
    foreach (\$entities as \$uid => \$entity) {
      \$entity->user_node = \$nodes[\$uid];
    \}
  \}}
}

$2