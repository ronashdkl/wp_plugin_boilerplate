<div class="wrap">
    <h1>Ronash Plugin</h1>
    <?php settings_errors();?>

    <form method="post" action="options.php">
        <?php
        settings_fields('ronash_plugin_option_group');
        do_settings_sections('ronash_plugin');
        submit_button();
        ?>
    </form>

</div>
