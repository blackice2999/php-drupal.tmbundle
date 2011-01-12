/**
 * Implements hook_field_instance_settings_form().
 */
function <?php print $basename; ?>_field_instance_settings_form(\$field, \$instance) {
  ${1:\$settings = \$instance['settings'];

  \$form['text_processing'] = array(
    '#type' => 'radios',
    '#title' => t('Text processing'),
    '#default_value' => \$settings['text_processing'],
    '#options' => array(
      t('Plain text'),
      t('Filtered text (user selects text format)'),
    ),
  );
  if (\$field['type'] == 'text_with_summary') {
    \$form['display_summary'] = array(
      '#type' => 'select',
      '#title' => t('Display summary'),
      '#options' => array(
        t('No'),
        t('Yes'),
      ),
      '#description' => t('Display the summary to allow the user to input a summary value. Hide the summary to automatically fill it with a trimmed portion from the main post. '),
      '#default_value' => !empty(\$settings['display_summary']) ? \$settings['display_summary'] :  0,
    );
  \}

  return \$form;}
}

$2