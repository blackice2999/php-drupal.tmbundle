/**
 * Implements hook_entity_info().
 */
function <?php print $basename; ?>_entity_info() {
  ${1:\$return = array(
    'node' => array(
      'label' => t('Node'),
      'controller class' => 'NodeController',
      'base table' => 'node',
      'revision table' => 'node_revision',
      'uri callback' => 'node_uri',
      'fieldable' => TRUE,
      'translation' => array(
        'locale' => TRUE,
      ),
      'entity keys' => array(
        'id' => 'nid',
        'revision' => 'vid',
        'bundle' => 'type',
      ),
      'bundle keys' => array(
        'bundle' => 'type',
      ),
      'bundles' => array(),
      'view modes' => array(
        'full' => array(
          'label' => t('Full content'),
          'custom settings' => FALSE,
        ),
        'teaser' => array(
          'label' => t('Teaser'),
          'custom settings' => TRUE,
        ),
        'rss' => array(
          'label' => t('RSS'),
          'custom settings' => FALSE,
        ),
      ),
    ),
  );

  // Search integration is provided by node.module, so search-related
  // view modes for nodes are defined here and not in search.module.
  if (module_exists('search')) {
    \$return['node']['view modes'] += array(
      'search_index' => array(
        'label' => t('Search index'),
        'custom settings' => FALSE,
      ),
      'search_result' => array(
        'label' => t('Search result'),
        'custom settings' => FALSE,
      ),
    );
  \}

  // Bundles must provide a human readable name so we can create help and error
  // messages, and the path to attach Field admin pages to.
  foreach (node_type_get_names() as \$type => \$name) {
    \$return['node']['bundles'][\$type] = array(
      'label' => \$name,
      'admin' => array(
        'path' => 'admin/structure/types/manage/%node_type',
        'real path' => 'admin/structure/types/manage/' . str_replace('_', '-', \$type),
        'bundle argument' => 4,
        'access arguments' => array('administer content types'),
      ),
    );
  \}

  return \$return;}
}

$2