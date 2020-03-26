<?php

/* 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

use Phalcon\Mvc\User\Component;

class Sidebar extends Component
{
    private function _buildMenu($ctl, $group, $menu) {
	$username = $this->session->get('auth')["username"];
        if($group)
        {
            echo '<li>';
            echo '<a class="dropdown-toggle" href="#">'.$group.'</a>';
            echo '<ul class="dropdown-menu" data-role="dropdown">';
            foreach ($menu as $item)
            {
		$enabled = true;
                if ($group == "Laporan") {
                    if (strtolower($item['ControllerName']) == strtolower('RptOperasional/pwe')) {
			$user = array("ridwan.sobar", "jeremia");
                        if (!in_array($username, $user)) {
                            $enabled = false;
                        }
                    }
                }

		if ($enabled == true) {
                	echo ($ctl == $item['ControllerName']) ? '<li class="active">' : '<li>';
                	$withorder = explode(";", $item['MenuItem']);
                	$menuitem = count($withorder) == 1 ? $item['MenuItem'] : $withorder[1];
                	if ($item['Status']==0) {
                    		echo $this->tag->linkTo('spe/'.$item['ControllerName'], $menuitem);
                	} else {
                    		echo $this->tag->linkTo($item['ControllerName'], $menuitem);
                	}
                	echo '</li>';
		}
            }
            echo '</ul></li>';
        }
        else
        {
            foreach ($menu as $item)
            {
                echo ($ctl == $item['ControllerName']) ? '<li class="active">' : '<li>';
                echo $this->tag->linkTo($item['ControllerName'], $item['MenuItem']);
                echo '</li>';
            }
        }
    }

    public function getMenu()
    {
        $menus = $this->session->get('menu');
        $ctl = $this->view->getControllerName();
        echo '<div id="sidebar" class="column">';
/* TOC-RB 05-06-2015 */
//        echo '<div class="brand-logo">';
//        echo '<img src="'.$this->url->getStatic('img/logo-primagama-kiri-small.png').'">';
//        echo '</div>';
        echo '<div class="wrap">';
        echo '<nav class="sidebar custom"><ul><li class="title">Sidebar</li>';
        echo ($ctl == 'index') ? '<li class="active">' : '<li>';
        echo '<a href="'.$this->url->getBaseUri().'"><i class="icon-home"></i>Beranda</a></li>';
        foreach ($menus as $group => $menu)
        {
            $this->_buildMenu($ctl, $group, $menu);
        }
        echo '</div>';
        echo '</nav></ul></div>';
    }
}
