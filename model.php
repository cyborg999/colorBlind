<?php
error_reporting(E_ALL);
// error_reporting(0);

include_once "helper.php";



session_start();

class Model {
	protected $db;
	public $errors = array();
	public $messages = array();

	public function __construct(){
		include_once "config.php";

		$this->db = $db;
		$this->ishiharaListener();
	}	

	public function getSettings(){
		return $this->db->query("
				SELECT *
				FROM admin
				LIMIT 1
			")->fetch(PDO::FETCH_ASSOC);
	}


	public function addIshihara($file){
		$this->db->prepare("
				INSERT INTO ishihara(img)
				VALUES(?)
			")->execute(array($file));

		return $this->db->lastInsertedId();		
	}

	public function ishiharaListener(){
		if(isset($_FILES['files'])){
			// opd($_FILES);
			$_SESSION['id'] = 1;

			$path = "uploads/".$_SESSION['id'];
			$ext = ".".pathinfo($_FILES['files']['name'][0], PATHINFO_EXTENSION);
			$filename = md5($_FILES['files']['name'][0]).$ext;

			if (!file_exists($path)) {
			    mkdir($path, 0777, true);
			}
			if(move_uploaded_file($_FILES['files']['tmp_name'][0], $path."/".$filename)){
				// $id = $this->addIshihara($path."/".$filename);

				// opd($id);
				$data = array();
				$info = array();
				$info['name'] = $_FILES['files']['name'][0];
				$info['type'] = $_FILES['files']['type'][0];
				$info['thumbnailUrl'] = $path."/".$filename;
				$info['url'] = $path."/".$filename;
				$info['size'] = $_FILES['files']['size'][0];
				$info['deleteType'] = "DELETE";
				$info['deleteUrl'] = "todo.php";

				//files
				$data['files'][] = $info;
				die(json_encode($data));
			}
			else {
				die(json_encode(array('failed')));
			}
		}
	}

}