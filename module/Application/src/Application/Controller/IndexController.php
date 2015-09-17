<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
		$HeadTitle = $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle');
		
		if(empty($_SESSION)){
			$HeadTitle->set('Login Page');
			$this->viewContnet['pageContent'] = $this->getPageContent('index','login_page');
		}else{
			$isLoginContent = $this->getPageContent('index','after_login');
			$isLoginContent = str_replace("@@requestTokenCode@@",$_SESSION["requestTokenCode"],$isLoginContent);
			$this->viewContnet['pageContent']= $isLoginContent;
			//header("location: http://127.0.0.1:120/auth_back.php?login_code=".$_GET["login_code"]);
			//exit();
		}
        return new ViewModel($this->viewContnet);
    }
	
	private function getPageContent($pageType,$pageName){
		$pagePath = dirname(__DIR__) . "\\..\\..\\..\\..\\public\\include\\pageContent\\".$pageType."\\".$pageName.".html";
		$pageContent = '';
		if(file_exists($pagePath)){
			$pageContent = file_get_contents($pagePath);
		}
		return $pageContent;
	}
}
