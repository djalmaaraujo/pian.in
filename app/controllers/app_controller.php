<?php
/**
 *  AppController é o controller usado como base para todos os outros controllers
 *  da aplicação. Estando na biblioteca, é utilizado somente quando não há outro
 *  AppController definido pelo usuário.
 *
 *  @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 *  @copyright Copyright 2008-2009, Spaghetti* Framework (http://spaghettiphp.org/)
 *
 */

class AppController extends Controller {
	
	public $components = array();
	public $helpers = array('Html', "Form", 'Date');
	public $layout = 'default';
	public $arrView = null;
	
	# Autoloading by Klawdyo
	public function __get($class){
      if(!isset($this->{$class})):
         $pattern = '(^[A-Z]+([a-z]+(Component)?))';
         if(preg_match($pattern, $class, $out)):
            $type = (isset($out[2])) ? 'Component' : 'Model';
            $this->{$class} = ClassRegistry::load($class, $type);
            if($type == 'Component') $this->{$class}->initialize($this);
            return $this->{$class};
         endif;
      endif;
   }

	public function beforeFilter() { $this->beforeFilterConfig(); }
	public function beforeRender() { $this->beforeRenderConfig(); }
	
	/**
	 * PRIVATES METHODS
	 */ 
	
	# Some defatuls settings 
	private function beforeRenderConfig()
	{
		# Page title default
		if (!$this->arrView['page_title'])	$this->pageTitle('');
		$this->set($this->arrView);
	}
	
	# Set the page title in controllers
	private function pageTitle($title = null) {
		$compl = ($title) ? ' » ' . $title : '';
		$this->arrView['page_title'] = Config::read('app.name') . $compl;
	}	
	
	
	# Some defaults settings
	private function beforeFilterConfig() {}
	
}