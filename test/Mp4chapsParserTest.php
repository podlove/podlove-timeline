<?php
use \Podlove\Chapters\Parser\Mp4chaps;
use \Podlove\Chapters\Chapters;
use \Podlove\Chapters\Chapter;

class Mp4chapsParserTest extends PHPUnit_Framework_TestCase {

    public function testEmptyStringReturnsNull() {
        $parser = new Mp4chaps();
        $result = $parser->parse("");
        $this->assertNull( $result );
    }

    public function testValidSingleLine() {
        $parser = new Mp4chaps();
        $result = $parser->parse("3.45 Intro");

        $chapters = new Chapters();
        $chapters->addChapter(
            new Chapter( 3450, 'Intro' )
        );

        $this->assertEquals( $chapters, $result );
    }

}
