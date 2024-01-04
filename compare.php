
<style>
    .carousel-item>img{
        object-fit:fill !important;
    }
    #carouselExampleControls .carousel-inner{
        height:280px !important;
    }
    .mob-img{
        width:100%;
        max-height:20vh;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<?php 
extract($_GET);
$data = [];
$mqry = $conn->query("SELECT * FROM mobile_list where id in (".(implode(",",$mobile)).")");
while($mrow = $mqry->fetch_assoc()){
    $meta_qry = $conn->query("SELECT * FROM mobile_meta where mobile_id = '{$mrow['id']}'");
    $meta = array_column($meta_qry->fetch_all(MYSQLI_ASSOC),'meta_value','field_id');
    $mrow['meta'] = $meta;
    $data[]=$mrow;
}
?>
<section class="py-0">
    <div class="container">
        <div class="col-lg-12 py-2">

            <table class="table table-bordered" id="compare-tbl">
                <colgroup>
                    <col width="20%">
                    <col width="40%">
                    <col width="40%">
                </colgroup>
                <tr>
                    <td rowspan="2" class="text-center align-middle"><h3><b>Comparison Result</b></h3></td>
                    <?php foreach($data as $k => $v): ?>
                    <td class="text-center">
                        <img src="<?=  $v['thumbnail_path'] ?>" class="mob-img" alt="">
                    </td>
                    <?php endforeach ?>
                </tr>
                <tr>
                    <?php foreach($data as $k => $v): ?>
                    <td class="text-center">
                        <h4><b><?=  $v['brand']." " . $v['model'] ?></b></h4>
                    </td>
                    <?php endforeach ?>
                </tr>
               <?php 
                $categories = $conn->query("SELECT * FROM `category_list` where delete_flag = 0 order by `order_by` asc");
                while($crow = $categories->fetch_assoc()):
               ?>
                <tr>
                    <th colspan = '<?= count($data) + 1 ?>' class="text-center bg-gradient-gray"><b><?= $crow['name'] ?></b></th>
                </tr>
                    <?php 
                    $field_qry = $conn->query("SELECT * FROM `field_list` where category_id = '{$crow['id']}' and delete_flag = 0 order by `order_by` asc");
                    while($frow = $field_qry->fetch_assoc()):
                    ?>
                        <tr>
                            <td><b><?= $frow['name'] ?></b></td>
                            <?php foreach($data as $k => $v): ?>
                            <td class="">
                                <?= isset($v['meta'][$frow['id']]) ? $v['meta'][$frow['id']] : "N/A" ?>
                            </td>
                            <?php endforeach ?>
                        </tr>
                    <?php endwhile; ?>
               <?php 
               endwhile;
               ?>
            </table>
               
        </div>
    </div>
    </div>
</section>