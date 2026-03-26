<?php
class student {

	// private variables
	private $id = '';
	private $fname = '';
	private $lname = '';
	private $grade = array();

	// constructor
	function __construct($id, $fname, $lname, $grade) {
		$this->setID($id);
		$this->setFname($fname);
		$this->setLname($lname);
		$this->setGrade($grade);
	}

	// setters
	public function setID($i) {
		$this->id = $i;
	}

	public function setFname($f) {
		$this->fname = $f;
	}

	public function setLname($l) {
		$this->lname = $l;
	}

	public function setGrade($g) {
		$this->grade = $g;
	}

	// getterss
	public function getID() {
		return $this->id;
	}

	public function getFname() {
		return $this->fname;
	}

	public function getLname() {
		return $this->lname;
	}

	public function getGrade() {
		return $this->grade;
	}
}
?>
