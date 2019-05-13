<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Login;
use App\Entity\Providers;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;   
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Backend extends AbstractController
{
	private $session;
	
    public function __construct(SessionInterface $session) 
	{
        $this->session = $session;
    }
    /**
     * @Route("/backend", name="catch") methods={"GET","POST"}
     */
    public function index(SessionInterface $session)
    {
        $request = Request::createFromGlobals(); // the envelope, and we're looking inside it.

        $type = $request->request->get('type', 'none'); // to send ourself in different directions
        
        if($type == 'register'){
            // perform register process
            // get the variables
            $username = $request->request->get('username', 'none');
            
			$repo = $this->getDoctrine()->getRepository(Login::class);
            
			$user = $repo->findOneBy(array( 'username' => $username ));
			
				if ($user) {
					return new Response(
						'taken'
					);
				}
				else {
				
			$password = $request->request->get('password', 'none');
            $acctype = $request->request->get('acctype', 'none');
			$proid = $request->request->get('providerid', null);
                        
            // put in the database            
             $entityManager = $this->getDoctrine()->getManager();

              $login = new Login();
              $login->setUsername($username);
              $login->setPassword($password);
              $login->setAcctype($acctype);
			  $login->setProviderId($proid);
             
             $entityManager->persist($login);

             // actually executes the queries (i.e. the INSERT query)
             $entityManager->flush();

			 $session->set('username', $username);
             $session->set('providerid', $login->getProviderId());
			 
             return new Response(
                    $login->getAcctype()
                    );
			}			
        }
        else if($type == 'login'){ // if we had a login
            
            // get the username and password
            $username = $request->request->get('username', 'none');
            $password = $request->request->get('password', 'none');
            
            $repo = $this->getDoctrine()->getRepository(Login::class); // the type of the entity
            
            $person = $repo->findOneBy([
                'username' => $username,
                'password' => $password,
                ]);
				
				if($person){
					
					$session->set('username', $username);
					$session->set('providerid', $person->getProviderId());
					
					return new Response(
						$person->getAcctype()
						); 
				}
				else { // if we don't then, throw an error back
                    
                    return $this->redirectToRoute('news', ['error' => 'Invalid username or password']);
				}
		} 
		if($type == 'getProviders'){
			
			$entityManager = $this->getDoctrine()->getManager();     
			
			$providers = $this->getDoctrine()->getRepository(Providers::class)->findAll();
			
			$output = '<select name="pro" id="pro">';
			
			$output .= '<option disabled selected value> -- select an option -- </option>';
				
			foreach ($providers as $pro) {
				
				$output .= '<option value="'.$pro->getProviderName().'">' . $pro->getProviderName() . '</option>';
			}
			
			$output .= '</select>';
				
			
			return new Response(
				$output
			);
        
		}
		else if($type == 'getproviderid'){
            // send back a response, with the providerid we stored in the session.
            return new Response($session->get('providerid'));
		}
		else if($type == 'getprovideridbyname'){
			
			$proname = $request->request->get('pro', 'none');
			
			$entityManager = $this->getDoctrine()->getManager();     
			
			$provider = $this->getDoctrine()->getRepository(Providers::class)->findOneBy(array('ProviderName' => $proname));
            
            return new Response(
				$provider->getId());
		}
		else if ($type == 'logout') {
			
			session_unset();
			session_destroy();
			
			return new Response(
				'/index');
		}
    }
    
    
}