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
        
        // se for usuario do tipo locatário, traz a sua quantidade de livros (emprestados/atrasados)
        $id_locatario = ($this->identity()->getIdtipo() == 3) ? $this->identity()->getId() : 0;
        
        $dashboard = array();
        
        $dashboard['cadastrados'] = $service->getQtdLivrosCadastrados();
        $dashboard['emprestados'] = $service->getQtdLivrosEmprestados($id_locatario);
        $dashboard['atrasados'] = $service->getQtdLivrosAtrasados($id_locatario);
        $dashboard['faturamento'][date('Y/m', strtotime("-1 month"))] = $service->getFaturamento(date('Y/m', strtotime("-1 month")));
        $dashboard['faturamento'][date('Y/m')] = $service->getFaturamento(date('Y/m'));

        return new ViewModel(array('dashboard' => $dashboard));
    }
}
