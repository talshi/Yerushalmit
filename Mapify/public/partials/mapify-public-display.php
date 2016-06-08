<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/public/partials
 */


require_once dirname ( __DIR__ ) . '/../DB/DB_functions.php';

function display($atts) 
{
    $content = '';      //the content of the plugin page.
    
    $content .= '<div id="mapify">';
    
    $content .= '<div id="categories">';
    
    $categoriesArray = json_decode(DB_functions::get_category_list());
    foreach($categoriesArray as $category)
    {
        $content .= '<img id="category_'. $category->id .'" class="categories" src="'. $category->logoUrl .'"></img>';
    }
    
    $content .= '</div>';       //close categories div 
    
    //get main map from DB
    $arrayMainMapUrl = json_decode(DB_functions::get_main_map_url());
    $mainMapUrl = $arrayMainMapUrl[0]->url;

    $content .= '<div id="map" style="background-image: url(\'' . $mainMapUrl . '\');">';      //the map div - show the plugin
    
    //show activities on the map
    $activitiesArray = json_decode(DB_functions::get_category_list());
    $tagImage = "http://www.snafu.org/GeoTag/GeoTagHelp/images/icon128.png";    //the image of the tags
    foreach($activitiesArray as $activity)
    {
        $content .= '<img id="activity_'. $activity->id .'" class="tag" src= '. $tagImage .' />';   
    }

    
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
                        
                    
                    var link = '<br/><br/><a class=\"link\" id=aaa href=\"#contentActivityRef\"  onClick=onClickReadMore() style=\"cursor: pointer; border-bottom: none;\">קרא עוד></a>';
                    
                    var linkId = activityId;
                    jQuery('.link').attr('id');
                    jQuery('#textTitle').text(title);
                    jQuery('#bubbleText').text(textForBubble);
                    jQuery('#bubbleText').append(link);
                });
                jQuery('.categories').hover(
                function(){
           
                    var categoryId = jQuery(this).attr('id');
                    
                    var textForBubble = '';
                    if(categoryId == 'category1')
                        textForBubble += ' טקסט מתחלף קטגוריה 1  טקסט מתחלף קטגוריה 1  טקסט מתחלף קטגוריה 1  טקסט מתחלף קטגוריה 1 טקסט מתחלף קטגוריה 1 ';
                    else if(categoryId == 'category2')
                        textForBubble += ' טקסט מתחלף קטגוריה 2 טקסט מתחלף קטגוריה 2 טקסט מתחלף קטגוריה 2 טקסט מתחלף קטגוריה 2 טקסט מתחלף קטגוריה 2 ';
                                            
                    var title;
                    if(categoryId == 'category1')
                        title = 'כותרת קטגוריה 1';
                    else if(categoryId == 'category2')
                        title = 'כותרת קטגוריה 2';
                        
                    
                    jQuery('#textTitle').text(title);
                    jQuery('#bubbleText').text(textForBubble);
                });
                function onClickReadMore()
                {
                    var activityId = (jQuery('.link').attr('id'));
                    console.log(activityId);
                    //if(activityId == 'activity1')
                        contentText = 'תוכן משתנה פעילות תוכן משתנה פעילות תוכן משתנה פעילות תוכן משתנה פעילות ';
                    //else if(activityId == 'activity2')
                        //contentText = 'תוכן משתנה פעילות 2 תוכן משתנה פעילות 2 תוכן משתנה פעילות 2 תוכן משתנה פעילות 2 תוכן משתנה פעילות 2 תוכן משתנה פעילות 2';
                    jQuery('#contentActivityText').text(contentText);
                }
                </script>";
    
    return $content;
}


add_shortcode('wp-mapify', 'display');


?>
