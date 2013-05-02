<?php 
namespace Podlove\Chapters;

class Chapter {

	private $timestamp;
	private $title;
	private $link;

	public function __construct( $timestamp, $title, $link = '' ) {
		$this->timestamp = $timestamp;
		$this->title = $title;
		$this->link = $link;
	}

}