  <?php include_once "model.php"; 
  $model = new Model();

  ?>
  <?php $active = "upload";
  include_once "header2.php"; ?>
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
    <?php include_once "topnav.php"; ?>

      <style type="text/css">
        .mb-2, .my-2,
        .card-header:first-child {
          color: black;
        }
      </style>
      <main role="main" class="inner cover container">
        <div class="row">
          <div class="col-md-6 col-sm-12">
            <!-- Our markup, the important part here! -->
            <div id="drag-and-drop-zone" class="dm-uploader p-5">
              <h3 class="mb-5 mt-5 text-muted">Drag &amp; drop files here</h3>

              <div class="btn btn-primary btn-block mb-5">
                  <span>Open the file Browser</span>
                  <input type="file" title='Click to add Files' />
              </div>
            </div><!-- /uploader -->
          </div>
          <div class="col-md-6 col-sm-12">
            <div class="card h-100">
              <div class="card-header">
                File List
              </div>

              <ul class="list-unstyled p-2 d-flex flex-column col" id="files">
                <li class="text-muted text-center empty">No files uploaded.</li>
              </ul>
            </div>
          </div>
          <div class="col-12">
            <a href="incomplete.php" class="btn btn-primary">Next</a>
          </div>
        </div><!-- /file list -->
      </main>
      <?php include_once "footer.php"; ?>
    </div>


    <script src="js/jquery.js"></script>
    <script src="bootstrap-4.0.0/dist/js/bootstrap.min.js"></script>

    <script src="node_modules/dm-file-uploader/dist/js/jquery.dm-uploader.min.js"></script>
    <script src="js/demo-ui.js"></script>
    <script src="js/demo-config.js"></script>

    <!-- File item template -->
    <script type="text/html" id="files-template">
      <li class="media">
        <div class="media-body mb-1">
          <p class="mb-2">
            <img class="preview" width="50" src="backend/files/%%filename%%">
            <strong></strong> - Status: <span class="text-muted">Waiting</span>
          </p>
          <div class="progress mb-2">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" 
              role="progressbar"
              style="width: 0%" 
              aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
            </div>
          </div>
          <hr class="mt-1 mb-1" />
        </div>
      </li>
    </script>

    <!-- Debug item template -->
    <script type="text/html" id="debug-template">
      <li class="list-group-item text-%%color%%"><strong>%%date%%</strong>: %%message%%</li>
    </script>
    <script type="text/javascript">
      (function(){

      })(jQuery);
    </script>
  </body>
</html>