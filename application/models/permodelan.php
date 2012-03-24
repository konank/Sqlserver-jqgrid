<?php
    class Permodelan extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }
        
        public function insert_data($cat)
        {
            $data = array('id'=>'','category'=>$cat);
            $this->db->insert('category',$data);
        }
        
        
        function count_siswa($like) {
    	   $like != '' ? $this->db->like($like) : '';
    	   return $this->db->count_all('siswa');
    	}
        
        function get_siswa($like, $sidx, $sord, $limit, $start) {
    	$like != '' ? $this->db->like($like) : '';
    	$this->db->order_by($sidx, $sord);
    	return $this->db->get('siswa', $limit, $start);
    	}
    }
?>