<?php
/**
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class LivroController extends AbstractActionController
{
    
    public function indexAction()
    {
        $service = $this->getServiceLocator()->get('livro_factory');
        $lista = $service->getAll();
        
        $this->layout()->setVariable('title', 'Livros');
        
        return new ViewModel(array('lista' => $lista));
    }
    
    public function cadastrarAction()
    {
        try {
            $this->layout()->setVariable('title', 'Novo livro');
            
            $service = $this->getServiceLocator()->get('livro_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($request);
                $this->flashMessenger()->addSuccessMessage('Livro salvo com sucesso');
                return $this->redirect()->toRoute('livro');    
            }
            
            return new ViewModel(array('form' => $service->getForm()));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('livro');
        }
    }
    
    public function editarAction()
    {
        try {
            $this->layout()->setVariable('title', 'Editar livro');
            
            $service = $this->getServiceLocator()->get('livro_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($this->getRequest());
                $this->flashMessenger()->addSuccessMessage('Livro editado com sucesso');
                return $this->redirect()->toRoute('livro');
            }
            
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('livro');
    
            return new ViewModel(array('entity' => $entity, 'form' => $service->getForm($id)));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('livro');
        }
    }
    
    public function excluirAction()
    {
        try {
            $service = $this->getServiceLocator()->get('livro_factory');
            
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('livro');
            
            $service->delete($id);
            $this->flashMessenger()->addSuccessMessage('Livro excluído com sucesso');
            
            return $this->redirect()->toRoute('livro');
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('livro');
        }
    }
}
