var videoUpload = {
	data 		: Array(),
	counter 	: 0,
	blocks 		: '',
	uploadLength : 0,
	cover 		: '',
	dropped 	: false,
	videoLength : 0,
	frameLength : 0,
	step 		: 0,
	coor 		: Array(),
	base 		: 0,
	currentHtml : null,
	// getElementById
	$id : function(id) {
		return document.getElementById(id);
	},

	// output information
	Output : function(msg) {
		$("#add-plus").addClass("hidden");
		var m = videoUpload.$id("messages");
		m.innerHTML = msg + m.innerHTML;
	},


	// file drag hover
	FileDragHover : function(e) {
		e.stopPropagation();
		e.preventDefault();
		videoUpload.dropped = true;

		e.target.className = (e.type == "dragover" ? "hover" : "");
	},


	// file selection
	FileSelectHandler : function(e) {
		// cancel event and hover styling
		videoUpload.FileDragHover(e);
		videoUpload.dropped = true;

		// fetch FileList object
		var files = e.target.files || e.dataTransfer.files;
		videoUpload.data = Array();

		// process all File objects
		for (var i = 0, f; f = files[i]; i++) {
			var mp4 = videoUpload.ParseFile(f);
			// videoUpload.data.push(f);
			if(mp4 == true){
				videoUpload.UploadFile(f);
			}
		}
	},
	// output file information
	ParseFile : function(file) {
		if(this.uploadLength > 0){
			alert("You can only upload 1 image for a slideshow");
			return false;
		}

		var ext = Array("bmp", "jpg", "png","jpeg");
		var found = false;

		for(var i in ext){
			if ( (file.type.indexOf(ext[i]) > -1)) {
				found = true;
				break;
			} 
		} 


		if((found == false)  && (this.currentHtml == null)){
			alert("Please upload an image file first");
		} else {
			// if((found == true) && (this.currentHtml == null) ){
				var reader = new FileReader();

				reader.onload = function(e) {
					videoUpload.Output(
						'<img src="'+  e.target.result +'" />'
					);
				}

				reader.readAsDataURL(file);
			// } else {
			// 	var reader = new FileReader();

			// 	reader.onload = function(e) {
			// 		videoUpload.Output(
			// 			'<img src="'+  e.target.result +'"/>'
			// 		);
			// 	}

			// 	reader.readAsDataURL(file);
			// }
		}

		return found;

		if ( (file.type.indexOf("html") == -1) && (this.currentHtml == null)) {
			alert("Please upload a html file first");
		
			return false;
		} 

		return true;
		//we wont be needing the preview so just append the iframe

		// display an image
		if (file.type.indexOf("html") > 0) {
			var reader = new FileReader();

			reader.onload = function(e) {
				videoUpload.Output(
					'<video src="'+  e.target.result +'"></video>'
				);
			}
			reader.readAsDataURL(file);

		} else {
		// 	// var saveModal = $("#SaveVideoModal");

		// 	// saveModal.find(".alert").removeClass("alert-sucess").addClass("alert alert-warning");
		// 	// saveModal.find("#alert-message").html("Bitte verwenden Sie ein Video im MP4-Format");
		// 	// saveModal.modal("show");

		// 	// return false;
		// 	console.log('invalid file name');
		}

	},

	// upload JPEG files
	UploadFile : function(file) {
		var xhr = new XMLHttpRequest();
		var me 	= this;

		if (xhr.upload ) {
			// create progress bar
			var o 			= videoUpload.$id("progress");
			var progress 	= o.appendChild(document.createElement("p"));

			progress.appendChild(document.createTextNode("upload " + file.name));

			// progress bar
			xhr.upload.addEventListener("progress", function(e) {
				var pc = parseInt((e.loaded / e.total * 100));

				$(progress).css({
					"backgroundSize" : (pc*2) + "% 100%"
				});

				if(pc == 100){
					videoUpload.counter++;
					me.uploadLength = 1;
					$("#progress").html("");
				} 

			}, false);

			// file received/failed
			xhr.onreadystatechange = function(e) {
				if (xhr.readyState == 4) {
					progress.className = (xhr.status == 200 ? "success" : "failure");
					
					if(xhr.response != ""){
						me.currentHtml = xhr.response;
						// $("#messages").html("");

						$("#btnAddVideo").removeAttr("disabled");
					// '<video src="'+  e.target.result +'"></video>'

					// 	var iframe = $("<iframe id='previewIframe' style='width:100%; height:600px;' frameborder='0' src='"+ xhr.response +"'></iframe>")
					// 	$("#messages").append(iframe);
					} else {
						var frm = $("#previewIframe");
						var frmSrc = frm.attr("src");

						frm.attr("src", frmSrc);
					}

					console.log(xhr.response);
					$("#addAttachment_form").data("id", xhr.response);
				}
			};

			// var caption 	= $("#caption").val();
			// var adjustable	= $("#adjustable_frequency").is(":checked");
			// var skip		= $("#skip_video").is(":checked");
			// var publish		= $("#publish").is(":checked");
			// var timeblocks 	= me.getTimeBlocks();
			// var formData 	= "&caption="+ caption + "&adjustable="+ adjustable + "&skip="+ skip + "&publish="+ publish+"&blocks="+ timeblocks;
			var $data 		= videoUpload.$id("addAttachment_form").action +"?sliderPath="+ me.currentHtml;

			xhr.open("POST", $data, true);
			xhr.setRequestHeader("X-FILENAME", file.name);
			xhr.send(file);

		} 
	},
	Init : function() {
		var me 				= this;
		var fileselect 		= videoUpload.$id("fileselect"),
			filedrag 		= videoUpload.$id("filedrag"),
			submitbutton 	= videoUpload.$id("submitbutton");

		if(fileselect === null){
			return false;
		}

		$("#addAttachment_form").on("submit", function(e){
			e.preventDefault();
		});

		// if(me.dropped == false ){
			// file select
			fileselect.addEventListener("change", videoUpload.FileSelectHandler, false);

			// filedrag
			// // is XHR2 available?
			var xhr = new XMLHttpRequest();
			//d2

			if (xhr.upload) {
				filedrag.addEventListener("dragover", videoUpload.FileDragHover, false);
				filedrag.addEventListener("dragleave", videoUpload.FileDragHover, false);
				filedrag.addEventListener("drop", videoUpload.FileSelectHandler, false);
				filedrag.style.display = "block";
			}

		// } else {
		// 	alert("d2");
		// 	fileselect.off("change");
		// 	filedrag.off("dragover dragleave drop");
		// 	console.log("d2");
		// }


		$(submitbutton).off("click").on("click", function(e){
			e.preventDefault();
			e.stopPropagation();

			var id = $("#addAttachment_form").data("id");

			if(id != null){
				//update record only
				me.updateVideo(id);
				return false;
			}

			if(videoUpload.data.length == 0){
				alert("Upload video first");
				return false;
			}

			// for(var i in videoUpload.data){
			// 	videoUpload.UploadFile(videoUpload.data[i]);
			// }
		});

	},
	__listen : function(){
		var me = this;

		$("#btnAddVideo").on("click", function(e){
			e.preventDefault();
			var title 	= $("#gameTitle").val();
			var desc 	= $("#gameDesc").val();
			var type 	= $("#gameType").val();

			$.ajax({
				url 	: 'process.php',
				data 	: { updateGame: true, title:title, description:desc, folderId: me.currentHtml, type:type},
				type 	: 'POST',
				dataType 	: 'JSON',
				success 	: function(response){	
					console.log(response);
					$("#game").modal("show");
				},
				error 		: function(){
					console.log("err");
				}
			});
		});
	},
	reload : function(){
		// call initialization file
		if (window.File && window.FileList && window.FileReader) {
			videoUpload.Init();
		}

	}
}
// call initialization file
if (window.File && window.FileList && window.FileReader) {	
	videoUpload.Init();
	videoUpload.__listen();
	
}
