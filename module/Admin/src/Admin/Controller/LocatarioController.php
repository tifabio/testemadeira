<?php
/**
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LocatarioController extends AbstractActionController
{
    
    public function indexAction()
    {
        $service = $this->getServiceLocator()->get('locatario_factory');
        $lista = $service->getAll();
        
        $this->layout()->setVariable('title', 'Locatários');
        
        return new ViewModel(array('lista' => $lista));
    }
    
    public function cadastrarAction()
    {
        try {
            $this->layout()->setVariable('title', 'Novo locatário');
            
            $service = $this->getServiceLocator()->get('locatario_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($request);
                $this->flashMessenger()->addSuccessMessage('Locatário salvo com sucesso');
                return $this->redirect()->toRoute('locatario');    
            }
            
            return new ViewModel(array('form' => $service->getForm()));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('locatario');
        }
    }
    
    public function editarAction()
    {
        try {
            $this->layout()->setVariable('title', 'Editar locatário');
            
            $service = $this->getServiceLocator()->get('locatario_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($this->getRequest());
                $this->flashMessenger()->addSuccessMessage('Locatário editado com sucesso');
                return $this->redirect()->toRoute('locatario');
            }
            
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('locatario');
    
            return new ViewModel(array('entity' => $entity, 'form' => $service->getForm($id)));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('locatario');
        }
    }
    
    public function perfilAction()
    {
        try {
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('admin');
            
            $this->layout()->setVariable('title', 'Editar perfil');
            
            $service = $this->getServiceLocator()->get('locatario_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($this->getRequest());
                $this->flashMessenger()->addSuccessMessage('Perfil editado com sucesso');
                return $this->redirect()->toRoute('locatario', array('action' => 'perfil' , 'id' => $id));
            }
    
            return new ViewModel(array('entity' => $entity, 'form' => $service->getForm($id)));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('locatario', array('action' => 'perfil' , 'id' => $id));
        }
    }
    
    public function excluirAction()
    {
        try {
            $service = $this->getServiceLocator()->get('locatario_factory');
            
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('locatario');
            
            $service->delete($id);
            $this->flashMessenger()->addSuccessMessage('Locatário excluído com sucesso');
            
            return $this->redirect()->toRoute('locatario');
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('locatario');
        }
    }
}
