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
class PIJSONParserTest extends TestCase
{
    public function testValidSingleChapter()
    {
        $chapters = new Chapters();
        $chapters->addChapter(new Chapter(3450, "Intro"));
        $chapters->setPrinter(new Printer\PodcastIndexJSON());
        $chapters_string = (string) $chapters;
        $chapters->setPrinter(new Printer\Nullprinter());

        $this->assertEquals(
            $chapters,
            Parser\PodcastIndexJSON::parse($chapters_string),
        );
    }

    public function testMultipleChapter()
    {
        $chapters = new Chapters();
        $chapters->addChapter(new Chapter(3450, "Intro"));
        $chapters->addChapter(
            new Chapter(
                13450,
                "Later",
                "http://example.com",
                "http://example.com/foo.jpg",
            ),
        );
        $chapters->setPrinter(new Printer\PodcastIndexJSON());
        $chapters_string = (string) $chapters;
        $chapters->setPrinter(new Printer\Nullprinter());

        $this->assertEquals(
            $chapters,
            Parser\PodcastIndexJSON::parse($chapters_string),
        );
    }
}
