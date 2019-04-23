<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\AdmVisits;
use App\Entity\Login;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;   
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Patient extends AbstractController
{
    /**
     * @Route("/patient", name="patient") methods={"GET","POST"}
     */
    public function index()
	{
		$request = Request::createFromGlobals(); // the envelope, and we're looking inside it.

        $type = $request->request->get('type', 'none'); // to send ourself in different directions
        
        if($type == 'lookuppatient'){
			
			$entityManager = $this->getDoctrine()->getManager();     

			$acct = $request->request->get('acct', 'none');
			
			$repo = $this->getDoctrine()->getRepository(Admvisits::class);
			
			$record = $repo->findOneBy(array('AccountNumber' => $acct));
			
			return new Response(
				$record->getLastname().",".$record->getFirstname()."     ".$record->getBirthDateTime()."     ".$record->getSex()."     ".$record->getAccountNumber()
			);
		}
	}
}
