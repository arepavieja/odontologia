$(function(){
	$('#editor1').ace_wysiwyg({
		toolbar:
		[
			{name:'bold', className:'btn-info'},
			{name:'italic', className:'btn-info'},
			{name:'strikethrough', className:'btn-info'},
			{name:'underline', className:'btn-info'},
			null,
			'foreColor',
			null,
		]
	}).prev().addClass('wysiwyg-style2');

	$('#editor2').ace_wysiwyg({
		toolbar:
		[
			{name:'bold', className:'btn-info'},
			{name:'italic', className:'btn-info'},
			{name:'strikethrough', className:'btn-info'},
			{name:'underline', className:'btn-info'},
			null,
			'foreColor',
			null,
		]
	}).prev().addClass('wysiwyg-style2');
})