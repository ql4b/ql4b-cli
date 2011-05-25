<?php

/**
 * 
 * Base Cli Router Class
 * 
 * @author carlo
 *
 */
class QL4b_Controller_Router_Cli extends Zend_Controller_Router_Abstract {
	
public function route(Zend_Controller_Request_Abstract $request){
		
		if (!$request instanceof Ql4b_Controller_Request_Cli) {
            throw new Zend_Controller_Router_Exception('QL4b_Controller_Router_Cli requires a Ql4b_Controller_Request_Cli request object');
        }
        
        $opts = new Zend_Console_Getopt(array (
			"a|action=s" =>"Action",
			"c|controller=s" => "Controller",
			"m|module=s" => "Module",
			"e|environment=s" => "Application Environment"
		));
        
        try {
        	$opts->parse();
        }	
        catch (Zend_Console_Getopt_Exception $e){
        	throw new Zend_Controller_Router_Exception(
        		$e->getMessage() . "\n" . $e->getUsageMessage()
        		); 
        }
        
        if (isset($opts->a))
        	$request->setActionName($opts->a);
        	
        if (isset($opts->c))
        	$request->setControllerName($opts->c);
        	
        if (isset($opts->m))
        	$request->setModuleName($opts->m);
        	
        if (count ($opts->getRemainingArgs()) > 0)
        	$request->setParams($opts->getRemainingArgs());
        
        return $request;
	}
	
	/**
	 * (non-PHPdoc)
	 * @see Zend_Controller_Router_Interface::assemble()
	 */
	public function assemble($userParams, $name = null, $reset = false, $encode = true){
		
		return null;
	}

}