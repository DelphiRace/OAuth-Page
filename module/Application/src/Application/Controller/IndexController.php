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
use System_APService\clsSystem;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
		$VTs = new clsSystem;
		$VTs->initialization();
		//----BI-----
		if(empty($_SESSION)){
			$pagePath = dirname(__DIR__) . "\\..\\..\\..\\..\\public\\include\\pageSetting\\index\\login_page.html";
			$pageContent = $VTs->GetHtmlContent($pagePath);
		}
		/*else{
			$isLoginContent = $this->getPageContent('index','after_login');
			$isLoginContent = str_replace("@@requestTokenCode@@",$_SESSION["requestTokenCode"],$isLoginContent);
			$this->viewContnet['pageContent']= $isLoginContent;
		}*/
		//----BI結束----
		$VTs = null;
		$this->viewContnet['pageContent'] = $pageContent;
        return new ViewModel($this->viewContnet);
    }
}
