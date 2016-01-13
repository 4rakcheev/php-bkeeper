<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 13.12.14
 * Time: 20:40
 */

class AtlantInput extends AtlantInputAbstract {

    /**
     * Renders a date text field with JS datepicker
     */
    function dateField()
    {
        // Add JS to datepicker
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/plugins/daterangepicker/daterangepicker.js", CClientScript::POS_HEAD);
        $jsDateOptions=null;
        if (isset($this->dateOptions))
            $jsDateOptions=json_encode($this->dateOptions);
        $id=CHtml::activeId($this->model,$this->attribute);
        $script = "$('#$id').datepicker({$jsDateOptions});";
        Yii::app()->clientScript->registerScript('atlant-datetimepicker-js', $script, CClientScript::POS_LOAD);

        // Append glyphicon image
        $this->appendText = '<span class="glyphicon glyphicon-calendar"></span>';

        echo $this->getLabel();
        if (isset($this->htmlOptions['class']))
            $this->htmlOptions['class'] .= ' datepicker';
        else
            $this->htmlOptions['class'] = 'datepicker';

        echo '<div class="input-group">';
        echo $this->getPrepend();
        echo $this->form->textField($this->model, $this->attribute, $this->htmlOptions);
        echo $this->getAppend();
        //echo $this->getError().$this->getHint();
        echo '</div>';
    }

    /**
     * Renders a checkbox.
     * @return string the rendered content
     */
    protected function checkBox()
    {
        if (isset($this->htmlOptions['class']))
            $this->htmlOptions['class'] .= ' icheckbox';
        else
            $this->htmlOptions['class'] = 'icheckbox';

        self::registerCheckboxJS();

        $attribute = $this->attribute;
        echo '<label class="check" for="'.$this->getAttributeId($attribute).'">';
        echo $this->form->checkBox($this->model, $attribute, $this->htmlOptions);
        echo ' '.$this->model->getAttributeLabel($attribute).'</label>';
        //echo $this->getError().$this->getHint();
    }

    public static function registerCheckboxJS()
    {
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/plugins/icheck/icheck.min.js", CClientScript::POS_END);
        $jsDateOptions=null;
        $iCheckOptions=array(
            'checkboxClass'=>'icheckbox_minimal-grey',
            'radioClass'=>'iradio_minimal-grey',
        );
        $jsiCheckOptions=json_encode($iCheckOptions);
        $script="$('.icheckbox,.iradio').iCheck($jsiCheckOptions);";
        Yii::app()->clientScript->registerScript('atlant-icheck-js', $script, CClientScript::POS_LOAD);
    }
    /**
     * Renders a list of checkboxes.
     * @return string the rendered content
     */
    protected function checkBoxList()
    {
        // TODO: Implement checkBoxList() method.
    }

    /**
     * Renders a list of inline checkboxes.
     * @return string the rendered content
     */
    protected function checkBoxListInline()
    {
        // TODO: Implement checkBoxListInline() method.
    }

    /**
     * Renders a drop down list (select).
     * @return string the rendered content
     */
    protected function dropDownList()
    {
        if (isset($this->htmlOptions['class']))
            $this->htmlOptions['class'] .= ' select';
        else
            $this->htmlOptions['class'] = 'select';

        self::registerSelectJS();

        echo $this->getLabel();
        echo $this->form->dropDownList($this->model, $this->attribute, $this->data, $this->htmlOptions);
    }

    public static function registerSelectJS()
    {
        // Add JS
        Yii::app()->clientScript->registerScriptFile(Yii::app()->theme->baseUrl."/js/plugins/bootstrap/bootstrap-select.js", CClientScript::POS_END);
        $script=<<<EOD
// Select JS
if($(".select").length > 0){
    $(".select").selectpicker();
    $(".select").on("change", function(){
        if($(this).val() == "" || null === $(this).val()){
            if(!$(this).attr("multiple"))
                $(this).val("").find("option").removeAttr("selected").prop("selected",false);
        }else{
            $(this).find("option[value="+$(this).val()+"]").attr("selected",true);
        }
    });
};
EOD;
        Yii::app()->clientScript->registerScript('atlant-select-js', $script, CClientScript::POS_LOAD);
    }

    /**
     * Renders a file field.
     * @return string the rendered content
     */
    protected function fileField()
    {
        // TODO: Implement fileField() method.
    }

    /**
     * Renders a password field.
     * @return string the rendered content
     */
    protected function passwordField()
    {
        // TODO: Implement passwordField() method.
    }

    /**
     * Renders a radio button.
     * @return string the rendered content
     */
    protected function radioButton()
    {
        // TODO: Implement radioButton() method.
    }

    /**
     * Renders a list of radio buttons.
     * @return string the rendered content
     */
    protected function radioButtonList()
    {
        // TODO: Implement radioButtonList() method.
    }

    /**
     * Renders a list of inline radio buttons.
     * @return string the rendered content
     */
    protected function radioButtonListInline()
    {
        //echo $this->getLabel();
        //echo '<div class="controls">';
        echo $this->form->radioButtonList($this->model, $this->attribute, $this->data, $this->htmlOptions);
        //echo $this->getError().$this->getHint();
        //echo '</div>';
    }

    /**
     * Renders a textarea.
     * @return string the rendered content
     */
    protected function textArea()
    {
        // TODO: Implement textArea() method.
    }

    /**
     * Renders a text field.
     * @return string the rendered content
     */
    protected function textField()
    {
        echo $this->getLabel();
        echo '<div class="input-group">';
        echo $this->getPrepend();
        echo $this->form->textField($this->model, $this->attribute, $this->htmlOptions);
        echo $this->getAppend();
        //echo $this->getError().$this->getHint();
        echo '</div>';
    }

    /**
     * Renders a CAPTCHA.
     * @return string the rendered content
     */
    protected function captcha()
    {
        // TODO: Implement captcha() method.
    }

    /**
     * Renders an uneditable field.
     * @return string the rendered content
     */
    protected function uneditableField()
    {
        // TODO: Implement uneditableField() method.
    }

}
