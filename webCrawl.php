<?php

$start = "http://localhost:8080/api/test.html";
$already_crawled = array();
 error_reporting(0);
 $already_crawled=array();
$uniqueExtension = [];

function follow_links($url)
{
    global $already_crawled;

    $option =array('http' => array('method','GET', 'headers' => 'User-Agent: howbot/0.1 \n'));

    $context=stream_context_create($option);
    
    global $already_crawled;
    $doc = new DOMDocument();
    libxml_use_internal_errors(true);   
    $html=$doc->loadHTML(file_get_contents($url));
    $linklist = $doc->getElementsByTagName("a");

    foreach ($linklist as $link) {
        $crawledLinks = $link->getAttribute("href");
        
        if (substr($crawledLinks, 0, 1 == "/") && substr($crawledLinks, 0, 2) != "//") {
            $crawledLinks = parse_url($url)["scheme"] . "://" . parse_url($url)["host"] . $crawledLinks;
        } elseif (substr($crawledLinks, 0, 2) == "//") {
            $crawledLinks = parse_url($url)["scheme"] . ":" . $crawledLinks;
        } elseif (substr($crawledLinks, 0, 2) == "./") {
            $crawledLinks = parse_url($url)["scheme"] . "://" . parse_url($url)["host"] . dirname(parse_url($url)["path"]) . substr($crawledLinks, 1);
        } elseif (substr($crawledLinks, 0, 1) == "#") {
            $crawledLinks = parse_url($url)["scheme"] . "://" . parse_url($url)["host"] . parse_url($url)["path"] . $crawledLinks;
        } elseif (substr($crawledLinks, 0, 3) == "../") {
            $crawledLinks = parse_url($url)["scheme"] . "://" . parse_url($url)["host"] . "/" . $crawledLinks;
        } elseif (substr($crawledLinks, 0, 11) == "javascript:") {
            continue;
        } elseif (substr($crawledLinks, 0, 5) != "https" &&  substr($crawledLinks, 0, 5) != "http") {
            $crawledLinks = parse_url($url)["scheme"] . "://" . parse_url($url)["host"] . "/" . $crawledLinks;
        }
        
        if(!in_array($crawledLinks,$already_crawled)){
            $already_crawled[]=$crawledLinks;
            // echo get_details($crawledLinks);
            echo $crawledLinks .'<br>';
        }   

    }

}
follow_links($start);
print_r($already_crawled);
?>