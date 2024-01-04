<!DOCTYPE html>
  <style>
    body{
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size:cover;
      background-repeat:no-repeat;
      backdrop-filter: contrast(1);
    }
    #page-title{
      text-shadow: 6px 4px 7px black;
      font-size: 3.5em;
      color: #fff4f4 !important;
      background: #8080801c;
    }

  </style>
  </html>
<style>
    .carousel-item>img{
        object-fit:fill !important;
    }
    #carouselExampleControls .carousel-inner{
        height:280px !important;
    }
</style>
<section class="py-0">
    <div class="container">
        <div class="col-lg-12 py-2">
            <div class="row">
                <div class="col-md-12">
                    <div id="carouselExampleControls" class="carousel slide bg-dark" data-ride="carousel" data-interval="2500">
                        <div class="carousel-inner">
                            <?php 
                                $upload_path = "uploads/banner";
                                if(is_dir(base_app.$upload_path)): 
                                $file= scandir(base_app.$upload_path);
                                $_i = 0;
                                    foreach($file as $img):
                                        if(in_array($img,array('.','..')))
                                            continue;
                                $_i++;
                                    
                            ?>
                            <div class="carousel-item h-100 <?php echo $_i == 1 ? "active" : '' ?>">
                                <img src="<?php echo validate_image($upload_path.'/'.$img) ?>" class="d-block w-100  h-100" alt="<?php echo $img ?>">
                            </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        </div>
                </div>
            </div>
            <div class="container px-4 px-lg-5 mt-5">
                <form action="" id="search-frm">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="search" class="form-control form-control-lg" name="search" value="<?= isset($_GET['search']) ? $_GET['search'] : "" ?>" placeholder="Search Mobile Model/Brand Here...">
                                    <div class="input-group-append"><button class="btn btn-outline-secondary"><i class="fa fa-search"></i></button></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="clear-fix mb-3"></div>
                <div class="row gx-4 gx-lg-4 row-cols-md-3 row-cols-xl-4 ">
                    <?php 
                    $search = "";
                    if(isset($_GET['search'])){
                        $s = $_GET['search'];
                        $search = " and (`brand` LIKE '%{$s}%' or `model` LIKE '%{$s}%') ";
                    }
                       $qry = $conn->query("SELECT * FROM `mobile_list` where `status` = 1 {$search} order by `model` asc, `brand` asc");
                       while($row = $qry->fetch_assoc()):
                    ?>
                    <div class="col mb-5">
                        <a class="card product-item text-reset text-decoration-none" href=".?p=view_content&id=<?php echo ($row['id']) ?>">
                            <!-- Product image-->
                            <div class="overflow-hidden shadow product-holder">
                            <img class="card-img-top w-100 product-cover" src="<?php echo validate_image(isset($row['thumbnail_path']) ? $row['thumbnail_path'] : "") ?>" alt="..." />
                            </div>
                            <!-- Product details-->
                            <div class="card-body p-4">
                                <h5 class="card-title w-100 font-weight-bolder"><?= $row['model'] ?></h5>
                                <p class="m-0"><span class="text-muted">Brand: </span><?= isset($row['brand']) ? ($row['brand']) : "" ?></small></p>
                            </div>
                        </a>
                    </div>
                    <?php endwhile; ?>
                </div>
                <?php if($qry->num_rows < 1): ?>
                    <center><em class="text-muted">No data to display.</em></center>
                <?php endif; ?>
            </div>
    </div>
    </div>
</section>
<script>
    $(function(){
        $('#search-frm').submit(function(e){
            e.preventDefault();
            location.href = "./?"+$(this).serialize()
        })
    })

</script>