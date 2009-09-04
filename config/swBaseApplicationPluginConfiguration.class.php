<?php
/*
 * This file is part of the swBaseApplicationPlugin package.
 *
 * (c) 2008 Thomas Rabaix <thomas.rabaix@soleoweb.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class swBaseApplicationPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  {

    // Menu Manager
    $this->dispatcher->connect('sw_menu_manager.register_listener', array('swMenuManager', 'listenToModuleMenuHandler'));
  }
}