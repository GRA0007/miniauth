<?php
namespace GRA0007\MiniAuth;

/**
*  Auth
*
*  The main class
*
*  @author Ben Grant
*/
class Auth {

	/**
	* @var string $cookie_name Name of the cookie the auth data is stored in
	*/
	private $cookie_name = 'auth_data';
	
	/**
	* @var int $cookie_duration Length of time (in milliseconds) that the cookie lasts for
	*/
	private $cookie_duration = 259200; // 3 days
	
	/**
	* Auth
	*
	* Set up the Auth object to use throughout your project
	*
	* @param string $cookie_name Name of the cookie the auth data is stored in
	* @param int $cookie_duration Length of time (in milliseconds) that the cookie lasts for
	*/
	public function __construct($cookie_name, $cookie_duration) {
		$this->cookie_name = $cookie_name;
		$this->cookie_duration = $cookie_duration;
	}

	/**
	* checkLogin
	*
	* Checks the cookie and makes sure that the auth is still valid
	*
	* @param string $password The (hashed) password to check, generally from an sql database after searching for a user with an email or id
	*
	* @return boolean
	*/
	public function checkLogin($password) {
		$cookie_data = (array)json_decode(base64_decode($_COOKIE[$this->cookie_name]));
		
		if ($cookie_data['password'] == $password) {
			// Password correct
			$cookie_data = array("email" => $cookie_data['email'], "password_hash" => $password);
			setcookie($this->cookie_name, base64_encode(json_encode($cookie_data)), time()+$this->cookie_duration, '/');
		} else {
			// Password incorrect
			setcookie($this->cookie_name, "gone", time()-1, '/');
		}
	}
}