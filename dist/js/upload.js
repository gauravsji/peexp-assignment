$(document).ready(function(){
        $('#photo').change(function(e){
            $('#file_name').empty();
			$fileName = $(this).val().split('/').pop().split('\\').pop();
			$name = $('<label>' + $fileName + '</label>');
			$name.appendTo('#file_name');
        });
});

var imageLoader = document.getElementById('photo');
    imageLoader.addEventListener('change', handleImage, false);

function handleImage(e) 
{
    var reader = new FileReader();
    reader.onload = function (event) 
	{
        $('#uploader img').attr('src',event.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
    
}

var dropbox;
dropbox = document.getElementById("uploader");
dropbox.addEventListener("dragenter", dragenter, false);
dropbox.addEventListener("dragover", dragover, false);
dropbox.addEventListener("drop", drop, false);

function dragenter(e) {
  e.stopPropagation();
  e.preventDefault();
}

function dragover(e) {
  e.stopPropagation();
  e.preventDefault();
}

function drop(e) {
  e.stopPropagation();
  e.preventDefault();
  var dt = e.dataTransfer;
  var files = dt.files;
  imageLoader.files = files;
}
