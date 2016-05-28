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
    
    
    
    
    $content .= '<img id="activity1" class="tag" style="position: absolute; height: 50px; width: 50px; top: 500px; left: 200px;" src="http://www.snafu.org/GeoTag/GeoTagHelp/images/icon128.png" />';
    
    $content .= '<img id="activity2" class="tag" style="position: absolute; height: 50px; width: 50px; top: 100px; left: 400px;" src="http://www.snafu.org/GeoTag/GeoTagHelp/images/icon128.png" />';
    
//<img id="tag2" class="tag" style="position: absolute; height: 50px; width: 50px; top: 0px; left: 0px;" src="http://www.snafu.org/GeoTag/GeoTagHelp/images/icon128.png" alt="" onmouseover = function(){#map.css(background-image: url("https://www.jerusalem.muni.il/Municipality/Directorquarters/PublishingImages/map.jpg"););} />';

    //$content .= '<div id="a"/>';
    
    //add bubble for text
    $content .= '<img id="bubble" class="bubble" style="position: absolute; top: 0px; left: 0px;" src="http://i.stack.imgur.com/nH24x.png" />';

    

    
    
$content .= '</div>';
    
    
    
    
    
$content .= "\n<script>
                function getImageByActivity(activity)
                {
                    if(activity == 'activity1')
                        return 'http://www.jiis.org.il/.upload/publications/images/2007_07_minhalim-map-small.jpg';
                    else if(activity == 'activity2')
                        return 'http://jiis.org/.upload/heb/data_statistics/maps/flat_size/2010_02_flatsize-map.jpg';

                }
                jQuery('.tag').hover(
                function(){
           
                    var activityId = jQuery(this).attr('id');
                    var urlByActivityId = getImageByActivity(activityId);
                    jQuery('#map').css('background-image','url(' + urlByActivityId + ')');
                });
                </script>";
    
    return $content;
}
http://cdn.shopify.com/s/files/1/0245/5665/products/BubbleTextCoaster_05_1024x1024.jpg?v=1439796076


add_shortcode('custom-mapify', 'display');
 



/*
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




document.getElementById("image-activities");
        var rect = div.getBoundingClientRect();

        x_left = rect.left;
        y_top = rect.top;
        w_ = rect.right - rect.left;
        h_ = rect.bottom - rect.top;

        jQuery("#img-marker" + index).css({
            "top": (y/100)*h_-(25),
            "left": (x/100)*w_-(12.5) 
        });
*/
?>