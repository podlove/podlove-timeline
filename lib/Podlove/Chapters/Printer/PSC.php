<?php 
namespace Podlove\Chapters\Printer;

class PSC implements Printer {

	public function do_print( \Podlove\Chapters\Chapters $chapters ) {
		return '<psc:chapters version="1.2" xmlns:psc="http://podlove.org/simple-chapters">' . "\n"
		     . array_reduce( $chapters->toArray(), function ( $result, $chapter ) {
					return $result . sprintf(
						"\t" . '<psc:chapter start="%s" title="%s"%s%s/>' . "\n",
						$chapter->get_time(),
						$chapter->get_title(),
						$chapter->get_link()  ? sprintf( ' href="%s"', $chapter->get_link() ) : '',
						$chapter->get_image() ? sprintf( ' image="%s"', $chapter->get_image() ) : ''
					);
				}, '' )
		     . '</psc:chapters>';
	}

}