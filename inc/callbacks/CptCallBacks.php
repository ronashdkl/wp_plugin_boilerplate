<?php


namespace Inc\callbacks;


use Inc\base\BaseController;

class CptCallBacks extends BaseController
{
    public function view()
    {
        return $this->render('admin/cpt');
    }

    public function sanitize($input)
    {

        $output = get_option(self::generateName('plugin_cpt'));

        foreach ($output as $key => $value) {
            if ($input['post_type'] === $key) {
                $output[$key] = $input;
            } else {
                $output[$input['post_type']] = $input;
            }
        }

        return $output;
    }

    /**
     * @return string
     */
    public function section()
    {
        echo  'Manage your custom post types';
        return;
    }

    public function textField( $args )
    {
        $name = $args['label_for'];
        $option_name = $args['option_name'];
        $input = get_option( $option_name );

        echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="" placeholder="' . $args['placeholder'] . '">';
    }

    public function checkboxField( $args )
    {
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $checkbox = get_option( $option_name );

        echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class=""><label for="' . $name . '"><div></div></label></div>';
    }
}