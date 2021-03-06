/**
 * Implements hook_field_update().
 */
function <?php print $basename; ?>_field_update(\$entity_type, \$entity, \$field, \$instance, \$langcode, &\$items) {
  ${1:if (variable_get('taxonomy_maintain_index_table', TRUE) && \$field['storage']['type'] == 'field_sql_storage' && \$entity_type == 'node') {
    \$first_call = &drupal_static(__FUNCTION__, array());

    // We don't maintain data for old revisions, so clear all previous values
    // from the table. Since this hook runs once per field, per object, make
    // sure we only wipe values once.
    if (!isset(\$first_call[\$entity->nid])) {
      \$first_call[\$entity->nid] = FALSE;
      db_delete('taxonomy_index')->condition('nid', \$entity->nid)->execute();
    \}
    // Only save data to the table if the node is published.
    if (\$entity->status) {
      \$query = db_insert('taxonomy_index')->fields(array('nid', 'tid', 'sticky', 'created'));
      foreach (\$items as \$item) {
        \$query->values(array(
          'nid' => \$entity->nid,
          'tid' => \$item['tid'],
          'sticky' => \$entity->sticky,
          'created' => \$entity->created,
        ));
      \}
      \$query->execute();
    \}
  \}}
}

$2