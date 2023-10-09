<?php
// Step 1: Register the settings
function disclaimer_register_settings() {
    // Register a new section
    add_settings_section('disclaimer_plugin_section', 'Disclaimer Plugin Settings', 'my_plugin_section_callback', 'disclaimer');

    // Register a field for the textarea
    add_settings_field('my_plugin_textarea', 'Popup Content', 'my_plugin_textarea_callback', 'disclaimer', 'disclaimer_plugin_section');

    // Register a field for post types
    add_settings_field('my_plugin_post_types', 'Post Types', 'my_plugin_post_types_callback', 'disclaimer', 'disclaimer_plugin_section');

    // Register the settings
    register_setting('disclaimer', 'disclaimer_settings');
}
add_action('admin_init', 'disclaimer_register_settings');

// Step 2: Define the callback functions
function my_plugin_section_callback() {
    echo '<p>Settings for disclaimer popup sections.</p>';
}

function my_plugin_textarea_callback() {
    $options = get_option('disclaimer_settings');
    echo "<textarea id='my_plugin_textarea' name='disclaimer_settings[textarea_field]' rows='5' cols='50'>{$options['textarea_field']}</textarea>";
}

function my_plugin_post_types_callback() {
    $options = get_option('disclaimer_settings');
    $post_types = get_post_types(array('public' => true), 'objects');
    $args = array(
        'public'   => true,
        '_builtin' => false
    );

    //$post_types = get_post_types( $args );
    //print_r($post_types);

   // echo "<pre>"; print_r($post_types);
    //die;
    foreach ($post_types as $post_type) {
        
        if ($post_type->name != 'attachment') {
            $checked = isset($options['post_types'][$post_type->name]) ? 'checked' : '';
            echo "<label><input type='checkbox' name='disclaimer_settings[post_types][{$post_type->name}]' value='1' {$checked}> {$post_type->label}</label><br>";
        }
    }
}
// Step 3: Add the settings page
function my_plugin_settings_page() {
    ?>
    <div class="wrap">
        <form method="post" action="options.php">
            <?php settings_fields('disclaimer'); ?>
            <?php do_settings_sections('disclaimer'); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

function my_plugin_add_settings_page() {
    add_options_page(
        'Disclaimer Settings',
        'Disclaimer Plugin',
        'manage_options',
        'disclaimer-plugin-setting',
        'my_plugin_settings_page'
    );
}
add_action('admin_menu', 'my_plugin_add_settings_page');
