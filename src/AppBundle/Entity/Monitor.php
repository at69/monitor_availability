<?php
/**
 * Created by PhpStorm.
 * User: Crocell
 * Date: 18/02/2017
 * Time: 15:53
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Monitor
 * @package AppBundle\Entity
 *
 * @ORM\Table(name="monitor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MonitorRepository")
 */
class Monitor
{
	#region Model attributes
	/**
	 * @var int
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="lastname", type="string", length=70)
	 */
	private $lastname;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="firstname", type="string", length=70)
	 */
	private $firstname;
	#endregion

	#region Getters & Setters
	/**
	 * Get id
	 *
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get lastname
	 *
	 * @return string
	 */
	public function getLastname()
	{
		return $this->lastname;
	}

	/**
	 * Set lastname
	 *
	 * @param $lastname
	 *
	 * @return $this
	 */
	public function setLastname($lastname)
	{
		$this->lastname = $lastname;

		return $this;
	}

	/**
	 * Get firstname
	 *
	 * @return string
	 */
	public function getFirstname()
	{
		return $this->firstname;
	}

	/**
	 * Set firstname
	 *
	 * @param $firstname
	 *
	 * @return $this
	 */
	public function setFirstname($firstname)
	{
		$this->firstname = $firstname;

		return $this;
	}
	#endregion
}