<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Observations;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class ObservationsController extends AbstractController
{
    /**
     * @Route("/observations", name="obs")
     */
    public function observations(SessionInterface $session)
    {
		$request = Request::createFromGlobals();
        
		$patientid = $request->request->get('ptid', 'none');
			 
		// Get all obs records
		$repo = $this->getDoctrine()->getRepository(Observations::class); // the type of the entity
				
		$allObs = $repo->findBy(array('patientid' => $patientid));
	  
			return $this->render('obs.html.twig', array("all" => $allObs) );
			
			
	}
}

