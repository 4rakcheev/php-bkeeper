<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 13.12.14
 * Time: 20:13
 */
Yii::import('bootstrap.widgets.*');
Yii::import('bootstrap.widgets.input.*');

class AtlantActiveForm extends TbActiveForm {

    // Form types
    const TYPE_ALANT = 'atlant_basic';

    // Input classes
    const INPUT_ATLANT = 'frontend.extensions.widgets.AtlantInput';

    /**
     * Renders a text field input row.
     * @param CModel $model the data model
     * @param string $attribute the attribute
     * @param array $htmlOptions additional HTML attributes
     * @return string the generated row
     */
    public function textDateFieldRow($model, $attribute, $htmlOptions = array())
    {
        return $this->inputRow(AtlantInput::TYPE_DATE, $model, $attribute, null, $htmlOptions);
    }

    public function inputRow($type, $model, $attribute, $data = null, $htmlOptions = array())
    {
        $widgetOptions=array(
            'form'=>$this,
            'type'=>$type,
            'model'=>$model,
            'attribute'=>$attribute,
            'data'=>$data,
        );
        if (isset($htmlOptions['widgetOptions'])) {
            $widgetOptions=array_merge($htmlOptions['widgetOptions'], $widgetOptions);
            unset($htmlOptions['widgetOptions']);
        }
        $widgetOptions['htmlOptions']=$htmlOptions;
        ob_start();
        $this->getOwner()->widget($this->getInputClassName(), $widgetOptions);
        return ob_get_clean();
    }

    /**
     * @todo Checklist
     *
     * @param bool $checkbox
     * @param CModel $model
     * @param string $attribute
     * @param array $data
     * @param array $htmlOptions
     * @return string
     */
    protected function inputsList($checkbox, $model, $attribute, $data, $htmlOptions = array())
    {
        if (isset($htmlOptions['class']))
            $htmlOptions['class'] .= $checkbox ? ' icheckbox' : ' iradio';
        else
            $htmlOptions['class'] = $checkbox ? 'icheckbox' : 'iradio';

        CHtml::resolveNameID($model, $attribute, $htmlOptions);
        $select = CHtml::resolveValue($model, $attribute);


        if ($model->hasErrors($attribute))
        {
            if (isset($htmlOptions['class']))
                $htmlOptions['class'] .= ' '.CHtml::$errorCss;
            else
                $htmlOptions['class'] = CHtml::$errorCss;
        }

        $name = $htmlOptions['name'];
        unset($htmlOptions['name']);

        if (array_key_exists('uncheckValue', $htmlOptions))
        {
            $uncheck = $htmlOptions['uncheckValue'];
            unset($htmlOptions['uncheckValue']);
        }
        else
            $uncheck = '';

        $hiddenOptions = isset($htmlOptions['id']) ? array('id' => CHtml::ID_PREFIX.$htmlOptions['id']) : array('id' => false);
        $hidden = $uncheck !== null ? CHtml::hiddenField($name, $uncheck, $hiddenOptions) : '';

        if (isset($htmlOptions['template']))
            $template = $htmlOptions['template'];
        else
            $template = '<label class="{labelCssClass}">{input} {label}</label>';

        unset($htmlOptions['template'], $htmlOptions['separator'], $htmlOptions['hint']);

        if ($checkbox && substr($name, -2) !== '[]')
            $name .= '[]';

        unset($htmlOptions['checkAll'], $htmlOptions['checkAllLast']);

        //$labelOptions = isset($htmlOptions['labelOptions']) ? $htmlOptions['labelOptions'] : array();
        //unset($htmlOptions['labelOptions']);

        $items = array();
        $baseID = CHtml::getIdByName($name);
        $id = 0;
        $method = $checkbox ? 'checkBox' : 'radioButton';
        $labelCssClass = isset($this->htmlOptions['labelCssClass']) ? $this->htmlOptions['labelCssClass'] : 'check';

        /*
        if (isset($htmlOptions['inline']))
        {
            $labelCssClass .= ' inline';
            unset($htmlOptions['inline']);
        }
        // */

        foreach ($data as $value => $label)
        {
            $checked = !is_array($select) && !strcmp($value, $select) || is_array($select) && in_array($value, $select);
            $htmlOptions['value'] = $value;
            $htmlOptions['id'] = $baseID.'_'.$id++;
            $option = CHtml::$method($name, $checked, $htmlOptions);
            //$label = CHtml::label($label, $htmlOptions['id'], $labelOptions);
            $items[] = strtr($template, array(
                    '{labelCssClass}' => $labelCssClass,
                    '{input}' => $option,
                    '{label}' => $label,
                ));
        }

        // Add JS checkboxes
        AtlantInput::registerCheckboxJS();

        return $hidden.implode('', $items);
    }

    public function errorSummary($models, $header = null, $footer = null, $htmlOptions = array())
    {
        $htmlOptions['class'] = 'alert alert-danger';
        $header='<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>';
        return parent::errorSummary($models, $header, $footer, $htmlOptions);
    }


    protected function getInputClassName()
    {
        switch ($this->type) {
            case self::TYPE_ALANT:
                return self::INPUT_ATLANT;
            default:
                return parent::getInputClassName();
        }
    }

} 
