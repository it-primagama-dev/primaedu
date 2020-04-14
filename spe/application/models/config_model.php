<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/************************************************
 * Author       : hamzah                        *
 * Email        : if.hamzah93@gmail.com         *
 * Blogger      : hamzahkerenz.blogspot.com     *
 ************************************************/

class Config_model extends CI_Model
{
    function __construct()
    {
        #$this->db2 = $this->load->database('primaedu', TRUE);
    }

    function find($params = array(), $is_row_array = FALSE) {
        try {
            $this->db->select(isset($params['select']) ? $params['select'] : array());
            $this->db->from(isset($params['from']) ? $params['from'] : $this->table_name);

            if (isset($params['join'])) {
                foreach ($params['join'] as $key => $join) {
                    $this->db->join($key, $join['on'], $join['type']);
                }
            }

            $this->db->where(isset($params['where']) ? $params['where'] : array());
            $this->db->or_where(isset($params['or_where']) ? $params['or_where'] : array());

            $this->db->having(isset($params['having']) ? $params['having'] : array());

            if (isset($params['like'])) {
                foreach ($params['like'] as $key => $value) {
                    $this->db->like($key, $value);
                }
            }

            $this->db->group_by(isset($params['group_by']) ? $params['group_by'] : array());

            if (isset($params['order_by'])) {
                foreach ($params['order_by'] as $key => $order) {
                    $this->db->order_by($key, $order);
                }
            }

            $page = isset($params['page']) ? $params['page'] : 0;
            $items_per_page = isset($params['items_per_page']) ? $params['items_per_page'] : NULL;

            if (!empty($items_per_page)) {
                $offset = /*($page - 1) * $items_per_page*/$page;
                $this->db->limit($items_per_page, $offset);
            }

            $query = $this->db->get();
            // var_dump($this->db->last_query());

            // return $is_row_array ? $query->row_array() : $query->result_array();
            return $query;
        } catch (Exception $e) {
            return FALSE;
        }
    }

    function find_one($params) {
        return $this->find($params, TRUE);
    }

