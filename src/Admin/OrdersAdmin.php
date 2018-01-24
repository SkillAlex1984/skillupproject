<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 22.01.2018
 * Time: 20:45
 */

namespace App\Admin;

use App\Entity\Order;
use Knp\Menu\ItemInterface as MenuItemInterface;
use function PHPSTORM_META\type;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'draft' => Order::STATUS_DRAFT,
                    'ordered' => Order::STATUS_ORDERED,
                    'sent'=> Order::STATUS_SENT,
                    'received' => Order::STATUS_RECEIVED,
                    'comleted' => Order::STATUS_COMPLETED,
                ]
            ])
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
            ->add('isPaid', null, ['editable' => true])
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
            ->add('status', 'choice', [
                'editable' => true,
                'choices' => [
                    Order::STATUS_DRAFT => 'draft',
                    Order::STATUS_ORDERED => 'ordered',
                    Order::STATUS_SENT => 'sent',
                    Order::STATUS_RECEIVED => 'received',
                    Order::STATUS_COMPLETED => 'comleted',
                ],
                'catalogue' => 'messages',

            ])
            ->add('isPaid', null, ['editable' => true])
        ;
    }

    protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
        if (!$childAdmin && !in_array($action, ['edit', 'show'])) {
            return;
        }

        $admin = $this->isChild() ? $this->getParent() : $this;
        $id = $admin->getRequest()->get('id');

        if ($this->isGranted('EDIT')) {
            $menu->addChild('Edit Order', [
                'uri' => $admin->generateUrl('edit', ['id' => $id])
            ]);
        }

        if ($this->isGranted('LIST')) {
            $menu->addChild('Manage Items', [
                'uri' => $admin->generateUrl('admin.order_item.list', ['id' => $id])
            ]);
        }
    }


}