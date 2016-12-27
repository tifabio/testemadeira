<?php
/**
 */

namespace Admin\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UsuarioController extends AbstractActionController
{
    public static function auth($usuario, $inputPassword) 
    {
        return ($inputPassword == $usuario->getSenha());
    }
    
    public function indexAction()
    {
        $service = $this->getServiceLocator()->get('usuario_factory');
        $lista = $service->getAll();
        
        $this->layout()->setVariable('title', 'Usuários');
        
        return new ViewModel(array('lista' => $lista));
    }
    
    public function cadastrarAction()
    {
        try {
            $this->layout()->setVariable('title', 'Novo usuário');
            
            $service = $this->getServiceLocator()->get('usuario_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($request);
                $this->flashMessenger()->addSuccessMessage('Usuário salvo com sucesso');
                return $this->redirect()->toRoute('usuario');    
            }
            
            return new ViewModel(array('form' => $service->getForm()));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('usuario');
        }
    }
    
    public function editarAction()
    {
        try {
            $this->layout()->setVariable('title', 'Editar usuário');
            
            $service = $this->getServiceLocator()->get('usuario_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($this->getRequest());
                $this->flashMessenger()->addSuccessMessage('Usuário editado com sucesso');
                return $this->redirect()->toRoute('usuario');
            }
            
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('usuario');
    
            return new ViewModel(array('entity' => $entity, 'form' => $service->getForm($id)));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('usuario');
        }
    }
    
    public function perfilAction()
    {
        try {
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('admin');
            
            $this->layout()->setVariable('title', 'Editar perfil');
            
            $service = $this->getServiceLocator()->get('usuario_factory');
            
            $request = $this->getRequest();
            
            if($request->isPost()) {
                $service->save($this->getRequest());
                $this->flashMessenger()->addSuccessMessage('Perfil editado com sucesso');
                return $this->redirect()->toRoute('usuario', array('action' => 'perfil' , 'id' => $id));
            }
    
            return new ViewModel(array('entity' => $entity, 'form' => $service->getForm($id)));
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('usuario', array('action' => 'perfil' , 'id' => $id));
        }
    }
    
    public function excluirAction()
    {
        try {
            $service = $this->getServiceLocator()->get('usuario_factory');
            
            $id = $this->params()->fromRoute("id", 0);
            
            if($id == 0) return $this->redirect()->toRoute('usuario');
            
            $service->delete($id);
            $this->flashMessenger()->addSuccessMessage('Usuário excluído com sucesso');
            
            return $this->redirect()->toRoute('usuario');
        } catch (\Exception $e) {
            $this->flashMessenger()->addErrorMessage('Ocorreu um erro: ' . $e->getMessage());
            return $this->redirect()->toRoute('usuario');
        }
    }
}
