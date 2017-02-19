<?php
/**
 * Created by PhpStorm.
 * User: Crocell
 * Date: 19/02/2017
 * Time: 18:36
 */

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MonitorControllerTest extends WebTestCase
{
	/**
	 * @dataProvider parameters
	 */
	public function testGetMonitors($parameters)
	{
		$client = static::createClient();

		$client->request(
			'GET',
			'/monitors',
			$parameters
		);

		$response = $client->getResponse();
		$data = json_decode($response->getContent());
		$this->assertEquals(200, $response->getStatusCode());
		$this->assertArrayHasKey('firstname', $data);
		$this->assertArrayHasKey('lastname', $data);
		$this->assertArrayHasKey('availabilities', $data);
	}

	/**
	 * @return array
	 */
	public function parameters()
	{
		return array(
			'by firstname' => array(
				'firstname' => 'Alban'
			),
			'by lastname' => array(
				'lastname' => 'Truc'
			),
			'by city name' => array(
				'city' => 'Lyon'
			),
			'by day mask' => array(
				'day_mask' => '1111100'
			),
			'by firstname with regex' => array(
				'firstname' => 'Alban|Bertrand'
			),
			'by lastname with regex' => array(
				'lastname' => 'Bert*'
			),
			'by city with regex' => array(
				'city' => '[[:alpha:]]{5,5}'
			),
			'by firstname or lastname' => array(
				'firstname' => 'Alban',
				'lastname' => 'Jamin'
			)
		);
	}
}