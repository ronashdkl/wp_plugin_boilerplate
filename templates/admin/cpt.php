<div class="wrap">
    <h1>Custom Post Type</h1>
    <?php settings_errors();?>

    <form method="post" action="options.php">
        <?php
        settings_fields(\Inc\base\GlobalConfig::generateName('plugin_cpt_settings'));
        do_settings_sections(\Inc\base\GlobalConfig::generateName('cpt'));
        submit_button();
        ?>
    </form>

</div>
