/**
 * Created by Keith Larson AYC on 3/9/2016.
 */
function clone(listSelector, limit){
    listSelector = typeof listSelector !== 'undefined' ? listSelector : "#meta";
    limit = typeof limit !== 'undefined' ? limit : 0;

    // first check if we've hit the limit
    if(limit){
        if($(listSelector).children('li').length >= limit) return;
        // return if we have too much
    }
    // remove tinymce and input limiters
    removeTinyMces(listSelector);

    $(".input-limit").remove();


    var $list = $(listSelector);                         // set target list to #meta
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
    // remove links
    $(clone).find('a').remove();
    // replace the deletion checkbox with an insta-delete button
    $(clone).find(".chbx").last().append('<a href="javascript:void(0)" onclick="removeMeta(this)">- Delete</a>');
    // set the item number
    $(clone).find('textarea.tinymce').attr('id', 'tinymce' + ($(".tinymce").length + 1));
    // remove display images
    $(clone).find('div.admin-image-show').remove();
    // add the clone
    $list.append(clone);

    $('.timepicker').pickatime();

    //$('.datepicker').pickadate({
    //    format: 'yyyy-mm-dd'
    //});

    // Init - Pickaday
    $('.datepicker')
        .pikaday({
            firstDay: 1,
            minDate: new Date(),
            format: 'MM/DD/YYYY',
            onOpen: function(e) {
                console.log(e);
            }
        })
        .on('focus blur', function() {
            $(this).keyup();
        });

    // re-add tinymce and input limiters
    addTinyMces(listSelector);
    $('.LimitChar').limitinput();
}
function removeTinyMces(listSelector){
    console.log("remove tiny mces for list selector: " + listSelector);

    $(listSelector + " textarea.tinymce").each(function(){
        tinymce.EditorManager.execCommand('mceRemoveEditor',true, $(this).attr('id'));
    });
}
function addTinyMces(listSelector){
    $(listSelector + " textarea.tinymce").each(function(){
        tinymce.EditorManager.execCommand('mceAddEditor',true, $(this).attr('id'));
    });
}
function removeMeta(el){
    $(el).parents('.admin-section-t2').remove();
}
function reSort(el){
    var $this = $(el);
    var thisNewOrder = $this.val();
    // find other with this name
    var i = 1;
    $("select[name='" + $this.attr('name') + "']").each(function(){
        console.log("i:" + i + " thisNewOrder:" + thisNewOrder);
        console.log($(this));

        if (i == thisNewOrder) {
            i++;
        }

        if($(this).is($this)){
            //i++;
        } else {
            $(this).val(i);
            i++;
        }
    });
}