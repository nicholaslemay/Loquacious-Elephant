<?php


    class SeleniumActions
    {
    	private $__seleniumExecutionContext;

    	public function __construct($seleniumExecutionContext)
        {
            $this->__seleniumExecutionContext= $seleniumExecutionContext;
        }

        private function __getLastVisitedLocation()
        {
            return $this->__seleniumExecutionContext->getLastVisitedLocation();
        }

        private function __getSelenium()
        {
        	return $this->__seleniumExecutionContext->getSelenium();
        }

    	private function __setLastVisitedLocation($location)
    	{
    		 $this->__seleniumExecutionContext->setLastVisitedLocation($location);
    	}

    	private function __resetLastVisitedLocation()
    	{
    		 $this->__seleniumExecutionContext->resetLastVisitedLocation();
    	}

        public function goesTo($url)
        {
            $this->__getSelenium()->open($url);
        }

        public function fillsOut($text_field_locator)
        {
            $this->__setLastVisitedLocation($text_field_locator);
        }

        public function with($value)
        {
            Expectations::shouldNotBeNull($this->__getLastVisitedLocation(),"Nowhere to type... Please specify where to type.");
            $this->__getSelenium()->type($this->__getLastVisitedLocation(), $value);
            $this->__resetLastVisitedLocation();
        }

        public function clicks($locator)
        {
            $this->__getSelenium()->click($locator);
        }

        public function and_then()
        {
        }

        public function waitsForPageToLoad()
        {
            $this->__getSelenium()->waitForPageToLoad(30000);
        }

        public function drags($objects_locator)
        {
            $this->__setLastVisitedLocation($objects_locator);
        }

        public function dropsOn($destinations_locator)
        {
            Expectations::shouldNotBeNull($this->__getLastVisitedLocation(),"Nowhere to drop... Please specify where to drop the object.");
            $this->__getSelenium()->dragAndDropToObject($this->__getLastVisitedLocation(),$destinations_locator);
        }

        public function checks($checkbox_or_radio_button_locator)
        {
            $this->__getSelenium()->check($checkbox_or_radio_button_locator);
        }

        public function unchecks($checkbox_or_radio_button_locator)
        {
            $this->__getSelenium()->uncheck($checkbox_or_radio_button_locator);
        }

        public function selects($value)
        {
            $this->__setLastVisitedLocation($value);
        }

        public function from($dropdown_list_locator)
        {
            Expectations::shouldNotBeNull($this->__getLastVisitedLocation(),"Nowhere to pick from... Please specify where to find the selection.");
            $this->__getSelenium()->select($dropdown_list_locator,'label='.$this->__getLastVisitedLocation());
            $this->__resetLastVisitedLocation();
        }

        public function waitsForAjax($timeout)
        {
            $javascriptLibrary = $this->__seleniumExecutionContext->getJavascriptLibrary();

            $waitForAjaxCondition = call_user_func(array($this,'get'.$javascriptLibrary.'WaitForAjaxCondition'));
            $this->__getSelenium()->waitForCondition($waitForAjaxCondition, $timeout);
        }

        public function getjQueryWaitForAjaxCondition()
        {
             return "selenium.browserbot.getCurrentWindow().jQuery.active == 0";
        }

        public function getPrototypeWaitForAjaxCondition()
        {
            return "selenium.browserbot.getCurrentWindow().Ajax.activeRequestCount == 0";
        }

    }

?>