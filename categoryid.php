<?php

require_once('app/Mage.php'); //Path to Magento
umask(0);
Mage::app();






$rootcatId= Mage::app()->getStore()->getRootCategoryId();
$categories = Mage::getModel('catalog/category')->getCategories($rootcatId);
function  get_categories($categories) {
    $array= '<ul>';
    foreach($categories as $category) {
        $cat = Mage::getModel('catalog/category')->load($category->getId());
        $count = $cat->getProductCount();
        $array .= '<li>'.
        '<a href="' . Mage::getUrl($cat->getUrlPath()). '">' .
                  $category->getName() . "(".$category->getId().")</a>\n";
        if($category->hasChildren()) {
            $children = Mage::getModel('catalog/category')->getCategories($category->getId());
             $array .=  get_categories($children);
            }
         $array .= '</li>';
    }
    return  $array . '</ul>';
}
echo  get_categories($categories); 






?>





