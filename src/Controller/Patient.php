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
			$date = $request->request->get('date', 'none');
			
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
			$ptObs->setDatetime($date);
			
			
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
		if($type == 'providerpts'){
			
			$entityManager = $this->getDoctrine()->getManager();

			$providerid = $request->request->get('providerid', 'none');
			
			$patients = $this->getDoctrine()->getRepository(Admvisits::class)->findBy(array('ProviderId' => $providerid));
			
			$output = '<table style="width: 100%"> 
							<thead>
								<tr>
									<th>Patient Name</th>
									<th>DoB</th>
									<th>Sex</th>
									<th>Account Number</th>
									<th>Observations</th>
									
								</tr>	
							</thead>';
			foreach ($patients as $pt){
				
				$output .= '<tbody>
								<tr>';
				$output .= '<td style="text-align:center">' . $pt->getFirstname() . " " . $pt->getLastname() . '</td>';
			
				$output .= '<td style="text-align:center">' . $pt->getBirthDateTime() . '</td>';
			
				$output .= '<td style="text-align:center">' . $pt->getSex() . '</td>';
			
				$output .= '<td style="text-align:center">' . $pt->getAccountNumber() . '</td>';
				
				$output .= '<td style="text-align:center"><button id="'.  $pt->getId() .'"onClick="reply_click(this.id)">Patients Observations</button></td>';
			
				// $output .= '<td style="text-align:center"><button id="'.  $pt->getId() .'"onClick="reply_click(this.id)">Graph Observations</button></td>';
				
				$output .= '</tr>';
				
			}
			
			$output .= '</tbody></table>';
			
			return new Response(
				$output
			);
		}
		if($type == 'getptobs'){
			
			$entityManager = $this->getDoctrine()->getManager();

			$ptid = $request->request->get('ptid', 'none');
			
			$observations = $this->getDoctrine()->getRepository(Observations::class)->findBy(array('patientid' => $ptid));
			
			$output = '<table style="width: 100%"> 
							<thead>
								<tr>
									<th>Blood Pressure</th>
									<th>Heart Rate</th>
									<th>Temperature</th>
									<th>Respirations</th>
									<th>SpO2</th>
									<th>LoC</th>
									<th>NEWS</th>
									<th>DateTime</th>
								</tr>	
							</thead>';
			foreach ($observations as $obs){
				
				$output .= '<tbody>
								<tr>';
				$output .= '<td style="text-align:center">' . $obs->getBP() . ' mmHg</td>';
			
				$output .= '<td style="text-align:center">' . $obs->getPulse() . ' bpm</td>';
			
				$output .= '<td style="text-align:center">' . $obs->getTemperature() . ' oC</td>';
			
				$output .= '<td style="text-align:center">' . $obs->getRespirations() . ' bpm</td>';
				
				$output .= '<td style="text-align:center">' . $obs->getSpO2() . ' %</td>';
				
				$output .= '<td style="text-align:center">' . $obs->getLevelOfConsciousness() . '</td>';
				
				$output .= '<td style="text-align:center">' . $obs->getNewsScore() . '</td>';
				
				$output .= '<td style="text-align:center">' . $obs->getDateTime() . '</td>';
			
				$output .= '</tr>';
				
			}
			
			$output .= '</tbody></table>';
			
			return new Response(
				$output
			);
		}
		if($type == 'getPtbyId'){
			
			$entityManager = $this->getDoctrine()->getManager();     

			$ptid = $request->request->get('ptid', 'none');
			
			$repo = $this->getDoctrine()->getRepository(Admvisits::class);
			
			$record = $repo->findOneBy(array('id' => $ptid));
			
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
	}
}
