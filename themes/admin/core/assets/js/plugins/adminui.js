
function clone(){
    // remove tinymce and input limiters
    removeTinyMces();
    $(".input-limit").remove();

    var $list = $("#meta");                         // set target list to #meta
    var $firstItem = $list.children('li').first();  // get first LI as our clone sample
    var clone = $firstItem.clone();                 // clone first item in this list
    $(clone).find('input,textarea').val('');        // empty inputs and textareas
    $(clone).find(".chbx").empty();                 // empty all checkbox holders
    $checkboxes = $(clone).find('.chbx')            // collect all checkbox holders
        if($checkboxes.length > 1){
            $i = 1;
            $checkboxes.each(function(){
                if($i < $checkboxes.length) $(this).remove();       // remove checkbox holders if there are more than one: the last one
                $i++;
            });
        }
    // remove error boxes if they exist
    $(clone).find('div.error').remove();
    // replace the deletion checkbox with an insta-delete button
    $(clone).find(".chbx").last().append('<a href="javascript:void(0)" onclick="removeMeta(this)">- Delete</a>');
    // get the number of items
    $(clone).find('span').text($list.children('li').length + 1);
    // set the item number
    $(clone).find('textarea').attr('id', 'tinymce' + ($(".tinymce").length + 1));
    // remove display images
    $(clone).find('div.admin-image-show').remove();
    // add the clone
    $list.append(clone);

    // re-add tinymce and input limiters
    addTinyMces();
    $('.LimitChar').limitinput();
}
function addTinyMces(){
    $("#meta textarea").each(function(){
        tinymce.EditorManager.execCommand('mceAddEditor',true, $(this).attr('id'));
    });
}
function removeTinyMces(){
    $("#meta textarea").each(function(){
        tinymce.EditorManager.execCommand('mceRemoveEditor',true, $(this).attr('id'));
    });
}
function removeMeta(el){
    $(el).parents('.admin-section-t2').remove();
}