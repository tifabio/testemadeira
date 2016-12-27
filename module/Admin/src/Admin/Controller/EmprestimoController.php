<?php
/**
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class EmprestimoController extends AbstractActionController
{
    
    public function indexAction()
    {
        // se for usuario do tipo locatário, traz os empréstimos dele
        $id_locatario = ($this->identity()->getIdtipo() == 3) ? $this->identity()->getId() : 0;
        
        $service = $this->getServiceLocator()->get('emprestimo_factory');
        $lista = $service->getAll($id_locatario);
        
        $this->layout()->setVariable('title', 'Empréstimos');
        
        return new ViewModel(array('lista' => $lista));
    }
    
    public function retirarAction()
    {
        // se for usuario do tipo locatário, traz o formulário adaptado
        $id_locatario = ($this->identity()->getIdtipo() == 3) ? $this->identity()->getId() : 0;
        
        try {
            $this->layout()->setVariable('title', 'Novo empréstimo');
            
            $service = $this->getServiceLocator()->get('emprestimo_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($request);
                $this->flashMessenger()->addSuccessMessage('Empréstimo salvo com sucesso');
                return $this->redirect()->toRoute('emprestimo');    
            }
            
            return new ViewModel(array('form' => $service->getForm($id_locatario)));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('emprestimo');
        }
    }
    
    public function devolverAction()
    {
        try {
            $service = $this->getServiceLocator()->get('emprestimo_factory');
            
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('emprestimo');
            
            $service->devolver($id);
            $this->flashMessenger()->addSuccessMessage('Empréstimo devolvido com sucesso');
            
            return $this->redirect()->toRoute('emprestimo');
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('emprestimo');
        }
    }
}
