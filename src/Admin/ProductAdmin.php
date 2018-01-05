<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 04.01.2018
 * Time: 22:55
 */

namespace App\Admin;


use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ProductAdmin extends AbstractAdmin
{

    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('category')
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('isTop')
            ->add('imageFile', VichImageType::class)
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('category')
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('isTop')
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('category')
            ->addIdentifier('name')
            ->addIdentifier('price')
            ->add('isTop')
        ;
    }

}