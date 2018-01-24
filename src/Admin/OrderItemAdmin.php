<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 23.01.2018
 * Time: 19:15
 */

namespace App\Admin;

use function PHPSTORM_META\type;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

class OrderItemAdmin extends AbstractAdmin
{
    public function getParentAssociationMapping()
    {
        return 'order';
    }


    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('product')
            ->add('count')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('product')
            ->add('count')
            ->add('amount')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('product')
            ->addIdentifier('count')
            ->addIdentifier('amount')
        ;
    }
}