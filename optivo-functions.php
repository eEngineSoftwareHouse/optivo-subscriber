<?php

    function optivo_activation()
    {
        $old_version = get_option('OPTIVO_VERSION');
        if ($old_version != OPTIVO_VERSION) {
            update_option('OPTIVO_VERSION', OPTIVO_VERSION);
        }
    }

    add_action( 'admin_menu', 'my_admin_menu' );
    function my_admin_menu() {
        add_menu_page('Optivo Subscriber', 'Optivo', 'administrator', __FILE__, 'optivo_admin_page', OPTIVO_URL."/admin/assets/images/icon.png");
    }

    function optivo_admin_page(){
        include_once('admin/settings.php');
    }

    add_action('init', 'optivo_support');
    function optivo_support() {
        if (!is_admin()) {
            wp_enqueue_script('optivo_support', plugins_url('/assets/js/optivo_support.js',__FILE__) );
        }
    }

    add_action( 'admin_init', 'optivo_settings_init' );
    function optivo_settings_init(  ) {

        register_setting( 'pluginPage', 'op_settings' );
        add_settings_section(
            'op_pluginPage_section',
            __( 'Setting up Your optivo plugin', 'wordpress' ),
            '',
            'pluginPage'
        );
        add_settings_field(
            'op_text_field_0',
            __( 'Authorization ID', 'wordpress' ),
            'op_text_field_0_render',
            'pluginPage',
            'op_pluginPage_section'
        );
        add_settings_field(
            'op_text_field_00',
            __( 'DOI ID', 'wordpress' ),
            'op_text_field_00_render',
            'pluginPage',
            'op_pluginPage_section'
        );
        add_settings_field(
            'op_checkbox_field_1',
            __( 'Show rules', 'wordpress' ),
            'op_checkbox_field_1_render',
            'pluginPage',
            'op_pluginPage_section'
        );
        add_settings_field(
            'op_textarea_field_2',
            __( 'Rules', 'wordpress' ),
            'op_textarea_field_2_render',
            'pluginPage',
            'op_pluginPage_section'
        );
        add_settings_field(
            'op_text_field_3',
            __( 'Save button text', 'wordpress' ),
            'op_text_field_3_render',
            'pluginPage',
            'op_pluginPage_section'
        );
        add_settings_field(
            'op_text_field_4',
            __( 'Wrong e-mail text', 'wordpress' ),
            'op_text_field_4_render',
            'pluginPage',
            'op_pluginPage_section'
        );
        add_settings_field(
            'op_text_field_5',
            __( 'Success text', 'wordpress' ),
            'op_text_field_5_render',
            'pluginPage',
            'op_pluginPage_section'
        );
        add_settings_field(
            'op_text_field_6',
            __( 'Error text', 'wordpress' ),
            'op_text_field_6_render',
            'pluginPage',
            'op_pluginPage_section'
        );
        add_settings_field(
            'op_text_field_7',
            __( 'User on black list text', 'wordpress' ),
            'op_text_field_7_render',
            'pluginPage',
            'op_pluginPage_section'
        );
        add_settings_field(
            'op_text_field_8',
            __( 'Rules not accepted text', 'wordpress' ),
            'op_text_field_8_render',
            'pluginPage',
            'op_pluginPage_section'
        );
    }

    function op_text_field_0_render() {
        $options = get_option( 'op_settings' );
        echo '<input type="text" name="op_settings[op_text_field_0]" value="'.$options['op_text_field_0'].'">';
    }

    function op_text_field_00_render() {
        $options = get_option( 'op_settings' );
        echo '<input type="text" name="op_settings[op_text_field_00]" value="'.$options['op_text_field_00'].'">';
    }

    function op_text_field_3_render() {
        $options = get_option( 'op_settings' );
        echo '<input type="text" name="op_settings[op_text_field_3]" value="'.$options['op_text_field_3'].'">';
    }

    function op_text_field_4_render() {
        $options = get_option( 'op_settings' );
        echo '<input type="text" name="op_settings[op_text_field_4]" value="'.$options['op_text_field_4'].'">';
    }

    function op_text_field_5_render() {
        $options = get_option( 'op_settings' );
        echo '<input type="text" name="op_settings[op_text_field_5]" value="'.$options['op_text_field_5'].'">';
    }

    function op_text_field_6_render() {
        $options = get_option( 'op_settings' );
        echo '<input type="text" name="op_settings[op_text_field_6]" value="'.$options['op_text_field_6'].'">';
    }

    function op_text_field_7_render() {
        $options = get_option( 'op_settings' );
        echo '<input type="text" name="op_settings[op_text_field_7]" value="'.$options['op_text_field_7'].'">';
    }

    function op_text_field_8_render() {
        $options = get_option( 'op_settings' );
        echo '<input type="text" name="op_settings[op_text_field_8]" value="'.$options['op_text_field_8'].'">';
    }

    function op_checkbox_field_1_render() {
        $options = get_option( 'op_settings' ); ?>
        <input type='checkbox' name='op_settings[op_checkbox_field_1]' <?php checked( $options['op_checkbox_field_1'], 1 ); ?> value='1'>
    <?php
    }


    function op_textarea_field_2_render() {
        $options = get_option( 'op_settings' );
        echo '<textarea cols="40" rows="5" name="op_settings[op_textarea_field_2]">'.$options['op_textarea_field_2'].'</textarea>';
    }

    function op_options_page() {
        echo '<form action="options.php" method="post">';
        echo '<h2>Optivo Settings</h2><hr>';
                settings_fields( 'pluginPage' );
                do_settings_sections( 'pluginPage' );
                submit_button();
        echo '</form>';
    }

    function optivo_form() {
        $options = get_option( 'op_settings' );
        echo '<form id="optivo_subs_form" data-wrong-email="'.$options['op_text_field_4'].'" action="" method="post">';
        echo '<div id="optivo_message"></div>';
        echo '<input type="text" class="field" value="" name="optivo_subs_email" placeholder="e-mail">';
        echo '<button type="button" name="optivo_subscribe_button" class="form_subscribe_button button">'.$options['op_text_field_3'].'</button>';
        if($options['op_checkbox_field_1'] == 1){
            echo '<br><label id="optivo_rules"><input id="accept_rules" type="checkbox" name="accept_rules" data-rules-error="'.$options['op_text_field_8'].'">'.$options['op_textarea_field_2'].'</label>';
        }
        echo '</form>';
    }
    add_shortcode('OPTIVO', 'optivo_form');
?>
