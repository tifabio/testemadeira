<?php
/**
 */

namespace Login\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $this->layout('layout/login');
        
        $request = $this->getRequest();
        
        $authService = $this->getServiceLocator()->get('Zend\Authentication\AuthenticationService');
        $authService->clearIdentity();
        
        if($request->isPost()) {
            $data = $request->getPost();
    
            $adapter = $authService->getAdapter();
            $adapter->setIdentity($data['email']);
            $adapter->setCredential(md5($data['senha']));
            $authResult = $authService->authenticate();
        
            if ($authResult->isValid()) {
                return $this->redirect()->toRoute('admin');
            } else {
                return new ViewModel(array('error' => 'Usuário ou senha inválidos'));
            }

        }

        return new ViewModel();
    }
}
