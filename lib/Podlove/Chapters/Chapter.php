<?php 
namespace Podlove\Chapters;

class Chapter {

	private $timestamp;
	private $title;

	public function __construct( $timestamp, $title ) {
		$this->timestamp = $timestamp;
		$this->title = $title;
	}

}