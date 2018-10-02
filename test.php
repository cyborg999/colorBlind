<?php include_once "model.php"; ?>
<?php $model = new Model(); 
$test = $model->getIshihara();
$total = count($test);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<style type="text/css">
		.ishi {
			width: 300px;
			padding: 20px;
			margin: 0 auto;
		}
		.ishi img {
			max-width: 100%;

		}
		.hidden {
			display: none;
		}
	</style>
	<?php foreach ($test as $key => $value): ?>
		<div class="ishi <?= ($key == 0) ? '':'hidden'; ?>" data-color="<?= $value['color'];?>" data-answer="<?= $value['object'];?>">
			<br>
			<img src="img/download.png">
			<p>(<?= ($key+1); ?>/<?= $total;?>)</p>
			<label>
				<input type="text" name="" class="ans" placeholder="Answer..">
			</label>
			<input type="submit" value="next"  class="next" name="">
		</div>
	<?php endforeach ?>
	<div class="ishi hidden">
		<h4><span id="result"></span>/<?= $total;?></h4>
	</div>
	<br>
	<br>
	<br>
	<table>
		<tr class="template-upload fade" data-id="4">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error"></strong>
        </td>
        <td>
            <p class="size">Processing...</p>
            <div class="progress"></div>
        </td>
        <td>
            <label>Background
                <input type="text" class="bgcolor form-control" placeholder="Background Color..."/>
            </label>
        </td>
        <td>
            <label>Object
                <input type="text" class="obj form-control" placeholder="Object..."/>
            </label>
        </td>
        <td>
            <label>Color
                <input type="text" class="color form-control" placeholder="Color..."/>
            </label>
        </td>
        <td>
            <a href="" class="btn btn-primary updatefile">Update</a>
        </td>
    </tr>
	</table>
	<button>test</button>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
	(function($){
		$(document).ready(function(){
			var error = Array();
			$(".next").on("click", function(e){
				e.preventDefault();

				var me = $(this);
				var ishi = me.parents(".ishi");
				var answer = ishi.data("answer");
				var color = ishi.data("color");
				var ans = ishi.find(".ans").val();

				if(answer != ans){
					error.push(color);
				}

				$("#result").html(error.length);
				ishi.addClass("hidden");
				ishi.next(".ishi").removeClass("hidden");
				console.clear();
				console.log(error, error.length);

			});

			$(".updatefile").on("click", function(e){
				e.preventDefault();

				var me = $(this);
				var id = me.parents("tr").data("id");
				var color = me.parents("tr").find(".color").val();
				var bg = me.parents("tr").find(".bgcolor").val();
				var obj = me.parents("tr").find(".obj").val();

				$.ajax({
					url : "process.php",
					data : { updateFile : true, id : id, color:color , bg:bg, obj:obj},
					type : "POST",
					dataType : "JSON",
					success : function(res){
						console.log(res);
					}
				});
			});

			$("button").on("click", function(e){
				e.preventDefault();

				$.ajax({
					url : "process.php",
					data : {file : "test"},
					type : "POST",
					dataType : "JSON",
					success : function(res){
						console.log(res);
					}
				});
			});
		});
	})(jQuery);
</script>

</body>
</html>