<?php
namespace Admin\Helper;
use Zend\View\Helper\AbstractHelper;
 
class FormataMoeda extends AbstractHelper
{
    public function __invoke($valor)
    {
        $valor = (!empty($valor)) ? "R$ " . number_format($valor,2,",",".") : null;
        return $valor;
    }
}