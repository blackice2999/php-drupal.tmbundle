/**
 * Implements hook_update_N().
 */
function <?php print $basename; ?>_update_N(&\$sandbox) {
  ${1:// For non-multipass updates, the signature can simply be;
  // function hook_update_N() {

  // For most updates, the following is sufficient.
  db_add_field('mytable1', 'newcol', array('type' => 'int', 'not null' => TRUE, 'description' => 'My new integer column.'));

  // However, for more complex operations that may take a long time,
  // you may hook into Batch API as in the following example.

  // Update 3 users at a time to have an exclamation point after their names.
  // (They're really happy that we can do batch API in this hook!)
  if (!isset(\$sandbox['progress'])) {
    \$sandbox['progress'] = 0;
    \$sandbox['current_uid'] = 0;
    // We'll -1 to disregard the uid 0...
    \$sandbox['max'] = db_query('SELECT COUNT(DISTINCT uid) FROM {users\}')->fetchField() - 1;
  \}

  \$users = db_select('users', 'u')
    ->fields('u', array('uid', 'name'))
    ->condition('uid', \$sandbox['current_uid'], '>')
    ->range(0, 3)
    ->orderBy('uid', 'ASC')
    ->execute();

  foreach (\$users as \$user) {
    \$user->name .= '!';
    db_update('users')
      ->fields(array('name' => \$user->name))
      ->condition('uid', \$user->uid)
      ->execute();

    \$sandbox['progress']++;
    \$sandbox['current_uid'] = \$user->uid;
  \}

  \$sandbox['#finished'] = empty(\$sandbox['max']) ? 1 : (\$sandbox['progress'] / \$sandbox['max']);

  // To display a message to the user when the update is completed, return it.
  // If you do not want to display a completion message, simply return nothing.
  return t('The update did what it was supposed to do.');

  // In case of an error, simply throw an exception with an error message.
  throw new DrupalUpdateException('Something went wrong; here is what you should do.');}
}

$2