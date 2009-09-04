<?php

/*
 * This file is part of the swBaseApplicationPlugin package.
 *
 * (c) 2008 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class swExtraMenuComponents extends sfComponents
{
  
  public function executeRenderMenu()
  {
    
    $name = isset($this->name) ? $this->name : 'main';
    
    $menu = swMenuManager::getInstance()->getMenu($name);
    
    $rendered = $menu->render();
    
    echo $rendered;
    
    return sfView::NONE;
  }
}