<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 28.12.2017
 * Time: 8:40
 */

namespace App\Menu;


use App\Service\Catalogue;
use Knp\Menu\FactoryInterface;

class MenuBuilder
{
    private $factory;

    /**
     * @var Catalogue
     */
    private $catalogueService;

    /**
     * @param FactoryInterface $factory
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, Catalogue $catalogue)
    {
        $this->factory = $factory;
        $this->catalogueService = $catalogue;
    }

    public function createMainMenu(array $options)
    {
        $menu = $this->factory->createItem('root');

        $menu->addChild('Главная', ['route' => 'about_show']);
        $catalogueMenu =  $menu->addChild('Каталог', ['route' => 'category_list']);

        foreach ($this->catalogueService->getTopCategories() as $category) {
            $catalogueMenu->addChild($category->getName(), ['route' => 'category_show',
                'routeParameters' => ['slug' => $category->getSlug()],
                ]);
        }

        return $menu;
    }
}