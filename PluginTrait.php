<?php

namespace soluto\plugin;

use yii\helpers\Json;

trait PluginTrait
{
    /**
     * @var string the plugin name
     */
    public $pluginName;

    /**
     * @var array the plugin name
     */
    public $pluginOptions = [];

    /**
     * Register plugin options
     * @param string $id
     * @return void
     */
    public function registerPlugin($id)
    {
        $view = $this->getView();
        $options = $this->pluginOptions ? Json::encode($this->pluginOptions) : '';

        foreach ($this->assets() as $class) {
            $class::register($view);
        }

        $view->registerJs("jQuery('#$id').{$this->pluginName}($options);");
    }

    /**
     * Returns the asset class name dependencies
     * @return array the asset dependencies
     */
    protected function assets()
    {
        return [];
    }

}
