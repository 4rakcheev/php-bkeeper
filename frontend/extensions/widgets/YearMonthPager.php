<?php
/**
 * Created by PhpStorm.
 * User: tema
 * Date: 02.09.14
 * Time: 19:23
 */

class YearMonthPager extends CWidget {

    public $header;
    public $footer;
    public $htmlOptions;
    public $hiddenPageCssClass='disabled';
    public $selectedPageCssClass='active';
    public $internalPageCssClass='page';
    public $firstPageCssClass='first';
    public $nextPageCssClass='next';
    public $lastPageCssClass='last';
    public $previousPageCssClass='previous';

    private $_currentMonth;
    private $_currentYear;

    public $urlRoute;
    public $dateVar;

    public $monthList=array('jan','feb','mar','apr','may','jun','jul','aug','sep','nov','dec');
    public $year;

    public function init()
    {
    }

    public function run()
    {
        $buttons=$this->createPageButtons();
        if(empty($buttons))
            return;
        echo $this->header;
        echo CHtml::tag('ul',$this->htmlOptions,implode("\n",$buttons));
        echo $this->footer;
    }

    public function getCurrentMonth($recalculate=true)
    {
        if ($this->_currentMonth===null || $recalculate) {
            if (isset($_GET[$this->dateVar])) {
                $this->_currentMonth = strtolower(date('M', strtotime($_GET[$this->dateVar])));
            }
            else
                $this->_currentMonth=strtolower(date('M'));
        }
        return $this->_currentMonth;
    }

    public function getCurrentYear($recalculate=true)
    {
        if ($this->_currentYear===null || $recalculate) {
            if (isset($_GET[$this->dateVar])) {
                $this->_currentYear = strtolower(date('Y', strtotime($_GET[$this->dateVar])));
            }
            else
                $this->_currentYear=strtolower(date('Y'));
        }
        return $this->_currentYear;
    }

    protected function createPageButtons()
    {
        $buttons=array();
        foreach ($this->monthList as $month) {
            $buttons[]=$this->createPageButton(date('F', strtotime($month)),$this->getCurrentYear(), $month, $this->internalPageCssClass,null,$this->getCurrentMonth()==$month);
        }
        return $buttons;
    }

    protected function getPageRange()
    {
        $monthCount=count($this->monthList);
        $beginMonth=$this->monthList[0];
        $endMonth=$this->monthList[$monthCount-1];
        return array($beginMonth,$endMonth);
    }

    protected function createPageButton($label,$year,$month,$class,$hidden,$selected)
    {
        if($hidden || $selected)
            $class.=' '.($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);
        return '<li class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($year, $month)).'</li>';
    }

    protected function createPageUrl($year, $month)
    {
        return Yii::app()->controller->createUrl($this->urlRoute, array('date'=>$year.'-'.date('m', strtotime($month))));
    }

}
