<?php


namespace Inc\callbacks\forms;

/**
 * Class SanitizerCallBack
 * @package RonashPlugin
 */
class SanitizerCallBack
{
    public function checkboxSanitize($input)
    {
        return $input;
    }

    public function checkboxField($args)
    {

        $checkbox = get_option($args['label_for']) ? 'checked' : '';

        echo '<div class="' . $args['class'] . '">
                <input type="checkbox" id="' . $args['label_for'] . '" name="' . $args['label_for'] . '" value="1" ' . $checkbox . '  class="' . $checkbox . '"><label for="' . $args['label_for'] . '">
                <div></div>
                </label></div>';
        return;


    }
}