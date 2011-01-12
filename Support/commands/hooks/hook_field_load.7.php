/**
 * Implements hook_field_load().
 */
function <?php print $basename; ?>_field_load(\$entity_type, \$entities, \$field, \$instances, \$langcode, &\$items, \$age) {
  ${1:// Sample code from text.module: precompute sanitized strings so they are
  // stored in the field cache.
  foreach (\$entities as \$id => \$entity) {
    foreach (\$items[\$id] as \$delta => \$item) {
      // Only process items with a cacheable format, the rest will be handled
      // by formatters if needed.
      if (empty(\$instances[\$id]['settings']['text_processing']) || filter_format_allowcache(\$item['format'])) {
        \$items[\$id][\$delta]['safe_value'] = isset(\$item['value']) ? _text_sanitize(\$instances[\$id], \$langcode, \$item, 'value') : '';
        if (\$field['type'] == 'text_with_summary') {
          \$items[\$id][\$delta]['safe_summary'] = isset(\$item['summary']) ? _text_sanitize(\$instances[\$id], \$langcode, \$item, 'summary') : '';
        \}
      \}
    \}
  \}}
}

$2