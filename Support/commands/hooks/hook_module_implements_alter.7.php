/**
 * Implements hook_module_implements_alter().
 */
function <?php print $basename; ?>_module_implements_alter(&\$implementations, \$hook) {
  ${1:if (\$hook == 'rdf_mapping') {
    // Move my_module_rdf_mapping() to the end of the list. module_implements()
    // iterates through \$implementations with a foreach loop which PHP iterates
    // in the order that the items were added, so to move an item to the end of
    // the array, we remove it and then add it.
    \$group = \$implementations['my_module'];
    unset(\$implementations['my_module']);
    \$implementations['my_module'] = \$group;
  \}}
}

$2