<?php 
namespace Podlove\Chapters;

class Chapters {

	private $chapters = array();

	public function addChapter( $chapter ) {
		$this->chapters[] = $chapter;
	}

}