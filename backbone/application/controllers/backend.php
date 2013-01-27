<?php  
require APPPATH.'/libraries/REST_Controller.php';
class backend extends REST_Controller {  

    public function __construct() {
        parent::__construct();
	$this->load->model('urls_model');
    }
    
    public function tag_get() {
	if(!$this->get('tag'))  
        {  
            $this->response(NULL, 400);  
        }
	//echo $this->get('tag');

        $urls = $this->urls_model->get_urls( $this->get('tag') );  
        if($urls)  
        {  
            $this->response($urls, 200); // 200 being the HTTP response code  
        }  
        else  
        {  
            $this->response(NULL, 404);  
        }
    }

    public function tag_post() {

	$data = json_decode(file_get_contents('php://input'));

	$result = $this->urls_model->update_url($data->urlsource , $data->tag);  
	
        if($result === FALSE)  
        {  
            $this->response(array('status' => 'failed'));  
        }  
        else  
        {  
            $this->response(array('status' => 'success'));  
        } 
    }
}  