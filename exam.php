  <?php include_once "model.php"; 
    $model = new Model();
    $exam = $model->getIshihara();
    $total = count($exam);
  ?>
  <?php $active = "incomplete";
  include_once "header.php"; ?>
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <?php include_once "topnav.php"; ?>

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
      <main role="main" class="inner cover">
        <?php foreach ($exam as $key => $value): ?>
          <div class="ishi <?= ($key == 0) ? '':'hidden'; ?>" data-color="<?= $value['color'];?>" data-answer="<?= $value['object'];?>">
            <br>
            <img src="backend/<?= $value['img'];?>">
            <p>(<?= ($key+1); ?>/<?= $total;?>)</p>
            <label>
              <input type="text" name="" class="ans" placeholder="Answer..">
            </label>
            <input type="submit" value="next"  class="next btn btn-sm btn-primary " name="">
          </div>
        <?php endforeach ?>
        <div class="ishi hidden">
          <h4><span id="result"></span>/<?= $total;?></h4>
        </div>
      </main>
      <?php include_once "footer.php"; ?>
    </div>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
     <script src="js/jquery.js"></script>
    <script src="bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>
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
          
        });
      })(jQuery);
    </script>
  </body>
</html>
