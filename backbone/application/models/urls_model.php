<?php
class urls_model extends CI_Model {

        public function __construct()
        {
                $this->load->database();
        }
	public function get_urls($tag)
	{	    
	    $this->db->select('url');
	    $this->db->from('urls');
	    $this->db->join('tags','urls.id=tags.id');
	    $this->db->where('tag',$tag);
	    $query = $this->db->get();
	    return $query->result_array();
	}
	public function update_url($urlsource , $tag)
	{
				
		$data = array('url' => $urlsource );
				
		$query = $this->db->insert('urls', $data);
		
		$this->db->select_max('id');
		$query=$this->db->get('urls');
		$id=$query->row()->id;
		
		$tagsplit = explode("," , $tag);
		foreach ($tagsplit as $value) {
		  $data = array('id'=>$id , 'tag' => trim($value) );
		  $this->db->insert('tags' , $data);
		}
		
		return true;
	}
}