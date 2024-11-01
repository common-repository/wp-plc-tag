<article class="plc-admin-page-elementor plc-admin-page" style="padding: 10px 40px 40px 40px;">
    <h1><?=__('Elementor Settings','wp-plc-article')?></h1>
    <p>Here you find the elementor settings for tags</p>

    <h3>Elementor Widgets</h3>

    <!-- Enable Tag List -->
    <div class="plc-admin-settings-field">
        <label class="plc-settings-switch">
            <?php $bElementorTagListActive = get_option( 'plctag_elementor_tag_list_active', false ); ?>
            <input name="plctag_elementor_tag_list_active" type="checkbox" <?=($bElementorTagListActive == 1)?'checked':''?> class="plc-settings-value" />
            <span class="plc-settings-slider"></span>
        </label>
        <span>Enable Tag List</span>
    </div>
    <!-- Enable Tag List -->

    <hr/>
    <button class="plc-admin-settings-save plc-admin-btn plc-admin-btn-primary" plc-admin-page="page-elementor">Save Elementor Settings</button>
    <!-- Save Button -->
</article>