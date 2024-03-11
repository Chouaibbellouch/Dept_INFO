<?php
/* Active / Install Button Manager */
function htcontactform_plugin_button( $location, $slug ){

    if( htcontactform_is_plugins_active( $location ) ) {
        if( ! current_user_can( 'activate_plugins' ) ) { return; }

        $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $location . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $location );

        $button = sprintf( '<a href="%s" class="htcontact-form-btn">%s</a>', $activation_url, __( 'Activate Now', 'ht-contactform' ) );

        $button = sprintf( '<a href="%s" class="htcontact-form-btn"><span class="htcontact-form-btn-text">%s</span><span class="htcontact-form-btn-icon">%s</span></a>', $activation_url, __( 'Enable These Features', 'ht-contactform' ), '<img src="'.HTCONTACTFORM_PL_URL.'assets/images/icon/plus.png" alt="'.esc_attr__('Enable These Features','ht-contactform').'">' );

    } else {
        if ( ! current_user_can( 'install_plugins' ) ) { return; }
        $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin='.$slug ), 'install-plugin_'.$slug );
        
        $button = sprintf( '<a href="%s" class="htcontact-form-btn"><span class="htcontact-form-btn-text">%s</span><span class="htcontact-form-btn-icon">%s</span></a>', $install_url, __( 'Enable These Features', 'ht-contactform' ), '<img src="'.HTCONTACTFORM_PL_URL.'assets/images/icon/plus.png" alt="'.esc_attr__('Enable These Features','ht-contactform').'">' );

    }
    return $button;

}

/*Add Menu*/
function htcontactform_add_menu(){
    global $submenu;

    $menu_parent_hook = add_menu_page(
        esc_html__( 'HT Contact Form', 'ht-contactform' ),
        esc_html__( 'HT Contact Form', 'ht-contactform' ), 
        'manage_options',
        'htcontact-form',
        'htcontactform_dashboard',
        'dashicons-email-alt',
        30
    );

    add_action( 'load-' . $menu_parent_hook, 'htcontactform_init_hooks' );

}
add_action( 'admin_menu', 'htcontactform_add_menu', 20 );

/* Menu Hook */
function htcontactform_init_hooks() {
    add_action( 'admin_enqueue_scripts', 'htcontactform_enqueue_scripts' );
}

/* Load Assets*/
function htcontactform_enqueue_scripts() {
    wp_enqueue_style( 'htcontact-form-admin', HTCONTACTFORM_PL_URL.'assets/css/htcontact-form-admin.css', array(), '1.0.0' );

    // Hide All Admin Notices
    echo '<style>.update-nag, .updated, .error, .is-dismissible { display: none; }</style>';

}

