
<?php
$value = esc_attr(get_option('first_name'));
?>
<input type="text" class="regular-text" name="first_name" value="<?= $value;?>" placeholder="First Name">