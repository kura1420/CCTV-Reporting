$(document).ready(function() {
	// $('textarea[data-provide="markdown"]').each(function(){
 //        var $this = $(this);

	// 	if ($this.data('markdown')) {
	// 	  $this.data('markdown').showEditor();
	// 	}
	// 	else $this.markdown()

	// 	$this.parent().find('.btn').addClass('btn-white');
 //    })

	function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
		else {
			//console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	}

	$('.editor1').ace_wysiwyg({
		toolbar:
		[
			'font',
			null,
			'fontSize',
			null,
			{name:'bold', className:'btn-info'},
			{name:'italic', className:'btn-info'},
			{name:'strikethrough', className:'btn-info'},
			{name:'underline', className:'btn-info'},
			null,
			{name:'insertunorderedlist', className:'btn-success'},
			{name:'insertorderedlist', className:'btn-success'},
			{name:'outdent', className:'btn-purple'},
			{name:'indent', className:'btn-purple'},
			null,
			{name:'justifyleft', className:'btn-primary'},
			{name:'justifycenter', className:'btn-primary'},
			{name:'justifyright', className:'btn-primary'},
			{name:'justifyfull', className:'btn-inverse'},
			null,
			{name:'createLink', className:'btn-pink'},
			{name:'unlink', className:'btn-pink'},
			null,
			{name:'insertImage', className:'btn-success'},
			null,
			'foreColor',
			null,
			{name:'undo', className:'btn-grey'},
			{name:'redo', className:'btn-grey'}
		],
		'wysiwyg': {
			fileUploadError: showErrorAlert
		}
	}).prev().addClass('wysiwyg-style2');

	  var max = 3;
	  var tblImg = $("#tblImg");
	  var addImg = $("#addImg");

	  var x = 1;
	  $(addImg).click(function(e) {
	        e.preventDefault();
	        if (x < max) {
	          x++;
	          $("#tblImg").append("<tr><td><input type='file' name='pic_name[]' class='form-control' /></td><td><a href='javascript:void(0);' class='btn btn-danger btn-sm rmImg'>Hapus</a></td></tr>").innerHTML = hit;
	        }
	    });

	    $("#tblImg").on('click','.rmImg',function(e) {
	        e.preventDefault();
	        $(this).parent().parent().remove();
	        x--;
	    });
});