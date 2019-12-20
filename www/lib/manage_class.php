<?php

require_once "config_class.php";
require_once "user_class.php";
require_once "poll_class.php";
require_once "pollvariant_class.php";

class Manage {
	
	private $config;
	private $user;
	private $data;
	
	public function __construct($db) {
		session_start();
		$this->config = new Config();
		$this->user = new User($db);
		$this->poll = new Poll($db);
		$this->poll_variant = new PollVariant($db);
		$this->data = $this->secureData(array_merge($_POST, $_GET));
	}
	
	private function secureData($data) {
		foreach($data as $key => $value) {
			if (is_array($value)) $this->secureData($value);
			else $data[$key] = htmlspecialchars($value);
		}
		return $data;
	}
	
	public function redirect($link) {
		header("Location: $link");
		exit;
	}
	
	public function regUser() {
		$regLogin = "/[a-z0-9][a-z0-9_-]*[a-z0-9]*/x";
		$regPass = "/[a-z0-9]*/x";
		$regEMail = "/[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";	
		$link_reg = $this->config->address."?view=reg";
		$captcha = $this->data["captcha"];
		if (($_SESSION["rand"] != $captcha) && ($_SESSION["rand"] != "")) {
			return $this->returnMessage("ERROR_CAPTCHA", $link_reg);
		}
		$login = $this->data["login"];
		if (preg_match($regLogin, $login) == 0) return $this->unknownError($link_reg);
		if ($this->user->isExistsUser($login)) return $this->returnMessage("EXISTS_LOGIN", $link_reg);
		$password = $this->data["password"];
		if (preg_match($regPass, $password) == 0) return $this->unknownError($link_reg);
		if ($password == "") return $this->unknownError($link_reg);
		$password = $this->hashPassword($password);
		if (preg_match($regEMail, $email) == 0) return $this->unknownError($link_reg);
		$result = $this->user->addUser($login, $password, time());
		if ($result) return $this->returnPageMessage("SUCCESS_REG", $this->config->address."?view=message");
		else return $this->unknownError($link_reg);
	}
	
	public function login() {
		$login = $this->data["login"];
		$password = $this->data["password"];
		$password = $this->hashPassword($password);
		$r = $_SERVER["HTTP_REFERER"];
		if ($this->user->checkUser($login, $password)) {
			$_SESSION["login"] = $login;
			$_SESSION["password"] = $password;
			return $r;
		}
		else {
			$_SESSION["error_auth"] = 1;
			return $r;
		}
	}
	
	public function logout() {
		unset($_SESSION["login"]);
		unset($_SESSION["password"]);
		return $_SERVER["HTTP_REFERER"];
	}
	
	public function poll() {
		$id = $this->data["variant"];
		$variant = $this->poll_variant->get($id);
		$poll_id = $variant["poll_id"];
		$this->poll_variant->setVotes($id, $variant["votes"] + 1);
		$poll_var = "6e6b6f";
		return $this->config->address."?view=poll&id=$poll_id";
	}
	
	private function hashPassword($password) {
		return md5($password.$this->config->secret);
	}
	
	private function unknownError($r) {
		return $this->returnMessage("UNKNOWN_ERROR", $r);
	}
	
	private function returnMessage($message, $r) {
		$_SESSION["message"] = $message;
		return $r;
	}
	
	private function returnPageMessage($message, $r) {
		$_SESSION["page_message"] = $message;
		return $r;
	}

}

?>