/* Extension Features HTML */
function htcontactform_dashboard(){
    ?>
    <div class="htcontact-form-setting-area">

        <div class="htcontact-form-features-area">

            <?php  if ( ( htcontactform_is_plugins_active( 'extensions-for-cf7/extensions-for-cf7.php' ) && is_plugin_inactive( 'extensions-for-cf7/extensions-for-cf7.php' ) ) || ! htcontactform_is_plugins_active( 'extensions-for-cf7/extensions-for-cf7.php' ) ) : ?>
                <div class="htcontact-form-free-features">
                    <h2><?php echo esc_html__( 'Enable These Features', 'ht-contactform' ); ?></h2>
                    <div class="htcontact-form-features">

                        <h3><?php echo esc_html__('Contact form 7 database','ht-contactform'); ?></h3>
                        <ul class="htcontact-form-feature-list">
                            <li><?php echo esc_html__('Save contact form submission data and handle it through the dashboard.','ht-contactform'); ?></li>
                            <li><?php echo esc_html__('Export and import CSV files easily.','ht-contactform'); ?></li>
                            <li><?php echo esc_html__('Search the contact form submissions time and date wise.','ht-contactform'); ?></li>
                            <li><?php echo esc_html__('Delete Submission Data.','ht-contactform'); ?></li>
                        </ul>

                        <h3><?php echo esc_html__('Contact form 7 conditional field','ht-contactform'); ?></h3>
                        <ul class="htcontact-form-feature-list">
                            <li><?php echo esc_html__('Easily apply conditions to any field to show or hide.','ht-contactform'); ?></li>
                            <li><?php echo esc_html__('Add multiple AND conditions.','ht-contactform'); ?></li>
                            <li><?php echo esc_html__('Easily apply conditions with the exact value.','ht-contactform'); ?></li>
                        </ul>

                        <h3><?php echo esc_html__('Contact form 7 redirection','ht-contactform'); ?></h3>
                        <ul class="htcontact-form-feature-list">
                            <li><?php echo esc_html__('Easily redirect to any page after form submission.','ht-contactform'); ?></li>
                            <li><?php echo esc_html__('Redirect the page to a new tab.','ht-contactform'); ?></li>
                            <li><?php echo esc_html__('Add specific JavaScript action.','ht-contactform'); ?></li>
                        </ul>

                    </div>
                    <?php echo htcontactform_plugin_button( 'extensions-for-cf7/extensions-for-cf7.php', 'extensions-for-cf7' ); ?>
                </div>
            <?php else: ?>
                <div class="htcontact-form-free-features">
                    <h2><?php echo esc_html__( 'Purchase CF7 Pro Extensions', 'ht-contactform' ); ?></h2>
                    <div class="htcontact-form-features">
                        <ul class="htcontact-form-feature-list">
                            <li><?php echo esc_html__( 'Already Submitted Notice', 'ht-contactform' ); ?></li>
                            <li><?php echo esc_html__( 'Repeater Field', 'ht-contactform' ); ?></li>
                            <li><?php echo esc_html__( 'Popup Form Response', 'ht-contactform' ); ?></li>
                            <li><?php echo esc_html__( 'Advanced Telephone', 'ht-contactform' ); ?></li>
                            <li><?php echo esc_html__( 'Acceptance Field', 'ht-contactform' ); ?></li>
                            <li><?php echo esc_html__( 'Drag & Drop File Upload', 'ht-contactform' ); ?></li>
                        </ul>
                    </div>
                    <a class="htcontact-form-btn" href="<?php echo esc_url('https://hasthemes.com/plugins/cf7-extensions/?utm_source=htcontactform&utm_medium=htcf7dashboard&utm_campaign=extension');?>" target="_blank">
                        <span class="htcontact-form-btn-text"><?php echo esc_html__('Get Pro Now','ht-contactform'); ?></span>
                        <span class="htcontact-form-btn-icon"><img src="<?php echo HTCONTACTFORM_PL_URL ?>assets/images/icon/plus.png" alt="<?php echo esc_attr__('Get Pro Now','ht-contactform'); ?>"></span>
                    </a>
                </div>
            <?php endif; ?>

            <div class="htcontact-form-pro-features">
                <h2><?php echo esc_html__( 'Purchase CF7 Pro Extensions', 'ht-contactform' ); ?></h2>
                <div class="htcontact-form-features">
                    <ul class="htcontact-form-feature-list">
                        <li><?php echo esc_html__( 'Already Submitted Notice', 'ht-contactform' ); ?></li>
                        <li><?php echo esc_html__( 'Repeater Field', 'ht-contactform' ); ?></li>
                        <li><?php echo esc_html__( 'Popup Form Response', 'ht-contactform' ); ?></li>
                        <li><?php echo esc_html__( 'Advanced Telephone', 'ht-contactform' ); ?></li>
                        <li><?php echo esc_html__( 'Acceptance Field', 'ht-contactform' ); ?></li>
                        <li><?php echo esc_html__( 'Drag & Drop File Upload', 'ht-contactform' ); ?></li>
                    </ul>
                </div>

                <div class="htcontact-form-action-btn">
                    <a class="htcontact-form-btn" href="<?php echo esc_url('https://hasthemes.com/plugins/cf7-extensions/?utm_source=htcontactform&utm_medium=htcf7dashboard&utm_campaign=extension');?>" target="_blank">
                        <span class="htcontact-form-btn-text"><?php echo esc_html__('Get Pro Now','ht-contactform'); ?></span>
                        <span class="htcontact-form-btn-icon"><img src="<?php echo HTCONTACTFORM_PL_URL ?>assets/images/icon/white-plus.png" alt="<?php echo esc_attr__('Get Pro Now','ht-contactform'); ?>"></span>
                    </a>
                </div>

            </div>

        </div>

    </div>
    <?php
}