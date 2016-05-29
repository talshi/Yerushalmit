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
    
    $content .= '<div id="mapify">';
    
    
    $content .= '<div id="map">';      //the map div - show the plugin
    
  //  $content .= '<img id="image1" style="width: 100%; position: relative;" src="' . getImgURL() . '"/>';
    
    
    
    
    $content .= '<img id="activity1" class="tag" style="position: absolute; height: 50px; width: 50px; top: 500px; left: 200px;" src="http://www.snafu.org/GeoTag/GeoTagHelp/images/icon128.png" />';
    
    $content .= '<img id="activity2" class="tag" style="position: absolute; height: 50px; width: 50px; top: 100px; left: 400px;" src="http://www.snafu.org/GeoTag/GeoTagHelp/images/icon128.png" />';
    
    
    //add bubble for text
    $content .= '<div id = "bubble" style="float: left;">';
    //$content .= '<img id="bubbleImg" class="bubble" src="http://i.stack.imgur.com/nH24x.png" />';
    $content .= '<h6 id="textTitle"></h6>';
    $content .= '<p id="bubbleText"></p>';
    $content .= '</div>';
    

    
    
    $content .= '</div>';   //div with id="map"
    
    $content .= '<div id="contentActivity">
                <a name = "contentActivityRef"></a>
                <p id="contentActivityText"></p>';
    
    
    $content .= '</div>';   //div with id="contentActivity"

    
    $content .= '</div>';   //div with id="mapify"
    
    
    
    $content .= "\n<script>
                //console.log(jQuery('#bubbleImg').height());
                //jQuery('#bubble').css({'height': jQuery('#bubbleImg').height(), 'width': jQuery('#bubbleImg').width() });
                jQuery('#bubbleText').css({ 'width': jQuery('#bubble').width() });
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
                    
                    var textForBubble = '';
                    if(activityId == 'activity1')
                        textForBubble += ' טקסט מתחלף פעילות 1  טקסט מתחלף פעילות 1  טקסט מתחלף פעילות 1  טקסט מתחלף פעילות 1 טקסט מתחלף פעילות 1 ';
                    else if(activityId == 'activity2')
                        textForBubble += ' טקסט מתחלף פעילות 2 טקסט מתחלף פעילות 2 טקסט מתחלף פעילות 2 טקסט מתחלף פעילות 2 טקסט מתחלף פעילות 2 ';
                                            
                    var title;
                    if(activityId == 'activity1')
                        title = 'כותרת פעילות 1';
                    else if(activityId == 'activity2')
                        title = 'כותרת פעילות 2';
                        
                    var link = '<br/><br/><a id=\"readMoreLink\" href=\"#contentActivityRef\"  onClick=onClickReadMore()>קרא עוד></a>';
                    
                    jQuery('#textTitle').text(title);
                    jQuery('#bubbleText').text(textForBubble);
                    jQuery('#bubbleText').append(link);
                });
                
                function onClickReadMore()
                {
                console.log(\"aluma\");
                    jQuery(\"#contentActivityText\").text(\"תוכן פעילות מתחלף תוכן פעילות מתחלף תוכן פעילות מתחלף תוכן פעילות מתחלף תוכן פעילות מתחלף תוכן פעילות מתחלף תוכן פעילות מתחלף \");
                }
                </script>";
    
    return $content;
}


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