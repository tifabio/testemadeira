<?php
/**
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $this->layout()->setVariable('title', 'Dashboard');
        
        $service = $this->getServiceLocator()->get('index_factory');
        
        $dashboard = array();
        
        $dashboard['cadastrados'] = $service->getQtdLivrosCadastrados();
        $dashboard['emprestados'] = $service->getQtdLivrosEmprestados();
        $dashboard['atrasados'] = $service->getQtdLivrosAtrasados();
        $dashboard['faturamento'][date('Y/m', strtotime("-1 month"))] = $service->getFaturamento(date('Y/m', strtotime("-1 month")));
        $dashboard['faturamento'][date('Y/m')] = $service->getFaturamento(date('Y/m'));

        return new ViewModel(array('dashboard' => $dashboard));
    }
}
