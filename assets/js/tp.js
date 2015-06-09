$(document).ajaxStart(function(){
    NProgress.start();
}).ajaxComplete(function(){
    NProgress.done();
}).ajaxError(function(){
    $.bootstrapGrowl('未知的系统错误', {
        type: 'danger',
        align: 'center',
    });
})

$(function(){
    $(document).on('click','[ajax-dialog]',function(event){
        event.preventDefault();
        var size = $(this).attr('dialog-size');
        // if (!size) size = 'size-wide';
        var url = $(this).attr('href');
        var title = $(this).attr('dialog-title');
        BootstrapDialog.show({
            message: $('<div ></div>').load(url),
            size:size,
            title:title,
        });
    })

    $('[ajax-confirmation]').confirmation({
        onConfirm:function(event, element){
            event.preventDefault();
            var url =  $(element).attr('href');
            $.get(url,function(){
                window.location.reload();
            });
        }
    });

    $(document).on('click','a[data-ajax]',function(event){
        event.preventDefault();
        var url = $(this).attr('href');
        $.get(url,function(req){
            $.bootstrapGrowl(req['info'], {
                type: 'danger',
                align: 'center',
            });
        })
    })

    $(document).on('click','[data-close-dialog]',function(event){
        event.preventDefault();
        BootstrapDialog.closeAll();
    })


    $(document).on('submit','form[data-ajax]',function(e){
        
        e.preventDefault();
        var $form = $(this);
        var url = $form.attr('action');
        var form_data = $form.triggerHandler('submitForm');
        if ( form_data || typeof form_data == "undefined") {
            var post_data = $form.serialize();
            $.post(url,post_data,function(req){
                $.bootstrapGrowl(req['info'], {
                    type: 'danger',
                    align: 'center',
                });
                if (req['status'] == '1') {
                    if (req['url']) 
                        window.location.href = req['url'];
                }
            })
        }
    })
})


function U(arg,arg_val,url){ 
    if (!url) url = window.location.href;
    var pattern=arg+'=([^&]*)'; 
    var replaceText=arg+'='+arg_val; 
    if(url.match(pattern)){ 
        var tmp='/('+ arg+'=)([^&]*)/gi'; 
        tmp=url.replace(eval(tmp),replaceText); 
        return tmp; 
    }else{ 
        if(url.match('[\?]')){ 
            return url+'&'+replaceText; 
        }else{ 
            return url+'?'+replaceText; 
        } 
    } 
    return url+'\n'+arg+'\n'+arg_val; 
}