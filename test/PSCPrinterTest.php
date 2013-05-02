<?php
use \Podlove\Chapters\Parser;
use \Podlove\Chapters\Printer;
use \Podlove\Chapters\Chapters;
use \Podlove\Chapters\Chapter;

class PSCPrinterTest extends PHPUnit_Framework_TestCase {

	public function testPrinter() {
		$expected_print = trim('
<psc:chapters version="1.2" xmlns:psc="http://podlove.org/simple-chapters">
	<psc:chapter start="00:00:01.234" title="Intro" href="http://example.com"/>
	<psc:chapter start="00:12:34.000" title="About us"/>
	<psc:chapter start="01:02:03.000" title="Later" image="http://example.com/foo.jpg"/>
	<psc:chapter start="01:02:03.001" title="Even Later" href="http://example.com" image="http://example.com/foo.jpg"/>
</psc:chapters>');

	    $chapters = new Chapters();
	    $chapters->addChapter( new Chapter( 1234, 'Intro', 'http://example.com' ) );
	    $chapters->addChapter( new Chapter( 754000, 'About us' ) );
	    $chapters->addChapter( new Chapter( 3723000, 'Later', '', 'http://example.com/foo.jpg' ) );
	    $chapters->addChapter( new Chapter( 3723001, 'Even Later', 'http://example.com', 'http://example.com/foo.jpg' ) );
	    $chapters->setPrinter( new Printer\PSC() );

	    $this->assertEquals( $expected_print, (string) $chapters );
	}

}