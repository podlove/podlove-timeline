<?php

use PHPUnit\Framework\TestCase;
use Podlove\Chapters\Chapter;
use Podlove\Chapters\Chapters;
use Podlove\Chapters\Parser;
use Podlove\Chapters\Printer;

/**
 * @internal
 *
 * @coversNothing
 */
class PSCParserTest extends TestCase
{
    public function testValidSingleChapter()
    {
        $chapters = new Chapters();
        $chapters->addChapter(new Chapter(3450, 'Intro'));
        $chapters->setPrinter(new Printer\PSC());
        $chapters_string = (string) $chapters;
        $chapters->setPrinter(new Printer\Nullprinter());

        $this->assertEquals($chapters, Parser\PSC::parse($chapters_string));
    }

    public function testMultipleChapter()
    {
        $chapters = new Chapters();
        $chapters->addChapter(new Chapter(3450, 'Intro'));
        $chapters->addChapter(new Chapter(13450, 'Later', 'http://example.com', 'http://example.com/foo.jpg'));
        $chapters->setPrinter(new Printer\PSC());
        $chapters_string = (string) $chapters;
        $chapters->setPrinter(new Printer\Nullprinter());

        $this->assertEquals($chapters, Parser\PSC::parse($chapters_string));
    }

    public function testRealXMLString()
    {
        $chapters_string = '<?xml version="1.0" encoding="utf-8"?>
<psc:chapters version="1.2" xmlns:psc="http://podlove.org/simple-chapters">
    <psc:chapter start="00:00:00.000" title="Intro" />
    <psc:chapter start="00:06:26.000" title="Adios" />
</psc:chapters>';

        $chapters = Parser\PSC::parse($chapters_string);

        $this->assertEquals(2, count($chapters->toArray()));
        $this->assertIsString($chapters[0]->get_title());
        $this->assertEquals('Intro', $chapters[0]->get_title());
        $this->assertEquals('Adios', $chapters[1]->get_title());
    }

    public function testInvalidXML()
    {
        $this->assertEquals(null, Parser\PSC::parse('<heydo>invalid xml'));
        $this->assertEquals(null, Parser\PSC::parse('more invalid stuff'));
        $this->assertEquals(null, Parser\PSC::parse(null));
        $this->assertEquals(null, Parser\PSC::parse([1, 2, 3]));
    }
}
