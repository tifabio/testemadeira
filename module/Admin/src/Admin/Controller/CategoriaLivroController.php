<?php
/**
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class CategoriaLivroController extends AbstractActionController
{
    
    public function indexAction()
    {
        if($this->identity()->getIdtipo() > 2) $this->redirect()->toRoute('admin');
        
        $service = $this->getServiceLocator()->get('categoria_livro_factory');
        $lista = $service->getAll();
        
        $this->layout()->setVariable('title', 'Categorias de livro');
        
        return new ViewModel(array('lista' => $lista));
    }
    
    public function cadastrarAction()
    {
        if($this->identity()->getIdtipo() > 2) $this->redirect()->toRoute('admin');
        
        try {
            $this->layout()->setVariable('title', 'Nova categoria');
            
            $service = $this->getServiceLocator()->get('categoria_livro_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($request);
                $this->flashMessenger()->addSuccessMessage('Categoria salva com sucesso');
                return $this->redirect()->toRoute('categorialivro');    
            }
            
            return new ViewModel(array('form' => $service->getForm()));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('livro');
        }
    }
    
    public function editarAction()
    {
        if($this->identity()->getIdtipo() > 2) $this->redirect()->toRoute('admin');
        
        try {
            $this->layout()->setVariable('title', 'Editar categoria');
            
            $service = $this->getServiceLocator()->get('categoria_livro_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($this->getRequest());
                $this->flashMessenger()->addSuccessMessage('Categoria editada com sucesso');
                return $this->redirect()->toRoute('categorialivro');
            }
            
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('categorialivro');
    
            return new ViewModel(array('entity' => $entity, 'form' => $service->getForm($id)));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('livro');
        }
    }
    
    public function excluirAction()
    {
        if($this->identity()->getIdtipo() > 2) $this->redirect()->toRoute('admin');
        
        try {
            $service = $this->getServiceLocator()->get('categoria_livro_factory');
        
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('categorialivro');
            
            $service->delete($id);
            $this->flashMessenger()->addSuccessMessage('Categoria excluída com sucesso');
            
            return $this->redirect()->toRoute('categorialivro');
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('livro');
        }
    }
}
