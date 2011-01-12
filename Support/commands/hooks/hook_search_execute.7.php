/**
 * Implements hook_search_execute().
 */
function <?php print $basename; ?>_search_execute(\$keys = NULL, \$conditions = NULL) {
  ${1:// Build matching conditions
  \$query = db_select('search_index', 'i', array('target' => 'slave'))->extend('SearchQuery')->extend('PagerDefault');
  \$query->join('node', 'n', 'n.nid = i.sid');
  \$query
    ->condition('n.status', 1)
    ->addTag('node_access')
    ->searchExpression(\$keys, 'node');

  // Insert special keywords.
  \$query->setOption('type', 'n.type');
  \$query->setOption('language', 'n.language');
  if (\$query->setOption('term', 'ti.tid')) {
    \$query->join('taxonomy_index', 'ti', 'n.nid = ti.nid');
  \}
  // Only continue if the first pass query matches.
  if (!\$query->executeFirstPass()) {
    return array();
  \}

  // Add the ranking expressions.
  _node_rankings(\$query);

  // Load results.
  \$find = \$query
    ->limit(10)
    ->execute();
  \$results = array();
  foreach (\$find as \$item) {
    // Build the node body.
    \$node = node_load(\$item->sid);
    node_build_content(\$node, 'search_result');
    \$node->body = drupal_render(\$node->content);

    // Fetch comments for snippet.
    \$node->rendered .= ' ' . module_invoke('comment', 'node_update_index', \$node);
    // Fetch terms for snippet.
    \$node->rendered .= ' ' . module_invoke('taxonomy', 'node_update_index', \$node);

    \$extra = module_invoke_all('node_search_result', \$node);

    \$results[] = array(
      'link' => url('node/' . \$item->sid, array('absolute' => TRUE)),
      'type' => check_plain(node_type_get_name(\$node)),
      'title' => \$node->title,
      'user' => theme('username', array('account' => \$node)),
      'date' => \$node->changed,
      'node' => \$node,
      'extra' => \$extra,
      'score' => \$item->calculated_score,
      'snippet' => search_excerpt(\$keys, \$node->body),
    );
  \}
  return \$results;}
}

$2