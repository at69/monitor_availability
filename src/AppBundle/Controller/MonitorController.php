<?php
/**
 * Created by PhpStorm.
 * User: Crocell
 * Date: 18/02/2017
 * Time: 16:48
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Monitor;
use AppBundle\Service\MonitorManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\Query\Expr\Join;

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
		/** @var MonitorManager $monitorManager */
		$monitorManager = $this->get('monitor_manager');

		/** @var array|Monitor[] $monitors */
		$monitors = array();

		//get all $_GET parameters
		$parameters = $request->query->all();

		$qb = $monitorManager->getRepository()->createQueryBuilder('m');
		$qb
			->select('m.id, m.firstname, m.lastname, c.name, a.dayMask')
			->innerJoin('AppBundle:Availability', 'a', Join::WITH, $qb->expr()->eq('m.id', 'a.monitorId'))
			->innerJoin('AppBundle:City', 'c', Join::WITH, $qb->expr()->eq('a.cityId', 'c.id'));

		foreach ($parameters as $parameter)
		{
			if(isset($parameter['firstname']))
			{
				$firstname = $parameter['firstname'];
				if(preg_match('/\D{2,70}/', $firstname))
				{
					$qb
						->andWhere('REGEXP(m.firstname, :regexp) = true')
						->setParameter('regexp', $firstname);
				}
				else
				{
					return new JsonResponse(
						['message' => 'firstname must match pattern \D{2,70}'],
						Response::HTTP_NOT_FOUND
					);
				}
			}
			elseif(isset($parameter['lastname']))
			{
				$lastname = $parameter['lastname'];
				if(preg_match('/\D{2,70}/', $lastname))
				{
					$qb
						->andWhere('REGEXP(m.lastname, :regexp) = true')
						->setParameter('regexp', $lastname);
				}
				else
				{
					return new JsonResponse(
						['message' => 'lastname must match pattern \D{2,70}'],
						Response::HTTP_NOT_FOUND
					);
				}
			}
			elseif(isset($parameter['city']))
			{
				$city = $parameter['city'];
				if(preg_match('/\D{2,70}/', $city))
				{
					$qb
						->andWhere('REGEXP(c.name, :regexp) = true')
						->setParameter('regexp', $city);
				}
				else
				{
					return new JsonResponse(
						['message' => 'city must match pattern \D{2,70}'],
						Response::HTTP_NOT_FOUND
					);
				}
			}
			elseif(isset($parameter['day_mask']))
			{
				$dayMask = $parameter['day_mask'];
				if(preg_match('/(1|0){7}/', $dayMask))
				{
					$qb
						->andWhere('a.dayMask = ":day_mask"')
						->setParameter('day_mask', $dayMask);
				}
				else
				{
					return new JsonResponse(
						['message' => 'day_mask must match pattern (1|0){7}'],
						Response::HTTP_NOT_FOUND
					);
				}
			}
		}

		$monitors = $qb->getQuery()->getResult();

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
			if(!(isset($formatted[$monitor['id']])))
			{
				$formatted[$monitor['id']] = array(
					'firstname'         => $monitor['firstname'],
					'lastname'          => $monitor['lastname'],
					'availabilities'    => array()
				);
			}

			$formatted[$monitor['id']]['availabilities'][] = array(
				'city'      => $monitor['name'],
				'day_mask'  => $monitor['dayMask']
			);
		}

		return new JsonResponse($formatted);
	}
}