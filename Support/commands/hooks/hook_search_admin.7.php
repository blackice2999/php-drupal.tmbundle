/**
 * Implements hook_search_admin().
 */
function <?php print $basename; ?>_search_admin() {
  ${1:// Output form for defining rank factor weights.
  \$form['content_ranking'] = array(
    '#type' => 'fieldset',
    '#title' => t('Content ranking'),
  );
  \$form['content_ranking']['#theme'] = 'node_search_admin';
  \$form['content_ranking']['info'] = array(
    '#value' => '<em>' . t('The following numbers control which properties the content search should favor when ordering the results. Higher numbers mean more influence, zero means the property is ignored. Changing these numbers does not require the search index to be rebuilt. Changes take effect immediately.') . '</em>'
  );

  // Note: reversed to reflect that higher number = higher ranking.
  \$options = drupal_map_assoc(range(0, 10));
  foreach (module_invoke_all('ranking') as \$var => \$values) {
    \$form['content_ranking']['factors']['node_rank_' . \$var] = array(
      '#title' => \$values['title'],
      '#type' => 'select',
      '#options' => \$options,
      '#default_value' => variable_get('node_rank_' . \$var, 0),
    );
  \}
  return \$form;}
}

$2