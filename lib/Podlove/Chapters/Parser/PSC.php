<?php

namespace Podlove\Chapters\Parser;

use Podlove\Chapters\Chapter;
use Podlove\Chapters\Chapters;
use Podlove\NormalPlayTime;

class PSC
{
    public static function parse($chapters_string)
    {
        if (!is_string($chapters_string)) {
            return null;
        }

        // remove UTF8 BOM if it exists
        $chapters_string = str_replace("\xef\xbb\xbf", '', $chapters_string);

        if (!is_string($chapters_string)) {
            return null;
        }

        if (!$chapters_string = trim($chapters_string)) {
            return null;
        }

        if (!$xml = self::get_simplexml($chapters_string)) {
            return null;
        }

        $xml->registerXPathNamespace('psc', 'http://podlove.org/simple-chapters');

        if (!$chapters_xpath = $xml->xpath('//psc:chapter')) {
            return null;
        }

        $chapters = new Chapters();
        foreach ($chapters_xpath as $chapter) {
            $simplexml_attributes = (array) $chapter->attributes();
            $attributes = $simplexml_attributes['@attributes'];

            $chapters->addChapter(
                new Chapter(
                    NormalPlayTime\Parser::parse($attributes['start']),
                    isset($attributes['title']) ? $attributes['title'] : '',
                    isset($attributes['href']) ? $attributes['href'] : '',
                    isset($attributes['image']) ? $attributes['image'] : ''
                )
            );
        }

        return $chapters;
    }

    private static function get_simplexml($string)
    {
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->strictErrorChecking = false;
        $dom->validateOnParse = false;

        if (!$dom->loadXML($string)) {
            return false;
        }

        $xml = simplexml_import_dom($dom);
        libxml_clear_errors();
        libxml_use_internal_errors(false);

        return $xml;
    }
}