    function insert($params) {
        try {
            $this->db->trans_start();

            $params_insert = isset($params['params']) ? $params['params'] : array();
            $this->db->where(isset($params['where']) ? $params['where'] : array());
            $this->db->or_where(isset($params['or_where']) ? $params['or_where'] : array());

            $this->db->insert(isset($params['from']) ? $params['from'] : $this->table_name, $params_insert);
            $id = $this->db->insert_id();
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return $id;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    function update($params) {
        try {
            $this->db->trans_start();

            $params_update = isset($params['params']) ? $params['params'] : array();
            $this->db->where(isset($params['where']) ? $params['where'] : array());
            $this->db->or_where(isset($params['or_where']) ? $params['or_where'] : array());

            $this->db->update(isset($params['from']) ? $params['from'] : $this->table_name, $params_update);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return TRUE;
            }
        } catch (Exception $e) {
            return FALSE;
        }
    }

    function delete($params) {
        try {
            $this->db->where(isset($params['where']) ? $params['where'] : array());
            $this->db->or_where(isset($params['or_where']) ? $params['or_where'] : array());

            $this->db->delete(isset($params['from']) ? $params['from'] : $this->table_name);
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }

    function upload_file($filename) {
        $this->load->library('upload');
        
        $config['upload_path'] = './assets/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size'] = '2048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;
    
        $this->upload->initialize($config);
        if($this->upload->do_upload('file')) {
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        }else{
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
    
    function insert_multiple($data,$table){
        try {
            $this->db->insert_batch($table, $data);
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }

    function delete_multiple($params) {
        try {
            $this->db->where_in(isset($params['where']) ? $params['where'] : array());

            $this->db->delete(isset($params['from']) ? $params['from'] : $this->table_name);
            return TRUE;
        } catch (Exception $e) {
            return FALSE;
        }
    }

    public function manualQuery($sql)
    {
        $this->db->query($sql);
    }

    public function getSelectedData($table,$data)
    {
        return $this->db->get_where($table, $data);
    }
    
    public function delete_item($id)
    {
        $this->db->where("RecID in ($id)");
        $this->db->delete('Logistics_MasterItem');
    }
    
    public function delete_exp($id)
    {
        $this->db->where("RecID in ($id)");
        $this->db->delete('Logistics_Expedisi');
    }

    public function get_pr(){
        $year = date('Y');
        $branch = $this->session->userdata('KodeAreaCabang');
        $q = $this->db->query("select MAX(RIGHT(PR_Number,2)) as PR from Logistics_POHeader where BranchCode = $branch");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->PR)+1;
                $kd = sprintf("%02s", $tmp);
            }
        }else{
            $kd = "01";
        }
        return "PR".$year.'-'.$branch.'-'.$kd;
    }

    public function get_invoice(){
        $curmonth = date('m');
        $year = date('y');
        //$branch = $this->session->userdata('KodeAreaCabang');
        $month = get_indo_rmw($curmonth);
        $q = $this->db->query("SELECT MAX(RIGHT(Invoice_Number,5)) as INV from Logistics_Invoice Where MONTH(Invoice_Date)=MONTH(GETDATE())");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->INV)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }else{
            $kd = "00001";
        }
        return "INV-FA/SB/".$month.'/'.$year.'/'.$kd;
    }

    public function get_do(){
        $curmonth = date('m');
        $month = get_indo_bln($curmonth);
        $year = date('Y');
        //$year = tgl_indo($yearori);
        $q = $this->db->query("SELECT MAX(RIGHT(DO_Number,4)) as DO from Logistics_DOHeader Where SUBSTRING(DO_Number,3,4)='$year' AND SUBSTRING(DO_Number,8,3)='$month'");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->DO)+1;
                $kd = sprintf("%004s", $tmp);
            }
        }else{
            $kd = "0001";
        }
        return "DN".$year.'-'.$month.'-'.$kd;
    }

    private function _get_datatables_query($params=array())
    {
        if (isset($params['distinct'])) {
            $this->db->distinct();
        }
        $this->db->select(isset($params['select']) ? $params['select'] : array());
        $this->db->from(isset($params['from']) ? $params['from'] : $this->table_name);
        $this->db->where(isset($params['where']) ? $params['where'] : array());
        $this->db->having(isset($params['having']) ? $params['having'] : array());
        $this->db->group_by(isset($params['group_by']) ? $params['group_by'] : array());

        if (isset($params['join'])) {
            foreach ($params['join'] as $key => $join) {
                $this->db->join($key, $join['on'], $join['type']);
            }
        }
        if (isset($params['where_in'])) {
            foreach ($params['where_in'] as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }

        if (isset($params['or_where_in'])) {
            foreach ($params['or_where_in'] as $key => $value) {
                $this->db->or_where_in($key, $value);
            }
        }

        if (isset($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $key => $value) {
                $this->db->where_not_in($key, $value);
            }
        }

        if (isset($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $key => $value) {
                $this->db->where_not_in($key, $value);
            }
        }


        if (isset($params['or_where'])) {
            #loop column 
            $i = 0;
            foreach ($params['or_where'] as $key => $value) {
                #first loop
                if($i===0) {
                    #open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->or_group_start();
                    $this->db->or_where($key, $value);
                } else {
                    $this->db->where($key, $value);
                }

                #last loop
                if(count($params['or_where']) - 1 == $i)
                #close bracket
                $this->db->group_end();
                $i++;
            }
        }

        if (isset($params['where_and_in'])) {
            $this->db->where(isset($params['where_and_in']['where']) ? $params['where_and_in']['where']:array());
            if (isset($params['where_and_in']['where_in'])) {
                foreach ($params['where_and_in']['where_in'] as $key => $value) {
                    $this->db->where_in($key, $value);
                }
            }
        }

        if (isset($params['or_where_and_in'])) {
            $this->db->or_where(isset($params['or_where_and_in']['where']) ? $params['or_where_and_in']['where']:array());
            if (isset($params['or_where_and_in']['where_in'])) {
                foreach ($params['or_where_and_in']['where_in'] as $key => $value) {
                    $this->db->where_in($key, $value);
                }
            }
        }
        
        if (isset($params['column_search']) && !empty($params['column_search'])) {
            $column_search = $params['column_search'];
        } else {
            $column_search = isset($params['select']) ? $params['select'] : array();
        }
        #loop column 
        $i = 0;
        foreach ($column_search as $item) {
            if(isset($_POST['search']['value'])) {  
                #first loop
                if($i===0) {
                    #open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                #last loop
                if(count($column_search) - 1 == $i)
                #close bracket
                $this->db->group_end();
            }
            $i++;
        }
        
        if(isset($_POST['order'])) {
            $this->db->order_by($column_search[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else {
            if (isset($params['order_by'])) {
                foreach ($params['order_by'] as $key => $order) {
                    $this->db->order_by($key, $order);
                }
            }
        }
    }

    function get_datatables($params=array())
    {
        $this->_get_datatables_query($params);
        if(isset($_POST["length"]) && $_POST["length"] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        // echo "<pre>";
        // pr($this->db->last_query());
        return ($query->num_rows() > 0) ? $query->result_array():false;
    }

    function count_filtered($params=array())
    {
        $this->_get_datatables_query($params);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($params=array())
    {
        if (isset($params['distinct'])) {
            $this->db->distinct();
        }
        $this->db->select(isset($params['select']) ? $params['select'] : array());
        $this->db->from(isset($params['from']) ? $params['from'] : $this->table_name);
        $this->db->where(isset($params['where']) ? $params['where'] : array());
        $this->db->having(isset($params['having']) ? $params['having'] : array());
        $this->db->group_by(isset($params['group_by']) ? $params['group_by'] : array());

        if (isset($params['join'])) {
            foreach ($params['join'] as $key => $join) {
                $this->db->join($key, $join['on'], $join['type']);
            }
        }
        if (isset($params['where_in'])) {
            foreach ($params['where_in'] as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }

        if (isset($params['or_where_in'])) {
            foreach ($params['or_where_in'] as $key => $value) {
                $this->db->or_where_in($key, $value);
            }
        }

        if (isset($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $key => $value) {
                $this->db->where_not_in($key, $value);
            }
        }

        if (isset($params['where_not_in'])) {
            foreach ($params['where_not_in'] as $key => $value) {
                $this->db->where_not_in($key, $value);
            }
        }


        if (isset($params['or_where'])) {
            #loop column 
            $i = 0;
            foreach ($params['or_where'] as $key => $value) {
                #first loop
                if($i===0) {
                    #open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->or_group_start();
                    $this->db->or_where($key, $value);
                } else {
                    $this->db->where($key, $value);
                }

                #last loop
                if(count($params['or_where']) - 1 == $i)
                #close bracket
                $this->db->group_end();
                $i++;
            }
        }

        if (isset($params['where_and_in'])) {
            $this->db->where(isset($params['where_and_in']['where']) ? $params['where_and_in']['where']:array());
            if (isset($params['where_and_in']['where_in'])) {
                foreach ($params['where_and_in']['where_in'] as $key => $value) {
                    $this->db->where_in($key, $value);
                }
            }
        }

        if (isset($params['or_where_and_in'])) {
            $this->db->or_where(isset($params['or_where_and_in']['where']) ? $params['or_where_and_in']['where']:array());
            if (isset($params['or_where_and_in']['where_in'])) {
                foreach ($params['or_where_and_in']['where_in'] as $key => $value) {
                    $this->db->where_in($key, $value);
                }
            }
        }
        return $this->db->get()->num_rows();
    }

    public function get_ordercode(){
        $curmonth = date('m');
        $year = date('y');
        //$branch = $this->session->userdata('KodeAreaCabang');
        $month = get_indo_rmw($curmonth);
        $q = $this->db->query("SELECT MAX(RIGHT(OrderCode,5)) as INV from Course_OrderHeader Where MONTH(CreatedDate)=MONTH(GETDATE())");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->INV)+1;
                $kd = sprintf("%05s", $tmp);
            }
        }else{
            $kd = "00001";
        }
        return "PG/".$month.'/'.$year.'/'.$kd;
    }

}