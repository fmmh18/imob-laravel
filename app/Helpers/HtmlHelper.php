<?php

if (!function_exists('limitHtmlString')) {
    function limitHtmlString($html, $limit = 120)
    {
        $dom = new \DOMDocument();
        // Suprimir erros de HTML malformado
        @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));

        $currentLength = 0;
        $truncatedHtml = '';

        foreach ($dom->getElementsByTagName('body')->item(0)->childNodes as $node) {
            if ($currentLength >= $limit) {
                break;
            }

            $nodeHtml = $dom->saveHTML($node);
            $nodeLength = mb_strlen(strip_tags($nodeHtml));

            if ($currentLength + $nodeLength > $limit) {
                $remainingLength = $limit - $currentLength;
                $truncatedHtml .= truncateNodeHtml($nodeHtml, $remainingLength);
                $currentLength = $limit;
            } else {
                $truncatedHtml .= $nodeHtml;
                $currentLength += $nodeLength;
            }
        }

        return $truncatedHtml;
    }
}

if (!function_exists('truncateNodeHtml')) {
    function truncateNodeHtml($nodeHtml, $limit)
    {
        $dom = new \DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($nodeHtml, 'HTML-ENTITIES', 'UTF-8'));

        $currentLength = 0;
        $truncatedHtml = '';

        foreach ($dom->getElementsByTagName('body')->item(0)->childNodes as $node) {
            if ($currentLength >= $limit) {
                break;
            }

            $textContent = $node->textContent;
            $nodeLength = mb_strlen($textContent);

            if ($currentLength + $nodeLength > $limit) {
                $remainingLength = $limit - $currentLength;
                $truncatedText = mb_substr($textContent, 0, $remainingLength);
                $node->nodeValue = $truncatedText;
                $truncatedHtml .= $dom->saveHTML($node);
                $currentLength = $limit;
            } else {
                $truncatedHtml .= $dom->saveHTML($node);
                $currentLength += $nodeLength;
            }
        }

        return $truncatedHtml;
    }
}
