<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1>Test</h1>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		class ColorBlind {
			constructor(element){
				this.element = element;
			}

			init(){
				var html = $("<button id='start'>press me</button>");

				$("body").append(html);
			}

			listen(){
				$(".start").off().on("click", function(e){
					e.preventDefault();
				});
			}
		}


		(function($){
			$(document).ready(function(){
	
			let cb = new ColorBlind("jordan");
			cb.init();
			// cb.setText("new test");

			});
		})(jQuery);
	</script>
</body>
</html>