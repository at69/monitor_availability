<?php
/**
 * Created by PhpStorm.
 * User: Crocell
 * Date: 18/02/2017
 * Time: 16:48
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Monitor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MonitorController
 * @package AppBundle\Controller
 */
class MonitorController extends Controller
{
	/**
	 * @todo test, replace with the right routes and implementation of the function
	 * @Route("/monitors", name="monitors_list")
	 * @Method("GET")
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function getMonitorsAction(Request $request)
	{
		$monitorManager = $this->get('monitor_manager');

		/** @var Monitor[] $monitors */
		$monitors = $monitorManager->findAll();

		if(empty($monitors))
		{
			return new JsonResponse(
				['message' => 'No monitor found'],
				Response::HTTP_NOT_FOUND
			);
		}

		$formatted = array();

		foreach ($monitors as $monitor)
		{
			$formatted[] = array(
				'id'        => $monitor->getId(),
				'firstname' => $monitor->getFirstname(),
				'lastname'  => $monitor->getLastname()
			);
		}

		return new JsonResponse($formatted);
	}

	/**
	 * @Route(
	 *     "/monitors?firstname={firstname}",
	 *     name="monitor_by_firstname",
	 *     requirements={
	 *          "firstname": "\D{2,70}"
	 *     }
	 * )
	 * @Route("/monitors?lastname={lastname}",
	 *     name="monitor_by_lastname",
	 *     requirements={
	 *          "firstname": "\D{2,70}"
	 *     }
	 * )
	 * @Route("/monitors?city={city}",
	 *     name="monitor_by_city"
	 * )
	 *  @Route("/monitors?day_mask={day_mask}",
	 *     name="monitor_by_day_mask"
	 * )
	 * @Method("GET")
	 *
	 * @param Request $request
	 *
	 * @return JsonResponse
	 */
	public function getMonitor(Request $request)
	{

	}
}