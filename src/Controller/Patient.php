<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\AdmVisits;
use App\Entity\Observations;
use App\Entity\Login;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;   
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Patient extends AbstractController
{
	private $session;
	
    public function __construct(SessionInterface $session) 
	{
        $this->session = $session;
    }
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
			
			$output = '<table style="width: 100%"> 
							<thead>
								<tr>
									<th>Patient Name</th>
									<th>DoB</th>
									<th>Sex</th>
									<th>Account Number</th>
								</tr>	
							</thead>
							<tbody>
								<tr>';
			$output .= '<td style="text-align:center">' . $record->getFirstname() . " " . $record->getLastname() . '</td>';
			
			$output .= '<td style="text-align:center">' . $record->getBirthDateTime() . '</td>';
			
			$output .= '<td style="text-align:center">' . $record->getSex() . '</td>';
			
			$output .= '<td style="text-align:center">' . $record->getAccountNumber() . '</td>';
			
			$output .= '</tr></tbody></table>';
			
			return new Response(
				$output				
			);
		}
		if($type == 'recordobs'){

			$bp = $request->request->get('bp', 'none');
			$hr = $request->request->get('hr', 'none');
			$temp = $request->request->get('temp', 'none');
			$resp = $request->request->get('resp', 'none');
			$spo2 = $request->request->get('spo2', 'none');
			$loc = $request->request->get('loc', 'none');
			$ptid = $request->request->get('ptid', 'none');
			$news = $request->request->get('news', 'none');
			
			$entityManager = $this->getDoctrine()->getManager();

			$ptObs = new Observations();
			$ptObs->setBP($bp);
			$ptObs->setPulse($hr);
			$ptObs->setRespirations($resp);
			$ptObs->setSpO2($spo2);
			$ptObs->setTemperature($temp);
			$ptObs->setLevelOfConsciousness($loc);
			$ptObs->setPatientid($ptid);
			$ptObs->setNewsScore($news);
			
			$entityManager->persist($ptObs);
			
			$entityManager->flush();
			
			return new Response(
                    $ptObs->getNewsScore()
                    );
        }
		if($type == 'patientid'){
			
			$entityManager = $this->getDoctrine()->getManager();     

			$acct = $request->request->get('acct', 'none');
			
			$repo = $this->getDoctrine()->getRepository(Admvisits::class);
			
			$record = $repo->findOneBy(array('AccountNumber' => $acct));
			
			$output = $record->getId();
			
			return new Response(
				$output				
			);
		}
	}
}
