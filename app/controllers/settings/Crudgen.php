<?php require APPPATH.'libraries/Crystal.php';

class Crudgen extends Crystal {

	function __construct() {
		parent::__construct();
	}

	public function index() {
        template(
            title: 'CRUD Generator v0.1',
            content: 'settings/crudgen/index',
            plugin: ['datatables'],
            data : [
                'db' => $this->db->database,
                'tables' => $this->db->get_where('INFORMATION_SCHEMA.TABLES',['TABLE_SCHEMA' => $this->db->database])->result_array(),
                'fields' => $this->db->get_where('INFORMATION_SCHEMA.`COLUMNS`', ['TABLE_SCHEMA' => $this->db->database, 'TABLE_NAME'=>$this->input->get('table')])->result_array()
            ]
        );
	}
    
    function ajx_generate(){
        $data = $this->input->post();
        $list = [
            'name' => [],
            'label' => [],
            'validation' => [],
            'element' => [],
            'table' => $this->input->post('table'),
            'path' => '',
        ];
        foreach($data as $key => $val){
            $key = explode('|',$key);
            if(count($key)>0){
                if($key[0]=='name'){
                    array_push($list['name'],$val);
                }
                if($key[0]=='label'){
                    array_push($list['label'],$val);
                }
                if($key[0]=='validation'){
                    array_push($list['validation'],$val);
                }
                if($key[0]=='element'){
                    array_push($list['element'],$val);
                }
            }
        }
        $this->writeTo(
            APPPATH . "controllers/" . ucwords($this->input->post('table')) . '.php',
            utf8_encode($this->load->view('settings/crudgen/template_controller', $list, TRUE))
        );
    }


	public function writeTo($path, $code) {
		if (file_exists($path)) {
			echo "File sudah ada sebelumnya";
		} else {
			if (!file_exists(dirname($path))) {
				mkdir(dirname($path), 0755, true);
			}
			$myfile = fopen($path, "w") or die("Unable to open file!");
			fwrite($myfile, html_entity_decode($code));
            chmod($path, "775");
			fclose($myfile);
			echo "File berhasil dibuat";
		};

	}

}