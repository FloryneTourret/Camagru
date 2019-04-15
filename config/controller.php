<?php

class Controller
{
	private $_vars = array();
	private $_params = 0;
    public function __construct()
    {
		session_start();
		if (!isset($_SESSION['token'])) {
			$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(6));
		}
    }
    function set($data)
    {
        $this->_vars = array_merge($this->_vars, $data);
    }
    function render($filename)
    {
        extract($this->_vars);
        require(ROOT . 'views/' . $filename . '.php');
    }
    function loadView($filename, $data = NULL)
    {
        if (isset($data))
            $this->set($data);
        $this->render($filename);
    }
    function loadModel($name)
    {
        require_once(ROOT . 'Models/' . strtolower($name) . '.php');
        $this->$name = new $name();
	}
	
	function set_params($get_params)
	{
		$this->_params = $get_params;
	}
}