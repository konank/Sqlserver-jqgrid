<?php
    class Jqgrid extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('permodelan');
        }
        
        public function index()
        {
            $this->load->view('jqgrid/index');
        }
        
        public function tampil_data()
        {
            $page  = $this->input->get('page');
            $limit = $this->input->get('rows');
            $sidx  = $this->input->get('sidx');
            $sord  = $this->input->get('sord');
            
            if(!$sidx) $sidx=1;
            
            # Untuk Single Searchingnya #
            $where = ""; //if there is no search request sent by jqgrid, $where should be empty
            $searchField = isset($_GET['searchField']) ? $_GET['searchField'] : false;
            $searchString = isset($_GET['searchString']) ? $_GET['searchString'] : false;
            if ($_GET['_search'] == 'true') {
            $where = array($searchField => $searchString);
            }
            //echo $_GET['_search'];
            # End #
            
            $count = $this->permodelan->count_siswa($where);
            
            //$count > 0 ? $total_pages = ceil($count/$limit) : $total_pages = 0;
            if( $count > 0 ) {
	            $total_pages = ceil($count/$limit);
    	        } else {
	            $total_pages = 0;
    	    }
            if ($page > $total_pages) $page=$total_pages;
            $start = $limit*$page - $limit;
            if($start <0) $start = 0;
            
            $data1 = $this->permodelan->get_siswa($where, $sidx, $sord, $limit, $start);
            
            $responce->page = $page;
            $responce->total = $total_pages;
            $responce->records = $count;
    		$i=0;
    		foreach($data1->result() as $row) {
    		    $data->rows[$i]['id']=$row->id;
                if($row->status == 0){
                    $stats = "Not active";
                } else {
                    $stats = "Active";
                }
    		    $data->rows[$i]['cell']=
                array($i+1,$row->namasiswa,$row->alamat,$row->kelas,$stats,$row->id);

    		    $i++;
    		}
    		echo json_encode($data);
        }
        
        public function crud()
        {
            $pos = $this->input->post('oper');
            $id = $this->security->xss_clean(strip_tags($this->input->post('id')));
            $namasiswa = $this->security->xss_clean(strip_tags($this->input->post('namasiswa'))); //namanya sesuai nama tabel
            $alamat = $this->security->xss_clean(strip_tags($this->input->post('alamat')));
            $kelas = $this->security->xss_clean(strip_tags($this->input->post('kelas')));
            $status = $this->security->xss_clean(strip_tags($this->input->post('status')));
            
            //tangkep $pos untuk add,edit,delete
            if($pos == "add"){
                $add = array(
                    
                    'namasiswa'=>$namasiswa,
                    'alamat'=>$alamat,
                    'kelas'=>$kelas,
                    'status'=>$status
                );
                $this->db->insert('siswa',$add);
            } elseif($pos == "edit"){
                $edits = array(
                    'namasiswa'=>$namasiswa,
                    'alamat'=>$alamat,
                    'kelas'=>$kelas,
                    'status'=>$status
                );
                $this->db->where('id',$id);
                $this->db->update('siswa',$edits);
                
            } elseif($pos == "del"){
                //$imp = implode(',',$id);
                $q = "DELETE FROM siswa WHERE id IN ($id)";
                $this->db->query($q);
            }
        }
        
        public function csv()
        {
            
            $export = $_POST['csvBuffer'];
            echo $export;
            header('Content-type: application/vnd.ms-excel');
            header("Content-Disposition: attachment; filename=hasil_export.xls");
            header("Pragma: no-cache");  

        }
    }
?>