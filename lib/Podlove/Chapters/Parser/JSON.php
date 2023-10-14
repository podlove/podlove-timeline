<?php

namespace Podlove\Chapters\Parser;

use Podlove\Chapters\Chapter;
use Podlove\Chapters\Chapters;
use Podlove\NormalPlayTime;

class JSON
{
    public static function parse($chapters_string)
    {
        // remove UTF8 BOM if it exists
        $chapters_string = str_replace("\xef\xbb\xbf", '', $chapters_string);

        $chapters = new Chapters();

        $json = json_decode(trim($chapters_string));

        if (!$json) {
            return $chapters;
        }

        foreach ($json as $chapter) {
            $chapters->addChapter(
                new Chapter(
                    NormalPlayTime\Parser::parse($chapter->start),
                    $chapter->title,
                    $chapter->href,
                    $chapter->image
                )
            );
        }

        return $chapters;
    }
}
