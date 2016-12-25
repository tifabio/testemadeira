<?php
namespace Admin\Helper;
use Zend\View\Helper\AbstractHelper;
 
class FormataData extends AbstractHelper
{
    public function __invoke($data)
    {
        $data = (!empty($data)) ? implode('/', array_reverse(explode('-', $data))) : null;
        return $data;
    }
}