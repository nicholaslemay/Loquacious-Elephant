<?php

	require_once 'src/selenium_helper/SeleniumDrivenUser.php';
	require_once 'src/selenium_helper/SeleniumExecutionContext.php';
	class SeleniumDrivenUserExpectations extends PHPUnit_Framework_TestCase
	{
		private static $selenium_execution_context;
		private static $selenium_driven_user;
		
		public static function setUpBeforeClass()
    	{
	        self::$selenium_execution_context = new SeleniumExecutionContext("firefox","file:///home/xto/projects/SUTA/expectations/selenium_expectations/selenium_test_page.html"); 
    		self::$selenium_driven_user = new SeleniumDrivenUser(self::$selenium_execution_context);
		}
		
		public static function tearDownAfterClass()
		{
			self::$selenium_driven_user->destroy();
		}
		
		public function setUp()
		{
			self::$selenium_driven_user->goesTo("file:///home/xto/projects/SUTA/expectations/selenium_expectations/selenium_test_page.html");
		}
		
		/**
		 * @test
		 */
		public function shouldSeeShouldRaiseAnExceptionIfElementIsNotThere()
		{
			try
			{
				self::$selenium_driven_user->shouldSee("id('non_existant_id')");
				self::fail("shouldSee should have failed");
			}
			catch(Exception $e){}
		}
		
		/**
		 * @test
		 */
		public function shouldSeeShouldSucceedWhenElementIsFound()
		{
			self::$selenium_driven_user->shouldSee("//*[id('test_span')]");
		}
		
		/**
		 * @test
		 */
		public function withTextShouldRaiseAnExceptionIfTextDoesNotMatchParameter()
		{
			try
			{
				self::$selenium_driven_user->shouldSee("//span[@id('test_span')]")->withText("Text that isn't there");
				self::fail("withText should have failed");
			}
			catch(Exception $e){}
		}
		
		/**
		 * @test
		 */
		public function withTextShouldSucceedIfTextMatchesParameter()
		{
			self::$selenium_driven_user->shouldSee("//span[id('test_span')]")->withText("Text");
		}
		
		/**
		 * @test
		 */
		public function checkedShouldRaiseAnExceptionIfElementIsNotACheckboxOrARadioButton()
		{
			try
			{
				self::$selenium_driven_user->shouldSee("//span[id('test_span')]")->checked();
				self::fail("checked should have failed");
			}
			catch(Exception $e){}
		}
		
		/**
		 * @test
		 */
		public function checkedShouldSucceedIfElementIsACheckboxThatIsChecked()
		{
			self::$selenium_driven_user->clicks("//input[@name='test_checkbox']");
			self::$selenium_driven_user->shouldSee("//input[@name='test_checkbox']")->checked();
				
		}
		
		/**
		 * @test
		 */
		public function checkedShouldSucceedIfElementIsARadiobuttonThatIsChecked()
		{
			self::$selenium_driven_user->clicks("//input[@name='test_radio']");
			self::$selenium_driven_user->shouldSee("//input[@name='test_radio']")->checked();
				
		}
		
		/**
		 * @test
		 */
		public function checkedShouldFailIfElementIsAnUncheckedCheckbox()
		{
			try
			{
				self::$selenium_driven_user->shouldSee("//input[@name='test_checkbox']")->checked();
				self::fail("checked should have failed");
			}
			catch(Exception $e){}
		}
		
		/**
		 * @test
		 */
		public function checkedShouldFailIfElementIsAnUncheckedRadiobutton()
		{
			try
			{
				self::$selenium_driven_user->shouldSee("//input[@name='test_radio']")->checked();
				self::fail("checked should have failed");
			}
			catch(Exception $e){}
		}
		
		/**
		 * @test
		 */
		public function selectedFailWhenOptionDoesNotExist()
		{
			try
			{
				self::$selenium_driven_user->selects("Unknown Option")->from("test_select");
				self::$selenium_driven_user->shouldSee("//select/option[2]")->selected();
				self::fail("selected should have failed");
			}
			catch(Exception $e){}
		}
		
		/**
		 * @test
		 */
		public function selectedFailWhenOptionIsNotSelected()
		{
			try
			{
				self::$selenium_driven_user->selects("Option")->from("test_select");
				self::$selenium_driven_user->shouldSee("//select/option[1]")->selected();
				self::fail("selected should have failed");
			}
			catch(Exception $e){}
		}
		
		/**
		 * @test
		 */
		public function selectedShouldSucceedWhenOptionIsSelected()
		{
				self::$selenium_driven_user->selects("Option 2")->from("test_select");
				self::$selenium_driven_user->shouldSee("//select/option[2]")->selected();
		}
	}
?>