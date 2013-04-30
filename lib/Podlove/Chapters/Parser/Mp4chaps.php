<?php 
namespace Podlove\Chapters\Parser;
use \Podlove\Chapters\Chapters;
use \Podlove\Chapters\Chapter;
use \Podlove\NormalPlayTime;

class Mp4chaps {

	public function parse( $chapters_string ) {

		$chapters_string = trim( $chapters_string );

		if ( ! strlen( $chapters_string ) )
			return NULL;

		$chapters = new Chapters();

		foreach( preg_split( "/((\r?\n)|(\r\n?))/", $chapters_string ) as $line ) {
		    $valid = preg_match( '/^((?:\d+\:[0-5]\d\:[0-5]\d(?:\.\d+)?)|\d+(?:\.\d+)?)(.*)$/', trim( $line ), $matches );

		    if ( ! $valid ) continue;

		    $time_string = trim( $matches[1] );
			$title = trim( $matches[2] );

			$link = '';
			$title = preg_replace_callback( '/\s?<[^>]+>\s?/' , function ( $matches ) use ( &$link ) {
				$link = trim( $matches[0], ' < >' );
				return ' ';
			}, $title );

			$chapters->addChapter( new Chapter( NormalPlayTime\Parser::parse( $time_string ), $title ) );
		} 

		return $chapters;
	}

}