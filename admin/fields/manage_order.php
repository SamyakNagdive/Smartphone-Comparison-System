<style>
    #uni_modal #field-order .item{
        cursor: move;
    }
</style>
<?php
require_once('../../config.php');
$field_qry = $conn->query("SELECT id,category_id,`name` FROM `field_list` where delete_flag = 0 order by `order_by` asc");
$field_arr = [];
while($row = $field_qry->fetch_assoc()){
    $field_arr[$row['category_id']][] = $row;
}
?>
<div class="container-fluid">
    <div class="form-group">
        <label for="category_id" class="control-label">Category</label>
        <select type="text" id="category_id" class="form-control form-control-sm rounded-0 select2" value="<?php echo isset($category_id) ? $category_id : ''; ?>"  required>
            <option value="" disabled <?= !isset($category_id) ? "selected" : "" ?>></option>
            <?php 
            $categories = $conn->query("SELECT * FROM `category_list` where delete_flag = 0 order by `order_by` asc");
            while($row = $categories->fetch_assoc()):
            ?>
            <option value="<?= $row['id'] ?>" <?= isset($category_id) && $category_id == $row['id'] ? "selcted" : "" ?>><?= $row['name'] ?></option>
            <?php endwhile; ?>
        </select>
    </div>
	<form action="" id="field-order-form">
		<ul class="list-group" id="field-order">
        </ul>
	</form>
</div>
<script>
    var fields = $.parseJSON('<?= json_encode($field_arr) ?>');
	$(document).ready(function(){
        $('#uni_modal').on('shown.bs.modal',function(){
			$('#category_id').select2({
				placeholder:'Please Select Category Here',
				width:'100%',
				dropdownParent :$('#uni_modal')
			})
		})
        $('#category_id').change(function(){
            var cid = $(this).val()
            $('#field-order').html('')
            if(!!fields[cid]){
                var cfields = fields[cid]
                Object.keys(cfields).map(k=>{
                    row = cfields[k]
                    var li = $('<li>')
                        li.addClass('item list-group-item')
                        li.append('<input type="hidden" name="id[]" value="'+row.id+'">')
                        li.append('<b><span class="nav-icon mr-2"><i class="fa fa-braille"></i></span>'+row.name+'</b>')
                    $('#field-order').append(li)
                })
            }
        })
        $( "#field-order" ).sortable();
		$('#field-order-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_field_order",
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
						location.reload()
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})

	})
</script>