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
    $activitiesArray = json_decode(DB_functions::get_activity_list());
    $tagImage = "http://www.snafu.org/GeoTag/GeoTagHelp/images/icon128.png";    //the image of the tags
    
    foreach($activitiesArray as $activity)
    {
        if(strcmp($activity->showOnMap, 'false') == 0)
            continue;
        $content .= '<img id="activity_'. $activity->id .'" class="tag" src= '. $tagImage .' />'; 
        $content .= '<script>
                        jQuery("#activity_'. $activity->id .'").hide();
                        var divMap = document.getElementById("map");
                        var rect = divMap.getBoundingClientRect();

                        var x_left = rect.left;
                        var y_top = rect.top;
                        var w_ = rect.right - rect.left;
                        var h_ = rect.bottom - rect.top;
                        
                        var x = '. intval($activity->locationX) .';
                        var y = '. intval($activity->locationY) .';

                        var x_finish;
                        var y_finish;
                        if( (y/100)*h_ < jQuery(".tag").css("height") )  // keep the marker in map from top
                            y_finish = ((100)*(25))/(h_);			
                        else
                            y_finish = (y / 100) * h_ - (25);		

                        if( (x/100)*w_ < jQuery(".tag").css("width") )  // keep the marker in map from left
                        {	
                            x_finish = ((100)*(12.5))/(w_);
                        }
                        else if ((w_ - (x*w_)/100 < 12.5)) // keep the marker in map from right!!
                        {					
                            x_finish = w_ - 25;
                        }	
                        else{
                            x_finish = (x / 100) * w_  - 12.5;
                        }
                        jQuery("#activity_'. $activity->id .'").css({top: y_finish, left: x_finish});
                        jQuery("#activity_'. $activity->id .'").show();
                    </script>';
    }

    $content .= '<div id="categoryLogo"></div>';
    
    //add bubble for text
    $content .= '<div id = "bubble">';
    $content .= '<h6 id="textTitle"></h6>';
    $content .= '<p id="bubbleText"></p>';
    $content .= '</div>';
    

    
    
    $content .= '</div>';   //close div with id="map"
    
    $content .= '<div id="contentActivity">
                <a name = "contentActivityRef"></a>
                <p id="contentActivityText"></p>
                <div id="activityImages"></div>';
    
    
    $content .= '</div>';   //close div with id="contentActivity"

    
    $content .= '</div>';   //close div with id="mapify"
    
    
    
    $content .= "\n<script>
                jQuery('#bubbleText').css({ 'width': jQuery('#bubble').width() });
                function getImageByActivity(activityId)
                {
                    var id = activityId.split(\"_\")[1];
                    var activitiesArrayJS = " . json_encode($activitiesArray) . ";
                    var neighborhood;
                    for(var i=0; i<activitiesArrayJS.length; i++)
                    {
                        if(activitiesArrayJS[i].id == id)
                        {
                            neighborhood = activitiesArrayJS[i].neighborhood;
                            break;
                        }    
                    }
                    var mapsArray = " . DB_functions::get_maps() . ";
                    for(var i=0; i<mapsArray.length; i++)
                    {
                        if(mapsArray[i].neighborhood.localeCompare(neighborhood) == 0)
                        {
                            return mapsArray[i].url;
                        }
                    }

                }
                function getActivityName(activityId)
                {
                    var id = activityId.split(\"_\")[1];
                    var activitiesArrayJS = " . json_encode($activitiesArray) . ";
                    for(var i=0; i<activitiesArrayJS.length; i++)
                    {
                        if(activitiesArrayJS[i].id == id)
                        {
                            return activitiesArrayJS[i].name;
                        }    
                    }
                }
                function getActivityDescription(activityId)
                {
                    var id = activityId.split(\"_\")[1];
                    var activitiesArrayJS = " . json_encode($activitiesArray) . ";
                    for(var i=0; i<activitiesArrayJS.length; i++)
                    {
                        if(activitiesArrayJS[i].id == id)
                        {
                            return activitiesArrayJS[i].description;
                        }    
                    }
                }
                function getCategoryDescription(categoryId)
                {
                    var id = categoryId.split(\"_\")[1];
                    var categoriesArrayJS = " . json_encode($categoriesArray) . ";
                    for(var i=0; i<categoriesArrayJS.length; i++)
                    {
                        if(categoriesArrayJS[i].id == id)
                        {
                            return categoriesArrayJS[i].description;
                        }    
                    }
                }
                function getCategoryName(categoryId)
                {
                    var id = categoryId.split(\"_\")[1];
                    var categoriesArrayJS = " . json_encode($categoriesArray) . ";
                    for(var i=0; i<categoriesArrayJS.length; i++)
                    {
                        if(categoriesArrayJS[i].id == id)
                        {
                            return categoriesArrayJS[i].name;
                        }    
                    }
                }
                function getCategoryNameByActivity(activityId)
                {
                    var id = activityId.split(\"_\")[1];
                    var activitiesArrayJS = " . json_encode($activitiesArray) . ";
                    for(var i=0; i<activitiesArrayJS.length; i++)
                    {
                        if(activitiesArrayJS[i].id == id)
                        {
                            return activitiesArrayJS[i].category;
                        }    
                    }
                }
                function getLogoUrl(categoryName)
                {
                    var categoriesArrayJS = " . json_encode($categoriesArray) . ";
                    for(var i=0; i<categoriesArrayJS.length; i++)
                    {
                        if(categoriesArrayJS[i].name.localeCompare(categoryName) == 0)
                        {
                            return categoriesArrayJS[i].logoUrl;
                        }    
                    }
                }
                jQuery('.tag').hover(
                function(){
           
                    var activityId = jQuery(this).attr('id');
                    var urlByActivityId = getImageByActivity(activityId);
                    jQuery('#map').css('background-image','url(' + urlByActivityId + ')');
                    

                    var textForBubble = getActivityDescription(activityId);                    
                    var title = getActivityName(activityId);
                        
                    var linkId = 'link_' + activityId.split(\"_\")[1];
                    
                    var link = '<br/><br/><a class=\"link\" id=' + linkId + ' href=\"#contentActivityRef\"  onClick=onClickReadMore() style=\"cursor: pointer; border-bottom: none;\">קרא עוד></a>';
                    
                    jQuery('#categoryLogo').empty();
                    
                    var categoryName = getCategoryNameByActivity(activityId);
                    var categoryLogoUrl = getLogoUrl(categoryName);
                    
                    var logoImg = '<img src=\"' + categoryLogoUrl + '\"></img>';

                    jQuery('#categoryLogo').append(logoImg);
                    
                    jQuery('.link').attr('id');
                    jQuery('#textTitle').text(title);
                    jQuery('#bubbleText').text(textForBubble);
                    jQuery('#bubbleText').append(link);
                });
                jQuery('.categories').hover(
                function(){
           
                    var categoryId = jQuery(this).attr('id');
                    
                    var textForBubble = getCategoryDescription(categoryId);
                           
                    var title = getCategoryName(categoryId);
                        
                    jQuery('#categoryLogo').empty();
                    
                    
                    jQuery('#textTitle').text(title);
                    jQuery('#bubbleText').text(textForBubble);
                });
                function onClickReadMore()
                {
                    jQuery('#activityImages').empty();
                    var linkId = (jQuery('.link').attr('id'));
                    var id = linkId.split(\"_\")[1];
                    var activityId = \"activity_\" + id;                
                    
                    contentText = getActivityDescription(activityId);
                    jQuery('#contentActivityText').text(contentText);
                    var activitiesImagesArray = " . DB_functions::get_activities_images() . ";
                    
                    var imageIndex = 1;
                    for(var i=0; i<activitiesImagesArray.length; i++)
                    {
                        if(activitiesImagesArray[i].activity_id == id)
                        {
                            image = '<img id=\"img_' + id + '\" src = \"' + activitiesImagesArray[i].url +'\"></img>';
                            jQuery('#activityImages').append(image);
                            imageIndex++;
                        }
                    }
                    
                }
                jQuery('.categories').click(
                    function()
                    {
                        var activitiesArrayJS = " . json_encode($activitiesArray) . ";
                        
                        var categoryId = jQuery(this).attr('id');
                        var id = categoryId.split(\"_\")[1];
                        var categoriesArrayJS = " . json_encode($categoriesArray) . ";
                        var categoryName;
                        for(var i=0; i<categoriesArrayJS.length; i++)
                        {
                            if(categoriesArrayJS[i].id == id)
                            {
                                categoryName = categoriesArrayJS[i].name;
                            }    
                        }
                        
                        for(var i=0; i<activitiesArrayJS.length; i++)
                        {
                            var activityId = 'activity_' + activitiesArrayJS[i].id;
                            
                            if(activitiesArrayJS[i].category.localeCompare(categoryName) == 0)
                                jQuery(\"#\" + activityId).show();   
                            else
                                jQuery(\"#\" + activityId).hide();
                        }
                    });
                </script>";
    
    return $content;
}


add_shortcode('wp-mapify', 'display');



?>
