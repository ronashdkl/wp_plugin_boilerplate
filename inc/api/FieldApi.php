<?php


namespace Inc\api;

/**
 * Class FieldApi
 * @package RonashPlugin
 */
class FieldApi
{
 private $settings = [];
 private $sections = [];
 private $fields = [];

    public function registerCustomFields()
    {
        foreach ($this->settings as $setting) {
            register_setting($setting['option_group'], $setting['option_name'], $setting['callback'] ?? null);
        }
        foreach ($this->sections as $section) {
            add_settings_section($section['id'], $section['title'], $section['callback'] ?? null, $section['page']);
        }
        foreach ($this->fields as $field) {
            add_settings_field($field['id'], $field['title'], $field['callback'] ?? null, $field['page'], $field['section'], $field['args'] ?? null);
        }
    }

    /**
     * add settings
     * @param array $settings
     * @return $this
     */
    public function addSettings(array $settings = [])
    {
        if(count($settings)>0)$this->settings = $settings;
        return $this;
    }
    /**
     * add sections
     * @param array $sections
     * @return $this
     */
    public function addSections(array $sections = [])
    {
        if(count($sections)>0)$this->sections = $sections;
        return $this;
    }

    /**
     * add Fields
     * @param array $fields
     * @return $this
     */
    public function addFields(array $fields = [])
    {
        if(count($fields)>0)$this->fields = $fields;
        return $this;
    }

    /**
     * Check if settings exists
     * @return bool
     */
    public function verifySettings()
    {
        if(count($this->settings)>0)return true;else return false;
    }

}