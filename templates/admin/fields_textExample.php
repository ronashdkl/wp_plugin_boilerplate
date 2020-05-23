
<?php
$value = esc_attr(get_option('text_example'));
?>
<input type="text" class="regular-text" name="text_example" value="<?= $value;?>" placeholder="Write somting here">