<!DOCTYPE html>
<html>
<head>
	<title></title>
	
</head>
<body>
	<style type="text/css">
		h1 {
			background: #eee;
			color: lime;
			font-size: 20px;
		}
	</style>
	<h1 style="text-transform: uppercase;">Test</h1>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript">
		class ColorBlind {
			constructor(){
				this.loadData();
				this.blindColor = []
			}

			loadData(){
				var me = this;
				$.get('rgb.txt', function(data) {
				   me.data = data;

				   me.init();
				}, 'text');
			}

			init(){
				var html = $("<button id='start'>press me</button>");
				var me = this;

				$("body").append(html);

				me.listen();
			}

			listen(){
				var that = this;

				$("#start").on("click", function(e){
					e.preventDefault();

					var child = $("body").children();
					var exclude = ['SCRIPT', 'LINK', 'STYLE'];

					child.each(function(x,y){
						var me = $(this);
						var tagName = me.prop("tagName");
						var color = me.css("color");
						var bg = me.css("backgroundColor");

						color = color.replace("rgb(", "").
							replace(")", "");

						var data = that.data;
						var rgb = data.indexOf(color);
						var start = data.indexOf("]", rgb);
						var end = data.indexOf("[", start);
						var primaryColor = data.substring(start,end);


						if($.inArray(tagName, exclude) == -1){
						primaryColor = $.trim(primaryColor.replace("] ", ""));
							console.log(tagName,primaryColor);
							
						}
					});

				});
			}
		}


		(function($){
			$(document).ready(function(){
	
			let cb = new ColorBlind();

			});
		})(jQuery);
	</script>
</body>
</html>