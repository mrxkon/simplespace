(function($){

	$( document ).ready( function() {

		function getIndexPost() {

			var id = $(this).data('id');

			$.ajax({
				url: simplespaceAjax.ajaxurl,
				data: {
					'action' : 'fetch_index_post'
				},
				success:function(data) {
					$('#ajax-post-content').html(data);
				}
			});
		}

		getIndexPost();

	});
})(jQuery)