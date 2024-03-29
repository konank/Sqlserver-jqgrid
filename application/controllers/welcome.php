<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('permodelan');
        $this->load->helper('security');
        
    }
	public function index()
	{
		$this->load->view('welcome_message');
	}
    
    public function insert()
    {
        $cat = $this->security->xss_clean(strip_image_tags($this->input->post('category')));
        if(empty($cat)){
            echo "category tidak boleh kosong";
        } else {
            $this->permodelan->insert_data($cat);
            $output	= array(
					'id' 		=> $this->db->insert_id(),
					'category'	=> $cat);
	        echo json_encode($output);
        }
    }
    
    public function data()
    {
        echo "test";
    }
    
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */