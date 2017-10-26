<?php
/**
 * Created by PhpStorm.
 * User: swieland
 * Date: 26.10.17
 * Time: 09:58
 */

namespace Shopware\Themes\AdditionalConfigurationTheme;


use Shopware\Components\Form;

class Theme extends \Shopware\Components\Theme
{
    protected $extend = 'BootstrapBare';

    protected $name = 'Additional Configuration Theme';

    protected $description = 'An example that shows how to add additional fields to the Theme\'s configuration';

    protected $author = 'conexco';

    protected $license = 'MIT';

    /** @var Form\Container\Tab */
    private $additionalTab;

    /** @var Form\Container\FieldSet */
    private $additionalFieldSet;

    public function createConfig(Form\Container\TabContainer $container)
    {
        $this->createFieldSets($container);

        $this->createQuestionField();
    }

    private function createFieldSets(Form\Container\TabContainer $container)
    {
        $this->additionalTab = $this->createTab('additionalTab', 'Additional tab');
        $container->addTab($this->additionalTab);

        $this->additionalFieldSet = $this->createFieldSet('additionalFieldSet', 'Additional field set');
        $this->additionalTab->addElement($this->additionalFieldSet);
    }

    private function createQuestionField()
    {
        $this->additionalFieldSet->addElement(
            $this->createTextField('theQuestion', 'What\'s the question to 42?', '')
        );
    }
}