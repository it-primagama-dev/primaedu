<?php

/************************************************
 * Author       : hamzah                        *
 * Email        : if.hamzah93@gmail.com         *
 * Blogger      : hamzahkerenz.blogspot.com     *
 ************************************************/

class Sidebar_menu {

    function __construct()
    {
        $this->ci =& get_instance();
    }

    public function sess()
    {
        $sess = ($this->ci->session->userdata('KodeAreaCabang').' - '.$this->ci->session->userdata('NamaAreaCabang'));
        return $sess;
    }

    private function _buildMenu($ctl,$group,$menu,$ii) {
        if($group)
        {
            echo '<li>';
            echo '<a class="active" href="#menu_'.$ii.'" data-toggle="collapse" aria-expanded="false">'.$group.'</a>';
            echo '<ul class="collapse sub-menu" id="menu_'.$ii.'">';
            foreach ($menu as $item)
            {
                echo ($ctl == $item['ControllerName']) ? '<li class="active">' : '<li>';
                $withorder = explode(";", $item['MenuItem']);
                $menuitem = count($withorder) == 1 ? $item['MenuItem'] : $withorder[1];
                if ($item['Status']==1) {
                    echo '<a href="'.str_replace('spe/', '', base_url($item['ControllerName'])).'">'.$menuitem.'</a>';
                } else {
                    echo '<a href="'.base_url($item['ControllerName']).'">'.$menuitem.'</a>';
                }
                echo '</li>';
            }
            echo '</ul>';
            echo '</li>';
        }
        else
        {
            foreach ($menu as $item)
            {
                echo ($ctl == $item['ControllerName']) ? '<li class="active">' : '<li>';
                if ($item['Status']==1) {
                    echo '<a href="'.str_replace('spe/', '',base_url($item['ControllerName'])).'">'.$item['MenuItem'].'</a>';
                } else {
                    echo '<a href="'.base_url($item['ControllerName']).'">'.$item['MenuItem'].'</a>';
                }
                echo '</li>';
            }
        }
    }

    public function getMenu()
    {

        $this->ci->db->select('MenuItemsGroupName,MenuItem,ControllerName,ActionName,Status');
        $this->ci->db->from('TPrimaEdu_Prod.dbo.Usergroupsdetail');
        $this->ci->db->join('TPrimaEdu_Prod.dbo.Menuitems m', 'Usergroupsdetail.MenuItems = m.RecID','left');
        $this->ci->db->join('TPrimaEdu_Prod.dbo.Menuitemsgroup n', 'm.MenuItemsGroup = n.MenuItemsGroupId', 'left');
        $this->ci->db->where('Usergroupsdetail.UserGroup',$this->ci->session->userdata('UserGroup'));
        $this->ci->db->where('m.Hide',0);
        $this->ci->db->order_by('n.MenuItemsGroupOrder,m.MenuItem');
        $sql = $this->ci->db->get();

        $element = []; $i = 0;
        foreach ($sql->result_array() as $menu)
        {
            $element[$menu['MenuItemsGroupName']][$i] = array(
                'MenuItem' => $menu['MenuItem'],
                'ControllerName' => $menu['ControllerName'],
                'Status' => $menu['Status'],
                'ActionName' => $menu['ActionName']
            );
            $i++;
        }
        echo '<div id="sidebar">';
        echo '<ul class="list-unstyled components">';
        echo ($ctl == 'index') ? '<li class="active">' : '<li>';
        echo '<a style="background-color:#fff;color:#000000;" href="'.base_url().'"><i class="fa fa-home"></i> Home</a></li>';
        $ii=1;
        foreach ($element as $group => $menu)
        {
            $this->_buildMenu($ctl,$group,$menu,$ii);
            $ii++;
        }
        echo '</ul>';
        echo '</div>';
    }
}
