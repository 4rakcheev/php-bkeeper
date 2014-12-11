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

    public $prevYearLabel;
    public $nextYearLabel;
    public $prevMonthLabel;
    public $nextMonthLabel;

    private $_currentMonth;
    private $_currentYear;

    public $urlRoute;
    public $dateVar;
    public $maxViewMonth=5;

    public $monthList=array('jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec');

    public function init()
    {
        if($this->prevYearLabel===null)
            $this->prevYearLabel='&lt;&lt;';
        if($this->nextYearLabel===null)
            $this->nextYearLabel='&gt;&gt;';
        if($this->prevMonthLabel===null)
            $this->prevMonthLabel='&lt;';
        if($this->nextMonthLabel===null)
            $this->nextMonthLabel='&gt;';
        if($this->header===null)
            $this->header=Yii::t('yii','Please: ');

        if(!isset($this->htmlOptions['id']))
            $this->htmlOptions['id']=$this->getId();
        if(!isset($this->htmlOptions['class']))
            $this->htmlOptions['class']='yiiPager';

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

    public function getLabelByMonth($month)
    {
        return Yii::t('strings', date('F', strtotime($month))). ' ' . $this->getCurrentYear(false);
    }

    protected function createPageButtons()
    {
        $buttons=array();

        list($beginMonth, $endMonth)=$this->getPageRange();
        $iBeginMonth=$this->getIdByMonth($beginMonth);
        $iEndMonth=$this->getIdByMonth($endMonth);
        $currentMonth=$this->getCurrentMonth(false);
        $iCurrentMonth=$this->getIdByMonth($currentMonth);
        $monthCount=$this->getMonthCount();

        $currentYear=(int)$this->getCurrentYear();

        // prev year
        $buttons[]=$this->createPageButton($this->prevYearLabel, $currentYear-1, $this->monthList[$iCurrentMonth], $this->firstPageCssClass, false, false);

        // prev month
        $year=$currentYear;
        $month=$this->monthList[$iCurrentMonth-1];
        if ($iCurrentMonth==0) {
            $year=$currentYear-1;
            $month=$this->monthList[$this->getMonthCount()-1];
        }
        $buttons[]=$this->createPageButton($this->prevMonthLabel, $year, $month, $this->previousPageCssClass,false,false);

        // Internal months
        for ($i=$iBeginMonth;$i<=$iEndMonth;++$i) {
            $month=$this->monthList[$i];
            $buttons[]=$this->createPageButton($this->getLabelByMonth($month),$currentYear, $month, $this->internalPageCssClass,null,$i==$iCurrentMonth);
        }

        // next month
        $year=$currentYear;
        $month=$this->monthList[$iCurrentMonth+1];
        if ($iCurrentMonth==$monthCount-1) {
            $year=$currentYear+1;
            $month=$this->monthList[0];
        }
        $buttons[]=$this->createPageButton($this->nextMonthLabel, $year, $month, $this->previousPageCssClass,false,false);

        // next year
        $buttons[]=$this->createPageButton($this->nextYearLabel, $currentYear+1, $this->monthList[$iCurrentMonth], $this->lastPageCssClass, false, false);

        return $buttons;
    }

    public function getMonthCount()
    {
        return count($this->monthList);
    }

    public function getIdByMonth($month)
    {
        return array_search($month, $this->monthList);
    }

    protected function getPageRange()
    {
        $monthCount=$this->getMonthCount();
        $iCurMonth=$this->getIdByMonth($this->getCurrentMonth());
        $iBeginMonth=max(0, $iCurMonth - (int)($this->maxViewMonth/2));
        if (($iEndMonth=$iBeginMonth+$this->maxViewMonth-1)>=$monthCount) {
            $iEndMonth=$monthCount-1;
            $iBeginMonth=max(0, $iEndMonth-$this->maxViewMonth+1);
        }
        $endMonth=$this->monthList[$iEndMonth];
        $beginMonth=$this->monthList[$iBeginMonth];
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
