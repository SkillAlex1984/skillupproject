<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 22.01.2018
 * Time: 20:45
 */

namespace App\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
class OrdersAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('id')
            ->add('count')
            ->add('amount')
            ->add('email')
            ->add('address')
            ->add('status')
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('count')
            ->add('amount')
            ->add('email')
            ->add('address')
            ->add('status')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('count')
            ->add('amount')
            ->add('email')
            ->add('address')
            ->add('status')
        ;
    }
}