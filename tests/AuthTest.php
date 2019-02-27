<?php 

/**
*  Corresponding Class to test Auth class
*
*  @author Ben Grant
*/
class AuthTest extends PHPUnit_Framework_TestCase{

	/**
	* This is just a simple check to make sure the library has no syntax errors. This helps troubleshoot
	* any typos before using this library in a real project.
	*
	*/
	public function testIsThereAnySyntaxError() {
		$var = new GRA0007\MiniAuth\Auth;
		$this->assertTrue(is_object($var));
		unset($var);
	}
}