<?php


namespace Inc\callbacks\forms;

use Inc\base\BaseController;
use Inc\base\Manager;

/**
 * Class SanitizerCallBack
 * @package RonashPlugin
 */
class ManagerCallBack extends BaseController
{
    public function checkboxSanitize($input)
    {
        $output = [];
        foreach (Manager::$list as $key=>$value){
            if(isset($input[$key]) && $input[$key]==true){
                $output[$key] = true;
            }else{
                $output[$key] = false;
            }
        }
        return $output;

    }
    /**
     * @return string
     */
    public function fieldsSection()
    {
        echo  'Turn on/off Managers';
        return;
    }
    public function checkboxField($args)
    {

        $checkbox = get_option($args['option_name']);

        $checked = (isset($checkbox[$args['label_for']]) && $checkbox[$args['label_for']]==true )?'checked':null;

        echo '<div class="' . $args['class'] . '">
                <input type="checkbox" id="' . $args['label_for'] . '" name="'.$args['option_name'].'['.$args['label_for'] . ']" value="1" ' . $checked . '  class="' . $checked . '"><label for="' . $args['label_for'] . '">
                <div></div>
                </label></div>';
        return;


    }
}