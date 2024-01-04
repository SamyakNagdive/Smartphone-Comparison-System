<?php

if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `mobile_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
        $meta = $conn->query("SELECT * FROM mobile_meta where mobile_id = '{$id}'");
        $field = [];
        while($row = $meta->fetch_array()){
            $field[$row['field_id']] = $row['meta_value'];
        }
    }
}
?>
<style>
    img#cimg{
		max-height: 15vh;
		width: 100%;
		object-fit: scale-down;
		object-position: center center;
	}
</style>
<div class="content py-3">
    <div class="card card-outline card-purple rounded-0 shadow">
        <div class="card-header">
            <h4 class="card-title"><b><?= isset($id) ? "Add New Smart Phone" : "Update Smart Phone's Details" ?></b></h4>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <form action="" id="mobile-form">
                    <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="brand" class="control-label">Device Brand</label>
                                <input type="text" name="brand" id="brand" class="form-control form-control-sm rounded-0" value="<?php echo isset($brand) ? $brand : ''; ?>"  required/>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="model" class="control-label">Device Model</label>
                                <input type="text" name="model" id="model" class="form-control form-control-sm rounded-0" value="<?php echo isset($model) ? $model : ''; ?>"  required/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="display_content" class="control-label">Display Content</label>
                                <textarea cols="3" name="display_content" id="display_content" class="form-control form-control-sm rounded-0 summernote" required><?php echo isset($display_content) ? $display_content : ''; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php 
                    $categories = $conn->query("SELECT * FROM `category_list` where delete_flag = 0 order by `order_by` asc");
                    while($crow = $categories->fetch_assoc()):
                    ?>
                    <fieldset class="border-bottom border-gray">
                        <legend class="text-muted"><b><?= $crow['name'] ?></b></legend>
                        <div class="row">
                            <?php 
                            $field_qry = $conn->query("SELECT * FROM `field_list` where category_id = '{$crow['id']}' and delete_flag = 0 order by `order_by` asc");
                            while($frow = $field_qry->fetch_assoc()):
                            ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label for="field_id_<?= $frow['id'] ?>" class="control-label"><?= $frow['name'] ?></label>
                                        <textarea cols="3" name="field_id[<?= $frow['id'] ?>]" id="field_id_<?= $frow['id'] ?>" class="form-control form-control-sm rounded-0" required><?php echo isset($field[$frow['id']]) ? $field[$frow['id']] : ''; ?></textarea>
                                        <small class="text-muted"><i class="fa fa-question-circle"></i> <em><?= $frow['description'] ?></em></small>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </fieldset>
                    <?php endwhile; ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="status" class="control-label">Status</label>
                                <select name="status" id="status" class="form-control form-control-sm rounded-0" required>
                                <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Thumbnail</label>
                                <div class="custom-file">
                                <input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-center">
                                <img src="<?php echo validate_image(isset($thumbnail_path) ? $thumbnail_path : "") ?>" alt="" id="cimg" class="img-fluid img-thumbnail bg-gradient-gray" accept="image/png, image/jpeg">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="control-label">Other Images</label>
                                <div class="custom-file overflow-hidden">
                                <input type="file" class="custom-file-input rounded-circle" id="customFile" name="imgs[]" multiple accept="image/png, image/jpeg" onchange="displayImg3(this,$(this))">
                                <label class="custom-file-label" for="customFile" style="white-space: nowrap;">Choose file</label>
                                </div>
                                <small><i>Choose to upload new banner immages</i></small>
                            </div>
                            <?php 
                            if(isset($id)):
                            $upload_path = "uploads/mobile_".$id;
                            if(is_dir(base_app.$upload_path)): 
                            $file= scandir(base_app.$upload_path);
                                foreach($file as $img):
                                    if(in_array($img,array('.','..')))
                                        continue;
                                    
                                
                            ?>
                                <div class="d-flex w-100 align-items-center img-item">
                                    <span><img src="<?php echo base_url.$upload_path.'/'.$img."?v=".(strtotime($date_created)) ?>" width="150px" height="100px" style="object-fit:cover;" class="img-thumbnail" alt=""></span>
                                    <span class="ml-4"><button class="btn btn-sm btn-default text-danger rem_img" type="button" data-path="<?php echo base_app.$upload_path.'/'.$img ?>"><i class="fa fa-trash"></i></button></span>
                                </div>
                            <?php endforeach; ?>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-footer text-right">
                <button class="btn btn-sm btn-flat btn-primary" type="submit" form="mobile-form">Save</button>
                <a class="btn btn-sm btn-flat btn-default border" hraf="./?page=mobiles">Cancel</a>
        </div>
    </div>
</div>

<script>
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg3(input,_this) {
		var fnames = [];
		Object.keys(input.files).map(function(k){
			fnames.push(input.files[k].name)

		})
		_this.siblings('.custom-file-label').html(fnames.join(", "))
	}
	$(document).ready(function(){
        $('.summernote').summernote({
		        height: '20vh',
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'insert', [ 'picture', 'video', 'link' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
		$('#mobile-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_mobile",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.replace("./?page=mobiles/view_mobile&id="+resp.mid);
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                    }else{
						alert_toast("An error occured",'error');
                        console.log(resp)
					}
					end_loader();
				}
			})
		})

	})
</script>