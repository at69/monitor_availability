<?php
/**
 * Created by PhpStorm.
 * User: Crocell
 * Date: 18/02/2017
 * Time: 16:16
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Availability
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="availability")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AvailabilityRepository")
 */
class Availability
{
	#region Model attributes
	/**
	 * @var string
	 *
	 * @ORM\Column(name="day_mask", type="string", length=7)
	 */
	private $dayMask;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="monitor_id", type="integer")
	 * @ORM\Id
	 * @ORM\OneToOne(targetEntity="Monitor")
	 */
	private $monitorId;

	/**
	 * @var int
	 *
	 * @ORM\Column(name="city_id", type="integer")
	 * @ORM\Id
	 * @ORM\OneToOne(targetEntity="City")
	 */
	private $cityId;
	#endregion

	#region Getters & Setters
	/**
	 * Get dayMask
	 *
	 * @return string
	 */
	public function getDayMask()
	{
		return $this->dayMask;
	}

	/**
	 * Set dayMask
	 *
	 * @param $dayMask
	 *
	 * @return $this
	 */
	public function setDayMask($dayMask)
	{
		$this->dayMask = $dayMask;

		return $this;
	}

	/**
	 * Get monitorId
	 *
	 * @return int
	 */
	public function getMonitorId()
	{
		return $this->monitorId;
	}

	/**
	 * Set monitorId
	 *
	 * @param $monitorId
	 *
	 * @return $this
	 */
	public function setMonitorId($monitorId)
	{
		$this->monitorId = $monitorId;

		return $this;
	}

	/**
	 * Get cityId
	 *
	 * @return int
	 */
	public function getCityId()
	{
		return $this->cityId;
	}

	/**
	 * Set cityId
	 *
	 * @param $cityId
	 *
	 * @return $this
	 */
	public function setCityId($cityId)
	{
		$this->cityId = $cityId;

		return $this;
	}
	#endregion
}