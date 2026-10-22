$( document ).ready(function() {
    
    // Chat Messenger Show/Hide
    $('.chat-block').click(function(e) {  
        $('.chat-messenger').addClass('chat-messenger-active');
    });    
    $('.chat-messenger-close').click(function(e) {  
        $(this).parents('.chat-messenger').removeClass('chat-messenger-active');
    });
    
    // Chat Dropdown Show/Hide
    $('.chat-block .fa-ellipsis-v').click(function(e) {  
        e.stopPropagation();
        $('.chat-block').not($(this).parents('.chat-block')).removeClass('open');
        $(this).parents('.chat-block').toggleClass('open');
    });
    $(document).on("click", function (e) {
        if ($(e.target).is(".chat-block .fa-ellipsis-v") === false) {
            $(".chat-block").removeClass("open");
        }
    });
    
    $('.chat-dropdown li a').click(function(e) {  
        e.stopPropagation();
    });
    $('.chat-dropdown li .add-to-group, .chat-dropdown li .users-info').click(function(e) {  
        e.stopPropagation();
        var dropPara = $(this).parents('.chat-block-drop');
        dropPara.children('.fa-ellipsis-v').hide();
        dropPara.children('.fa-times').show();
        $(this).parents('.chat-block').removeClass('open');
    });
    
    // Chat Info Details
    $('.users-info').click(function(e) {
        var parentBlock = $(this).closest('.chat-block');
        parentBlock.addClass('info-active');
        parentBlock.next().next('.chat-info-wrapper').addClass('chat-user-active');
    });
    
    // Chat Group Adding by Users
    $('.add-to-group').click(function(e) {
        var parentBlock = $(this).closest('.chat-block');
        parentBlock.addClass('user-group-active');
        parentBlock.next('.chat-users-wrapper').addClass('chat-group-active');
    });
    
    // Close Chat Info and Chat Group    
    $('.chat-block .fa-times').click(function(e) {
        e.stopPropagation();
        var timePara = $(this).parents('.chat-block');
        var vertPara = timePara.children('.chat-block-cell');
        timePara.removeClass('info-active');
        timePara.removeClass('user-group-active');
        vertPara.children('.fa-ellipsis-v').show();
        $(this).hide();
        timePara.next().next('.chat-info-wrapper').removeClass('chat-user-active');
        timePara.next('.chat-users-wrapper').removeClass('chat-group-active');
    });
    
    // Chat Checkbox
    $('.chat-checkbox input:checkbox').each(function() {
        $('.chat-checkbox:has(input:checkbox:checked)').addClass('active');
    });    
    $('.chat-checkbox input:checkbox').change(function(){
        if($(this).is(":checked")) {
            $(this).parents(".chat-checkbox").addClass("active");
        } else {
            $(this).parents(".chat-checkbox").removeClass("active");
        }
    });
    
    
    // Gorup Chat
    if ($(".group-block").length !== 0) {
        $('input:checkbox').each(function() {
            $('.col-group:has(input:checkbox:checked)').addClass('active');
        }); 
        $('.col-group input:checkbox').change(function(){
            if($(this).is(":checked")) {
                $(this).parents(".col-group").addClass("active");
            } else {
                $(this).parents(".col-group").removeClass("active");
            }
        });
        $(".group-block-header .add-group-btn").click(function(){
            $(this).toggleClass('active');
            $(".group-block-header .add-new-group").slideToggle();
        });
        
        $('.hide-inline-gorup').click(function(e) {
            e.stopPropagation();
            var grpPara = $(this).parents('.col-group-body');
            grpPara.children('.group-list').show();
            grpPara.children('.group-inline').hide();
        });
        $('.hide-list-gorup').click(function(e) {
            e.stopPropagation();
            var grpPara = $(this).parents('.col-group-body');
            grpPara.children('.group-inline').show();
            grpPara.children('.group-list').hide();
        });
    }
    
    // User Chat and Group Chat Show/Hide
    $('.chat-group-link').click(function(e) {
        e.stopPropagation();
        var grpPara = $(this).parents('body');
        grpPara.children('.group-chat-wrapper').show();
        grpPara.children('.user-chat-wrapper').hide();
    });
    $('.backto-chat').click(function(e) {
        e.stopPropagation();
        var grpPara = $(this).parents('body');
        grpPara.children('.user-chat-wrapper').show();
        grpPara.children('.group-chat-wrapper').hide();
    });
    $('.chat-close').click(function(e) {
        e.stopPropagation();
        var grpPara = $(this).parents('body');
        grpPara.children('.user-chat-wrapper').hide();
    });
    $('.group-close').click(function(e) {
        e.stopPropagation();
        $(this).parents('.group-label').hide();
    });
    
    // Group Chat Dropdown
    $('.col-group-head .fa-ellipsis-v').click(function(e) {  
        e.stopPropagation();
        $('.col-group-head').not($(this).parents('.col-group-head')).removeClass('open');
        $(this).parents('.col-group-head').toggleClass('open');        
    });
    $(document).on("click", function (e) {
        if ($(e.target).is(".col-group-head .fa-ellipsis-v") === false) {
            $(".col-group-head").removeClass("open");
        }
    });
    
    $('.chat-dropdown li .add-group-member').click(function(e) {  
        e.stopPropagation();
        var dropPara = $(this).parents('.col-group-head');
        var dropChil = dropPara.children('.group-drop');
        var dropnt = dropPara.next('.col-group-body');
        dropChil.children('.fa-ellipsis-v').hide();
        dropnt.children('.user-search-list').show();
        dropChil.children('.fa-times').show();
        $(this).parents('.col-group-head').removeClass('open');
    });
    $('.group-drop .fa-times').click(function(e) {
        e.stopPropagation();
        var timePara = $(this).parents('.col-group-head');
        var timeChil = $(this).parents('.group-drop');
        var dropnt = timePara.next('.col-group-body');
        timeChil.children('.fa-ellipsis-v').show();
        dropnt.children('.user-search-list').hide();
        $(this).hide();
    });
    $('.user-search-list input:checkbox').change(function(){
        if($(this).is(":checked")) {
            $(this).parents(".user-search-list").addClass("active");
        } else {
            $(this).parents(".user-search-list").removeClass("active");
        }
    });
    
});