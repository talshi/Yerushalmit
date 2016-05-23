<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Mapify
 * @subpackage Mapify/public/partials
 */


function display($atts) 
{
    $content = '';
    $content .= '<div id="map">';      //the map div - show the plugin
    
  //  $content .= '<img id="image1" style="width: 100%; position: relative;" src="' . getImgURL() . '"/>';
    
    
    
    
    $content .= '<img id="tag1" class="tag" style="position: absolute; height: 50px; width: 50px; top: 20px; left: 200px;" src="http://www.snafu.org/GeoTag/GeoTagHelp/images/icon128.png" />';
    
//<img id="tag2" class="tag" style="position: absolute; height: 50px; width: 50px; top: 0px; left: 0px;" src="http://www.snafu.org/GeoTag/GeoTagHelp/images/icon128.png" alt="" onmouseover = function(){#map.css(background-image: url("https://www.jerusalem.muni.il/Municipality/Directorquarters/PublishingImages/map.jpg"););} />';

    //$content .= '<div id="a"/>';
    
    
    $content .= '</div>';
    
    $content .= "\n<script>
        jQuery('#tag1').hover(
        function(){
        jQuery('#map').css('background-image', " . 
        "'url(" . '"http://www.jiis.org.il/.upload/publications/images/2007_07_minhalim-map-small.jpg"' . ")');
        });
    </script>";

    return $content;
}



add_shortcode('custom-mapify', 'display');
 




function getImgURL()    //for example
{
    return "http://static.guim.co.uk/sys-images/Guardian/Pix/maps_and_graphs/2010/5/20/1274374118960/Graphic-map---museum-of-m-001.jpg";
}

function changeForMap1()
{
    echo "<script>
        $('#tag1').hover(
        $('#map').css('background-image', 'url('http://www.jiis.org.il/.upload/publications/images/2007_07_minhalim-map-small.jpg')'));
    </script>";
   // .map.css(background-image: url("http://www.jiis.org.il/.upload/publications/images/2007_07_minhalim-map-small.jpg"););
}

function changeForMap2()
{
    
}

?>


