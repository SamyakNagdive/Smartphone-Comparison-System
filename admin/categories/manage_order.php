<style>
    #uni_modal #cat-order .item{
        cursor: move;
    }
</style>
<?php
require_once('../../config.php');
?>
<div class="container-fluid">
	<form action="" id="cat-order-form">
		<ul class="list-group" id="cat-order">
            <?php 
            $qry = $conn->query("SELECT * FROM `category_list` where delete_flag = 0 order by order_by asc ");
            while($row = $qry->fetch_assoc()):
            ?>
            <li class="list-group-item item">
                <input type="hidden" name="id[]" value="<?= $row['id'] ?>">
                <b><span class="nav-icon mr-2"><i class="fa fa-braille"></i></span><?= $row['name'] ?></b>
            </li>
            <?php endwhile; ?>
        </ul>
	</form>
</div>
<script>
	$(document).ready(function(){
        $( "#cat-order" ).sortable();
		$('#cat-order-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_category_order",
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