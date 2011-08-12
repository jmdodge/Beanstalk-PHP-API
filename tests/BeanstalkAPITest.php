<?php

//
// Perform unit testing on the BeanstalkAPI object using PHPUnit
//

require(dirname(__FILE__) . "/../lib/beanstalkapi.class.php");


class BeanstalkAPITest extends PHPUnit_Framework_TestCase
{
	/**
	 * Generic function to check return type from all API calls - can be used as a wrapper
	 */
	protected function doReturnTypeCheck($apiResult)
	{
		$this->assertEquals('SimpleXMLElement', get_class($apiResult));
		
		return $apiResult;
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testInstantiationException()
	{
		new BeanstalkAPI();
	}
	
	/**
	 * Should correctly instantiate Beanstalk connection - used in subsequent API calls
	 */
	public function testInstantiation()
	{
		$Beanstalk = new BeanstalkAPI('account', 'user', 'pass');
		return $Beanstalk;
	}
	
	/**
	 * @expectedException APIException
	 * @expectedExceptionCode 401
	 */
	public function testBadLoginException()
	{
		$Beanstalk = new BeanstalkAPI('account', 'bad', 'login');
		$Beanstalk->find_all_plans();
	}
}