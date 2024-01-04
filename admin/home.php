<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<hr>
<div class="row">
        <div class="col-12 col-sm-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-list"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Category</span>
                <span class="info-box-number">
                  <?php 
                    $category = $conn->query("SELECT * FROM category_list where delete_flag = 0")->num_rows;
                    echo format_num($category);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-light elevation-1"><i class="fas fa-table"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total Fields</span>
                <span class="info-box-number">
                  <?php 
                    $fields = $conn->query("SELECT * FROM field_list where delete_flag = 0 ")->num_rows;
                    echo format_num($fields);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-4 col-md-4 col-sm-12 col-xs-12">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-teal elevation-1"><i class="fas fa-mobile"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total Smart Phones</span>
                <span class="info-box-number">
                  <?php 
                    $mobile = $conn->query("SELECT * FROM mobile_list ")->num_rows;
                    echo format_num($mobile);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
<div class="container">
  <?php 
    $files = array();
      $fopen = scandir(base_app.'uploads/banner');
      foreach($fopen as $fname){
        if(in_array($fname,array('.','..')))
          continue;
        $files[]= validate_image('uploads/banner/'.$fname);
      }
  ?>
  <div id="tourCarousel"  class="carousel slide" data-ride="carousel" data-interval="2500">
      <div class="carousel-inner h-100">
          <?php foreach($files as $k => $img): ?>
          <div class="carousel-item  h-100 <?php echo $k == 0? 'active': '' ?>">
              <img class="d-block w-100  h-100" style="object-fit:contain" src="<?php echo $img ?>" alt="">
          </div>
          <?php endforeach; ?>
      </div>
      <a class="carousel-control-prev" href="#tourCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#tourCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
      </a>
  </div>
</div>
