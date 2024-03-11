jQuery( document ).ready( function ( $ ) {
	$(".ai-demo-import").click(function(){
		
		if( !install_theme.is_base_active  ){
			if( install_theme.is_base_installed  ){
				var notice = install_theme.notice_html;
				setTimeout(function(){
				    $('.swal2-container ol').append( notice );
				}, 10);
			}
		}
		var base_html = install_theme.base_html;
		if( !install_theme.is_base_installed ){
			$('body').append( base_html );
		}

		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
                action     : 'clear_transient_on_cancel',
                security : clear_state.nonce
            },
			success:function( ) {
                
			},
			error: function( xhr, ajaxOptions, thrownError ){
				console.log(thrownError);
			}
		});

	} );
	$(document.body).on('click', '.close-base-notice' ,function(){
		$(".base-install-notice-outer").remove();
	});

	$(document.body).on('click', '.install-base-theme' ,function(){
	    redirect_uri     = install_theme.admin_url+'/theme-install.php?search=hello-shoppable';
        window.location.href = redirect_uri;
	});

	$(document.body).on('click', '#installBase' ,function(){
		var checked = 'false';
		if(	$('#installBase').is(':checked')){
			checked = 'true';
		}
		$.ajax({
			type: "POST",
			url: ajaxurl,
			data: {
                action     : 'install_base_theme_selection',
                is_checked     : checked,
                security : install_theme.nonce
            },
			success:function( ) {
                
			},
			error: function( xhr, ajaxOptions, thrownError ){
				console.log(thrownError);
			}
		});
	});
} );