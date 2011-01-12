/**
 * Implements hook_field_update_forbid().
 */
function <?php print $basename; ?>_field_update_forbid(\$field, \$prior_field, \$has_data) {
  ${1:// A 'list' field stores integer keys mapped to display values. If
  // the new field will have fewer values, and any data exists for the
  // abandoned keys, the field will have no way to display them. So,
  // forbid such an update.
  if (\$has_data && count(\$field['settings']['allowed_values']) < count(\$prior_field['settings']['allowed_values'])) {
    // Identify the keys that will be lost.
    \$lost_keys = array_diff(array_keys(\$field['settings']['allowed_values']), array_keys(\$prior_field['settings']['allowed_values']));
    // If any data exist for those keys, forbid the update.
    \$query = new EntityFieldQuery();
    \$found = \$query
      ->fieldCondition(\$prior_field['field_name'], 'value', \$lost_keys)
      ->range(0, 1)
      ->execute();
    if (\$found) {
      throw new FieldUpdateForbiddenException("Cannot update a list field not to include keys with existing data");
    \}
  \}}
}

$2