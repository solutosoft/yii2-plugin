<?php

namespace soluto\plugin;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

class SelectWidget extends InputWidget
{
    /**
     * @var array $items the option data items. The array keys are option values, and the array values
     * are the corresponding option labels.
     */
    public $items = [];

    /**
     * @var array the initial selected item
     *
     * ```php
     * 'selected' => [
     *     'id' => $model->category_id,
     *     'description' => ArrayHelper($model, 'category.description')
     * ]
     * ```
     */
    public $selected = [];

    /**
     * @inheritdoc
     */
    public function run()
    {
        $options = $this->options;
        $id = $options['id'];

        if ($this->hasModel()) {
            echo Html::activeDropDownList($this->model, $this->attribute, $this->items, $options);
        } else {
            echo Html::dropDownList($this->name, $this->value, $this->items, $options);
        }

        if (isset($options['value'])) {
            $value = $options['value'];
        } else {
            $value = $this->hasModel() ? Html::getAttributeValue($this->model, $this->attribute) : $this->value;
        }

        $this->pluginOptions['value'] = $value;
        $this->registerPlugin($id);
    }
}
