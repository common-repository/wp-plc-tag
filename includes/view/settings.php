<?php
?>
<div class="plc-admin">
    <div class="plc-settings-wrapper">
        <!-- Header START -->
        <div class="plc-settings-header">
            <div class="plc-settings-header-main">
                <div class="plc-settings-header-col header-col-first">
                    <div class="plc-settings-header-main-title">
                        WP PLC Tag <small>Version <?=(defined('WPPLC_TAG_VERSION')) ? WPPLC_TAG_VERSION : '(unknown)'?></small>
                    </div>
                </div>
                <div class="plc-settings-header-col header-col-second">
                    <img src="<?=plugins_url('assets/img/icon.png', WPPLC_TAG_MAIN_FILE)?>" />
                </div>
                <div class="plc-settings-header-col header-col-third">
                    <?=__('Need help?','wp-plc-tag')?>
                </div>
            </div>
        </div>
        <!-- Header END -->
        <main class="plc-admin-main">
            <!-- Menu START -->
            <div class="plc-admin-menu-container">
                <nav class="plc-admin-menu" style="width:70%; float:left;">
                    <ul class="plc-admin-menu-list">
                        <li class="plc-admin-menu-list-item">
                            <a href="#/general">
                                <?=__('Settings','wp-plc-tag')?>
                            </a>
                        </li>
                        <?php if(get_option('plctag_elementor_active') == true) { ?>
                        <li class="plc-admin-menu-list-item">
                            <a href="#/elementor">
                                <?=__('Elementor','wp-plc-tag')?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                </nav>
                <div class="plc-admin-alert-container" style="float:left; width:30%; padding:40px 0 40px 0;">

                </div>
            </div>
            <!-- Menu END -->

            <!-- Content START -->
            <div class="plc-admin-page-container" style="width:100%; display: inline-block; float: left;">
                <?php wp_nonce_field( 'oneplace-settings-update' ); ?>
                <?php
                // Include Settings Pages
                require_once __DIR__.'/settings/general.php';
                if(get_option('plctag_elementor_active') == 1) {
                    // Include Elementor Settings
                    require_once __DIR__.'/settings/elementor.php';
                }
                ?>
            </div>
            <!-- Content END -->
        </main>
    </div>
</div>