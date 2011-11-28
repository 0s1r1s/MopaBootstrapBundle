<?php
namespace Mopa\BootstrapBundle\Topbar;

use Knp\Menu\ItemInterface;

use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Base class for Topbar Menubuilder's which has some useful methods for bootstrap generation
 * @author phiamo
 *
 */
abstract class AbstractTopbarMenuBuilder
{
    protected $factory;

    /**
     * @param FactoryInterface $factory
     */
    public function __construct(FactoryInterface $factory)
    {
        $this->factory = $factory;
    }
    
    /**
     * get a preconfigured Dropdown menu where to easily add childs
     * 
     * @param string $title Title of the item
     * @param boolean $push_right Make if float right default: true
     */
    protected function getDropdownMenuItem(ItemInterface $rootItem, $title, $push_right = true){
        $rootItem
            ->setAttribute('data-dropdown', 'dropdown')
            ->setAttribute('class', 'nav')
        ;
        if($push_right){
            $this->pushRight($rootItem);
        }
        $dropdown = $rootItem->addChild($title, array('uri'=>'#'))
            ->setLinkattribute('class', 'dropdown-toggle')
            ->setChildrenAttribute('class', 'dropdown-menu')
        ;
        return $dropdown;
    }
    protected function pushRight(ItemInterface $item){
        $item->setAttribute('class', 'nav secondary-nav');
        return $item; 
    }
    /**
     * add a divider to the dropdown Menu
     * 
     * @param ItemInterface $dropdown The dropdown Menu
     */
    protected function addDivider(ItemInterface $dropdown){
        $divider = $dropdown->addChild('divider')
            ->setLabel('')
            ->setAttribute('class', 'divider')
        ;
    }
}