<?php
/**
 * Cli.php 
 *
 * This program is free software: you can redistribute it and/or modify it under the 
 * terms of the GNU General Public License as published by the Free Software 
 * Foundation, either version 3 of the License, or any later version.
 *
 * @author Carlo D'Ambrosio <carlo@ql4b.net>
 * @copyright Copyright (c) 2011, Carlo D'Ambrosio
 * @license http://www.gnu.org/licenses/gpl.txt
 * @version $Id$
 *
 */


/**
 * 
 * Ql4b_Application_Bootstrap_Cli
 *
 * @category 
 * @package  
 * @subpackage 
 * @author Carlo D'Ambrosio <carlo@ql4b.net>
 * @copyright Copyright (c) 2011, Carlo D'Ambrosio
 * @license http://www.gnu.org/licenses/gpl.txt
 * @version $Id$
 *
 */
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