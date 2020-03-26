<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Dynamic_menu {

    private $ci;                // for CodeIgniter Super Global Reference.
    private $id_menu        = 'id="dyn_menu"';
    private $class_menu     = 'class="nav nav-list"';
    private $class_parent   = 'class="submenu"';
    private $class_last     = 'last';

    // --------------------------------------------------------------------

    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
	// $this->load->library('database');
    }

    // --------------------------------------------------------------------

    /**
     * build_menu($table, $type)
     *
     * Description:
     *
     * builds the Dynaminc dropdown menu
     * $table allows for passing in a MySQL table name for different menu tables.
     * $type is for the type of menu to display ie; topmenu, mainmenu, sidebar menu
     * or a footer menu.
     *
     * @param    string    the MySQL database table name.
     * @param    string    the type of menu to display.
     * @return    string    $html_out using CodeIgniter achor tags.
     */
    function build_menu($table = '', $type = '0',$otori = '0')
    {
        $menu = array();
        $tampung = array();

        // use active record database to get the menu.
        $role = $this->ci->session->userdata('role');
    	$query=$this->ci->db
        ->select("
            dyn_menu.id,
            dyn_menu.title,
            dyn_menu.icon,
            dyn_menu.link_type,
            dyn_menu.page_id,
            dyn_menu.module_name,
            dyn_menu.url,
            dyn_menu.uri,
            dyn_menu.dyn_group_id,
            dyn_menu.position,
            dyn_menu.target,
            dyn_menu.parent_id,
            dyn_menu.is_parent,
            dyn_menu.show_menu")
        ->from("dyn_menu")
        ->join("otori","dyn_menu.id=otori.menu_id")
        ->where("otori.user_id",$role)
        ->order_by("dyn_menu.page_id")
        ->get("");
    	$x = 1;
        
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $tampung[$x]            = $row->id;
                $x = $x+1;

                $menu[$row->id]['id']           = $row->id;
                $menu[$row->id]['title']        = $row->title;
                $menu[$row->id]['icon']         = $row->icon;
                $menu[$row->id]['link']         = $row->link_type;
                $menu[$row->id]['page']         = $row->page_id;
                $menu[$row->id]['module']       = $row->module_name;
                $menu[$row->id]['url']          = $row->url;
                $menu[$row->id]['uri']          = $row->uri;
                $menu[$row->id]['dyn_group']    = $row->dyn_group_id;
                $menu[$row->id]['position']     = $row->position;
                $menu[$row->id]['target']       = $row->target;
                $menu[$row->id]['parent']       = $row->parent_id;
                $menu[$row->id]['is_parent']    = $row->is_parent;
                $menu[$row->id]['show']         = $row->show_menu;
            }
        }
        $query->free_result();    // The $query result object will no longer be available
            
        // now we will build the dynamic menus.
        $html_out  = "\t".'<div '.$this->id_menu.'>'."\n";

        /**
        * check $type for the type of menu to display.
        *
        * ( 0 = top menu ) ( 1 = horizontal ) ( 2 = vertical ) ( 3 = footer menu ).
        */
        switch ($type)
        {
            case 0:            // 0 = top menu
            break;

            case 1:            // 1 = horizontal menu
                $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
                break;

            case 2:            // 2 = sidebar menu
                break;

                case 3:            // 3 = footer menu
                break;

            default:        // default = horizontal menu
                $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";

                break;
        }
    	
        //echo "COUNT = (".count($menu).")<br />"; 
        // loop through the $menu array() and build the parent menus.
    	//print_r($menu);
    	//echo "<br /> ===>".$menu[30]['id']."<===<br />";

    	$x = 1;

    	//print_r($tampung);

        for ($a = 1; $a <= count($menu); $a++)
        {
    		$xid = $tampung[$a];
    		//echo "<br />====================================>$xid<br />";
            if (is_array($menu[$xid]))    // must be by construction but let's keep the errors home
            {
                if ($menu[$xid]['show'] == 1 && $menu[$xid]['parent'] == 0)    // are we allowed to see this menu?
                {
    				
        			if ($menu[$xid]['is_parent'] == TRUE)
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= "\t\t\t".'<li class="">'.anchor($menu[$xid]['url'],'<i class="menu-icon fa '.$menu[$xid]['icon'].'"></i><span class="menu-text">'.$menu[$xid]['title'].'</span><b class="arrow"></b>');
                    }
                    else
                    {
                        $html_out .= "\t\t\t\t".'<li class="">'.anchor($menu[$xid]['url'],'<i class="menu-icon fa '.$menu[$xid]['icon'].'"></i><span class="menu-text">'.$menu[$xid]['title'].'</span><b class="arrow fa fa-angle-down"></b>','class="dropdown-toggle"').'<b class="arrow"></b>';
                    }

                    // loop through and build all the child submenus.
                    $html_out .= $this->get_childs($menu, $xid, $tampung);

                    $html_out .= '</li>'."\n";
                }
            }
            else
            {
                exit (sprintf('menu nr %s must be an array', $xid));
            }
    	}

        $html_out .= "\t\t".'</ul>' . "\n";
        $html_out .= "\t".'</div>' . "\n";
        return $html_out;
    }
    
    // --------------------------------------------------------------------

    /**
    * get_childs($menu, $parent_id) - SEE Above Method.
    *
    * Description:
    *
    * Builds all child submenus using a recurse method call.
    *
    * @param    mixed    $menu    array()
    * @param    string    $parent_id    id of parent calling this method.
    * @return    mixed    $html_out if has subcats else FALSE
    */
    function get_childs($menu, $parent_id, $tampung)
    {
        //print_r($tampung);

    	$has_subcats = FALSE;

        $html_out  = '';
        //$html_out .= "\n\t\t\t\t".'<div>'."\n";
        $html_out .= "\t\t\t\t\t".'<ul class="submenu">'."\n";

    	for ($a = 1; $a <= count($menu); $a++)
        {
    		$xid = $tampung[$a];
    		
            if ($menu[$xid ]['show'] == 1 && $menu[$xid ]['parent'] == $parent_id)    // are we allowed to see this menu?
            {
                $has_subcats = TRUE;

                if ($menu[$xid ]['is_parent'] == TRUE)
                {
                    $html_out .= "\t\t\t\t".'<li class="">'.anchor($menu[$xid]['url'],'<i class="menu-icon fa '.$menu[$xid]['icon'].'"></i><span class="menu-text">'.$menu[$xid]['title'].'</span><b class="arrow fa fa-angle-down"></b>','class="dropdown-toggle"').'<b class="arrow"></b>';
                }
                else
                {
                    $html_out .= "\t\t\t\t\t\t".'<li class="">'.anchor($menu[$xid ]['url'], '<i class="menu-icon fa fa-caret-right"></i><span>'.$menu[$xid ]['title'].'</span>').'<b class="arrow"></b>';
                }

                // Recurse call to get more child submenus.
                $html_out .= $this->get_childs($menu, $xid , $tampung);

                $html_out .= '</li>' . "\n";
            }
        }

        $html_out .= "\t\t\t\t\t".'</ul>' . "\n";
        //$html_out .= "\t\t\t\t".'</div>' . "\n";

        return ($has_subcats) ? $html_out : FALSE;
    }

}

// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.

// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  