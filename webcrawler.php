<?php
// $start = "https://www.skytravel.com.pk/";
// $start = "https://www.momondo.com/flight-search/MUX-LHE/2023-01-11/2023-01-18";
$start = "https://www.skyscanner.net/";
 error_reporting(0);
//  $already_crawled=array();
$uniqueExtension = [];
function follow_links($url)
{
    // global $already_crawled;
    $doc = new DOMDocument();
    // libxml_use_internal_errors(true);   
    $html=$doc->loadHTML(file_get_contents($url));
        var_dump($html);
        // echo 'hello';
    $linklist = $doc->getElementsByTagName("a");
    // echo $linklist;

    foreach ($linklist as $link) {
        // echo $linklist;
        // echo $link->getAttribute("href")."<br>";
        $crawledLinks = $link->getAttribute("href");
        var_dump($crawledLinks);
        
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
        //  $urlArray[]=$crawledLinks;
        $crawledLinksHost = parse_url($crawledLinks)['host'];
        $extensionHost = pathinfo($crawledLinksHost, PATHINFO_EXTENSION);
        $crawledLinkspath = parse_url($crawledLinks)['path'];
        $extensionPath = pathinfo($crawledLinkspath, PATHINFO_EXTENSION);
        if(!empty($extensionPath)){
            $uniqueExtension[] = $extensionPath;
        }
        $uniqueExtension[] = $extensionHost;

        echo $crawledLinks .'<br>';

    }

     $uniqueExtension = array_unique($uniqueExtension);
     foreach($uniqueExtension as $uniqueExt)
     {
        if(!empty($uniqueExt))
        echo $uniqueExt .'<br>';
    }
    print_r($uniqueExtension);
}
follow_links($start);


// print_r($already_crawled);
?>