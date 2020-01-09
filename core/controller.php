<?php 
class Controller {
    public $input;
	public $files;
	var $vars = array();

	public function __construct() {
		// Si le controlleur reçois un $_POST
		if (isset($_POST)) {
			// Affectation de $_POST à l'attribut $input
			$this->input = $_POST;
		}
		if (isset($_FILES)) {
			$this->files = $_FILES;
		}
	}

	function loadDao($name) {
		require_once('dao/'.$name.'.dao.php');
		$daoClass = 'Dao'.$name;
		$this->$daoClass = new $daoClass();
	}

	function set($d) {
		$this->vars = array_merge($this->vars, $d);
	}

	function render($controller, $viewFile,$param = null) {
		extract($this->vars);
		//démarrage de la méthode tempon
		ob_start();
		require_once('vue/'.$controller.'/'.$viewFile.'.php');
		// vide la mémoire tempon et affecte le contenue dans $content
		$content = ob_get_clean();
		echo $content;
		$this->saveUrl($controller,$viewFile,$param);
	}

	function saveUrl($ctrl,$vue,$param = null) {
		$_SESSION['url'] = $ctrl.'/'.$vue.'/'.$param;
	}

	function info($title,$description) {
		// change les infos dans le json
		$info = json_encode(array(
	 		"title" => $title,
	 		"description" => $description
	 	));
	 	file_put_contents(ROOT.'js/info.json', $info);
	}
}


 ?>