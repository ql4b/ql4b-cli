<?php 

class Ql4b_Application_Bootstrap_Cli extends Zend_Application_Bootstrap_Bootstrap {
	
	
	public function run(){
	
		$front   = $this->getResource('FrontController');
        $default = $front->getDefaultModule();
        if (null === $front->getControllerDirectory($default)) {
            throw new Zend_Application_Bootstrap_Exception(
                'No default controller directory registered with front controller'
            );
        }

        // Set FrontController invoke paramters  
        $front->setParams(
        	array(
        		'bootstrap' 		=> $this,
        		'noViewRenderer'	=> true
        	)
        );
        
        // Set the Cli Router
        $front->setRouter('Ql4b_Controller_Router_Cli');
        
        // Dispatch the request with custom Request and Response classes
        $response = $front->dispatch(
        	new Ql4b_Controller_Request_Cli(),
        	new Ql4b_Controller_Response_Cli()
        );
        
        if ($front->returnResponse()) {
            return $response;
        }
	}

}