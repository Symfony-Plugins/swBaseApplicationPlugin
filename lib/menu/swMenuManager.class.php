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
class swMenuManager
{
  
  static 
    $instance;

  protected
    $menu_handlers = array(),
    $menus = array(),
    $bound = false,
    $selector = null,
    $references = array();
  
  private function __construct()
  {
    $this->menus = array(
      'main'    => new swMenuElement,
      'sidebar' => new swMenuElement,
      'footer'  => new swMenuElement
    );
  } 
  
  public static function getInstance()
  {
    if(is_null(self::$instance))
    {
      self::$instance = new swMenuManager;
    }
    
    return self::$instance;
  }
  
  public function setSelector($selector)
  {
    $this->selector = $selector;
  }
  
  public function getSelector()
  {
    
    return $this->selector;
  }
  
  public function getMenu($name)
  {
    
    if(!isset($this->menus[$name]))
    {
      throw new sfException('The menu : '.$name.' is not defined');
    }
    
    if(!$this->menus[$name]->isBound())
    {
      $this->buildMenu();
    }
    
    return $this->menus[$name];
  }
  
  public function registerHandler($handler)
  {
    
    $this->menu_handlers[] = $handler;
  }
  
  public function buildMenu()
  {
    
    if($this->bound)
    {
      
      return;
    }
  
    $this->bound = true;
    
    $action_stack = sfContext::getInstance()->getActionStack()->getLastEntry();
    
    $params = array(
      'menus'  => &$this->menus,
      'action' => $action_stack,
    );
    
    $methods = array(
      'buildMenu_'.$action_stack->getModuleName().'_'.$action_stack->getActionName(),
      'buildMenu_'.$action_stack->getActionName(),
      'buildMenu',
    );

    foreach($this->menu_handlers as $handler)
    {

      if(!sfAutoload::getInstance()->loadClass($handler))
      {

        throw new sfException(sprintf('The class "%s" does not exists', $handler));
      }
      
      if(is_string($handler))
      {
        $handler = new $handler;
      }
      
      if(is_object($handler))
      {
        foreach($methods as $method )
        {
          if(method_exists($handler, 'canBuild') && !call_user_func_array(array($handler, 'canBuild'), $params))
          {
            continue;
          }
          
          if(method_exists($handler, $method))
          {
            call_user_func_array(array($handler, $method), $params);
            
            continue;
          }
        }
      }

      if(is_callable($handler))
      {
        call_user_func_array($handler, $params);
      }
    }
  }
  
  /**
   * register a menu handler, a menu handler is used to define only branch of
   * the menu structure. 
   * 
   * @param sfEvent $e
   * @return unknown_type
   */
  public static function listenToModuleMenuHandler(sfEvent $e)
  {
    self::getInstance()->registerHandler($e->getSubject());
    
    $e->setProcessed(true);
  }
}