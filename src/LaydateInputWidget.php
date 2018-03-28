<?php
/**
 * Created by PhpStorm.
 * User: Choate
 * Date: 2018/3/24
 * Time: 11:47
 */

namespace choate\yii2\laydate;


use yii\helpers\FormatConverter;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

class LaydateInputWidget extends InputWidget
{
    const TYPE_YEAR = 'year';

    const TYPE_MONTH = 'month';

    const TYPE_DATE = 'date';

    const TYPE_TIME = 'time';

    const TYPE_DATETIME = 'datetime';

    const POSITION_ABSOLUTE = 'abolute';

    const POSITION_FIXED = 'fixed';

    const POSITION_STATIC = 'static';

    public $options = [
        'class' => 'form-control',
    ];

    public $clientOptions = [];

    public $type;

    public $format;

    public $range;

    public $min;

    public $max;

    public $lang;

    public $position;

    public $theme;

    public $showBottom;

    public $buttonItems;

    public $calendar;

    public $markItems;

    public $trigger;
    
    public $defaultValue;

    public function init()
    {
        parent::init();
        $this->options['id'] = $this->getInputId();
    }


    public function run()
    {
        LaydateAsset::register($this->getView());
        $this->registerLayDate();
        echo $this->renderInputHtml('input');
    }

    public function registerLayDate()
    {
        $clientOptions = array_merge($this->clientOptions, array_filter([
            'elem' => '#' . $this->getInputId(),
            'type' => $this->type,
            'format' => FormatConverter::convertDatePhpToIcu($this->format) ?: null,
            'range' => $this->range,
            'lang' => $this->lang,
            'min' => $this->min,
            'max' => $this->max,
            'position' => $this->position,
            'theme' => $this->theme,
            'showBottom' => $this->showBottom,
            'btns' => $this->buttonItems,
            'calendar' => $this->calendar,
            'mark' => $this->markItems,
            'trigger' => $this->trigger,
            'value' => $this->defaultValue,
        ], function ($value) {
            return !is_null($value);
        }));
        $clientOptionsJson = Json::encode($clientOptions);

        $this->getView()->registerJs("laydate.render({$clientOptionsJson});");
    }

    protected function getInputId()
    {
        $options = $this->options;
        if (isset($options['id'])) {
            $inputId = $options['id'];
        } elseif ($this->hasModel()) {
            $inputId = Html::getInputId($this->model, $this->attribute);
        } else {
            $inputId = $this->getId();
        }

        return $inputId;
    }
}