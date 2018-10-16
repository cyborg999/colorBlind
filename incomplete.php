  <?php include_once "model.php"; 
  $model = new Model();

  $exams = $model->getIncompleteExams();

  ?>
  <?php $active = "incomplete";
  include_once "header.php"; ?>
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <?php include_once "topnav.php"; ?>

      <style type="text/css">
        .jumbotron {
          padding: 50px 10px 10px;
          margin: 10px auto;
        }
        .jumbotron * {
          color: black;
          text-shadow: none;
          margin: 10px auto;
          display: block;
        }
        .hidden {
          display: none;
        }
        .card {
          background: transparent;
          border: 0;
        }
        .card {
          position: relative;
        } 
        .card .close {
          position: absolute;
          top: -56px;
          right: 7px;
          font-size: 29px;
        }
        .card input[type="text"] {
          /*background: transparent;*/
        }
        .card.active {
          display: block;
        }
        .card-img-top {
          max-width: 200px;
          margin: 0 auto;
        }
      </style>
      <main role="main" class="inner cover">
        <div class="jumbotron">
          <?php 
          foreach ($exams as $key => $value): ?>
            <div data-id="<?= $value['id'];?>" class="card <?= ($key == 0) ? 'active' : 'hidden'; ?>">
              <a href="" class="close">x</a>
              <img class="card-img-top" src="backend/<?= $value['img'];?>" alt="<?= $value['color'];?>">
              <div class="card-body">
                <h5 class="card-title">
                  <input type="text" required class="form-control name" placeholder="Describe the Object in this image..." name="">
                </h5>
                <p class="card-text">
                  <input type="text"  required class="form-control color" placeholder="Color..." name="">
                </p>
                <p class="lead">
                  <a class="btn btn-primary btn-lg update" href="#" role="button">Update</a>
                </p>
              </div>
            </div>  
          <?php endforeach ?>
          <?php if (!count($exams)): ?>
            <div class="card active">
              <p class="lead">No more new item.</p>
            </div>
          <?php endif ?>
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
          $(".close").on("click", function(e){
            e.preventDefault();

            var me = $(this);
            var id = me.parents(".card").data("id");
            var next = me.parents(".card").next(".card");

            $.ajax({
              url : "process.php",
              data : { deleteExam : true, id : id},
              type : "POST",
              dataType : "JSON",
              success :  function(res){
                console.log(res);

                me.parents(".card").remove();
                next.removeClass("hidden");
              }
            });
          });

          $(".update").on("click", function(e){
            e.preventDefault();

            var me = $(this);
            var card =  me.parents(".card");
            var id = card.data("id");
            var name = card.find(".name").val();
            var color = card.find(".color").val();

            $.ajax({
              url : "process.php",
              data : { updateExam : true, id : id, name : name, color : color},
              type : "POST",
              dataType : "JSON",
              success : function (res){
                card.removeClass("active");
                card.next(".card").addClass("active");
                card.remove();
              }
            });

          });
        });
      })(jQuery);
    </script>
  </body>
</html>
