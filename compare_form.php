
<style>
    .carousel-item>img{
        object-fit:fill !important;
    }
    #carouselExampleControls .carousel-inner{
        height:280px !important;
    }
    .mob-img{
        width:50px;
        height:100px;
        object-fit:scale-down;
        object-position:center center;
    }
    .mob-img-selected{
        width:50px;
        height:65px;
        object-fit:scale-down;
        object-position:center center;
    }
    span.select2-selection.select2-selection--single {
        height: auto !important;
    }
    span.select2-selection__arrow {
        top: 20% !important;
    }
</style>
<?php 
?>
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
                <form action="" id="compare-frm">
                    <div class="card card-outline card-purple rounded-0 shadow">
                        <div class="card-body">
                            <fieldset>
                                <legend>Compare Smart Phones</legend>
                                <div class="row align-items-end">
                                    <?php 
                                    $mobile = $conn->query("SELECT * FROM `mobile_list` where status = 1 order by `brand` asc, `model` asc");
                                    $list = $mobile->fetch_all(MYSQLI_ASSOC);
                                    ?>
                                    <div class="form-group col-md-4">
                                        <label for="mobile1" class="control-label">Mobile 1</label>
                                        <select name="mobile[]" id="mobile1" class="form-control form-control-sm select2" required>
                                            <option value="" disabled selected data-path='<?= validate_image('') ?>'></option>
                                            <?php 
                                            
                                            foreach($list as $row):
                                            ?>
                                            <option data-path='<?= validate_image($row['thumbnail_path']) ?>' value="<?= $row['id'] ?>"><?= $row['brand']. ' '.$row['model'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label for="mobile2" class="control-label">Mobile 2</label>
                                        <select name="mobile[]" id="mobile2" class="form-control form-control-sm select2" required>
                                            <option value="" disabled selected data-path='<?= validate_image('') ?>'></option>
                                            <?php 
                                            
                                            foreach($list as $row):
                                            ?>
                                            <option data-path='<?= validate_image($row['thumbnail_path']) ?>' value="<?= $row['id'] ?>"><?= $row['brand']. ' '.$row['model'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button class="btn btn-default bg-gradient-purple btn-flat text-light">Compare</button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </form>
                <div class="clear-fix mb-3"></div>

            </div>
    </div>
    </div>
</section>
<script>
    $(function(){
        $('.select2').select2({
            placeholder:"Please Select Here",
            width:"100%",
            templateResult: function (state) {
                var $span = $("<span><img class='mob-img' src='"+ $(state.element).attr('data-path') +"'/> " + state.text + "</span>");
                return $span;
            },
            templateSelection: function (state) {
                if(!$(state.element).attr('data-path'))
                return state.text;
                var $span = $("<span><img class='mob-img-selected' src='"+ $(state.element).attr('data-path') +"'/> " + state.text + "</span>");
                return $span;
            }
        })
        $('#compare-frm').submit(function(e){
            e.preventDefault();
            e.preventDefault();
            if($('#mobile1').val() == $('#mobile2').val()){
                alert_toast("Selected Smart phones to compare are the same.",'warning')
                return false;
            }
            location.href="./?p=compare&"+$(this).serialize();
        })
    })

</script>