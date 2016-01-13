<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 16.12.14
 * Time: 20:31
 */

abstract class AtlantInputAbstract extends TbInput
{
    const TYPE_DATE = 'date';

    public $dateOptions=array();

    protected function processHtmlOptions()
    {
        if (isset($this->htmlOptions['dateOptions'])) {
            $this->dateOptions = $this->htmlOptions['dateOptions'];
            unset($this->htmlOptions['dateOptions']);
        }

        if (self::isMayRequired($this->type) && $this->model->isAttributeRequired($this->attribute)) {
            $this->htmlOptions['style'] = 'cursor: auto; background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAASCAYAAABSO15qAAAABmJLR0QA/wD/AP+gvaeTAAAACXBIWXMAAAsTAAALEwEAmpwYAAAAB3RJTUUH3QsPDhss3LcOZQAAAU5JREFUOMvdkzFLA0EQhd/bO7iIYmklaCUopLAQA6KNaawt9BeIgnUwLHPJRchfEBR7CyGWgiDY2SlIQBT/gDaCoGDudiy8SLwkBiwz1c7y+GZ25i0wnFEqlSZFZKGdi8iiiOR7aU32QkR2c7ncPcljAARAkgckb8IwrGf1fg/oJ8lRAHkR2VDVmOQ8AKjqY1bMHgCGYXhFchnAg6omJGcBXEZRtNoXYK2dMsaMt1qtD9/3p40x5yS9tHICYF1Vn0mOxXH8Uq/Xb389wff9PQDbQRB0t/QNOiPZ1h4B2MoO0fxnYz8dOOcOVbWhqq8kJzzPa3RAXZIkawCenHMjJN/+GiIqlcoFgKKq3pEMAMwAuCa5VK1W3SAfbAIopum+cy5KzwXn3M5AI6XVYlVt1mq1U8/zTlS1CeC9j2+6o1wuz1lrVzpWXLDWTg3pz/0CQnd2Jos49xUAAAAASUVORK5CYII=); background-attachment: scroll; background-position: 100% 50%; background-repeat: no-repeat;';
        }

        if (isset($this->htmlOptions['class']))
            $this->htmlOptions['class'] .= ' form-control';
        else
            $this->htmlOptions['class'] = 'form-control';

        parent::processHtmlOptions();
    }

    /**
     * Проверяет можно ли переданному типу устанавливать знак обязательности
     * @param $inputType
     * @return bool
     */
    protected static function isMayRequired($inputType)
    {
        switch ($inputType) {
            case self::TYPE_RADIO:
            case self::TYPE_RADIOLIST:
            case self::TYPE_RADIOLIST_INLINE:
                return false;
            default:
                return true;
        }
    }

    /**
     * Runs the widget.
     */
    public function run()
    {
        echo CHtml::openTag('div', array('class'=>'form-group '.$this->getContainerCssClass()));
        switch ($this->type) {
            case self::TYPE_DATE:
                $this->dateField();
                break;
            default:
                parent::run();
        }
        echo '</div>';
    }

    protected function getLabel()
    {
        if ($this->label !== false && !in_array($this->type, array('checkbox', 'radio')) && $this->hasModel())
            return $this->form->label($this->model, $this->attribute, $this->labelOptions);
        else if ($this->label !== null)
            return $this->label;
        else
            return '';
    }

    protected function getAppend()
    {
        if ($this->hasAddOn()) {
            $htmlOptions = $this->appendOptions;

            if (isset($htmlOptions['class']))
                $htmlOptions['class'] .= ' input-group-addon';
            else
                $htmlOptions['class'] = 'input-group-addon';

            ob_start();
            if (isset($this->appendText))
                echo CHtml::tag('span', $htmlOptions, $this->appendText);
            return ob_get_clean();
        }
        else
            return '';
    }

    protected function getPrepend()
    {
        if ($this->hasAddOn())
        {
            $htmlOptions = $this->prependOptions;

            if (isset($htmlOptions['class']))
                $htmlOptions['class'] .= ' input-group-addon';
            else
                $htmlOptions['class'] = 'input-group-addon';

            ob_start();
            if (isset($this->prependText))
                echo CHtml::tag('span', $htmlOptions, $this->prependText);
            return ob_get_clean();
        }
        else
            return '';
    }

    /*
    protected function getAddonCssClass()
    {
        return 'input-group';
    }
    // */

    abstract protected function dateField();

} 
