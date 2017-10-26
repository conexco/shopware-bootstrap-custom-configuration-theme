<?php
/**
 * Created by PhpStorm.
 * User: swieland
 * Date: 25.10.17
 * Time: 13:18
 */

namespace Shopware\Themes\ModifiedConfigurationTheme;


use Shopware\Components\Form;

class Theme extends \Shopware\Components\Theme
{
    protected $extend = 'BootstrapBare';

    protected $name = 'Modified Configuration Theme';

    protected $description = 'An example that shows how to modify a theme\'s configuration in the Theme Manager';

    protected $author = 'conexco';

    protected $license = 'MIT';


    /** @var  Form\Container\Tab */
    private $deviceBreakpointTab;

    /** @var  Form\Container\FieldSet */
    private $deviceBreakpointFieldSet;

    /**
     * @param Form\Container\TabContainer $container
     */
    public function createConfig(Form\Container\TabContainer $container)
    {
        $this->createFieldSets($container);

        /** @var Form\Container\Tab $tab */
        foreach ($container->getElements() as $tab) {
            switch ($tab->getName()) {
                case 'general':
                    $this->modifyGeneralTab($tab);
                    break;
            }
        }
    }

    /**
     * Find and modify the extendThemeConfigs fieldset
     * @param Form\Container\Tab $tab
     */
    private function modifyGeneralTab(Form\Container\Tab $tab)
    {
        /** @var Form\Container\FieldSet $fieldSet */
        foreach ($tab->getElements() as $fieldSet) {
            switch ($fieldSet->getName()) {
                case 'extendedThemeConfigs':
                    $this->modifyExtendedThemeConfigs($fieldSet);
                    break;
            }
        }
    }

    /**
     * Move specified fields into new fieldset
     * @param Form\Container\FieldSet $fieldSet
     */
    private function modifyExtendedThemeConfigs(Form\Container\FieldSet $fieldSet)
    {
        /** @var Form\Field $field */
        foreach ($fieldSet->getElements() as $field) {
            switch ($field->getName()) {
                case 'swf-screen-lg-min':
                case 'swf-screen-md-min':
                case 'swf-screen-hd-min':
                case 'swf-screen-sm-min':
                    $this->unHideField($field);
                    $fieldSet->getElements()->remove($field);
                    $this->deviceBreakpointFieldSet->addElement($field);
                    break;
                // ...
            }
        }
    }

    /**
     * Remove xtype from fields
     * @param Form\Field $field
     */
    private function unHideField(Form\Field $field)
    {
        $attributes = $field->getAttributes();
        unset($attributes['xtype']);
        $field->setAttributes($attributes);
    }

    /**
     * Create new tab with fieldset
     * @param Form\Container\TabContainer $container
     */
    private function createFieldSets(Form\Container\TabContainer $container)
    {
        $this->deviceBreakpointTab = $this->createTab('deviceBreakpoints', 'Device breakpoints', ['attributes' => [
            'layout' => 'anchor',
            'autoScroll' => true,
        ]]);
        $container->addTab($this->deviceBreakpointTab);

        $this->deviceBreakpointFieldSet = $this->createFieldSet('deviceBreakpoints', 'Device breakpoints');
        $this->deviceBreakpointTab->addElement($this->deviceBreakpointFieldSet);
    }
}
