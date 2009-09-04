<?php

/*
 * This file is part of the swBaseApplicationPlugin package.
 *
 * (c) 2008 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    swToolboxPlugin
 * @author     Thomas Rabaix <thomas.rabaix@soleoweb.com>
 * @version    SVN: $Id$
 */
class swMenuElementFormatter
{
  
  public function renderLink($element, $level = 0)
  {
    $name = str_repeat("&nbsp;&nbsp;", $level * 2).$element->getName();
    $link_to = $name;
    
    if($element->getRoute())
    {
      $link_to = link_to($name, $element->getRoute(), $element->getLinkParams());
    }
    
    return $link_to; 
  }
  
  public function render(swMenuElement $element, $level = 0)
  {
    
    $html = '';
    
    if($level > 0)
    {
      $html .= sprintf("<li class='%s' style='%s' id='%s'>%s",
        $element->getClass(),
        $element->getStyle(),
        $element->getId(),
        $this->renderLink($element, $level))
      ;
    }
    
    if(count($element->getChildren()) > 0)
    {
      $html .= sprintf("<ul class='sw-menu-element sw-menu-element-group-level-%s'>", $level);
      foreach($element->getChildren() as $child)
      {
        $html .= $child->render($level + 1);
      }
      
      $html .= "</ul>";
    }
    
    if($level > 0)
    {
      $html .= "</li>";
    }
    
    return $html;
  }
}