<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function delete_img(){
		extract($_POST);
		if(is_file($path)){
			if(unlink($path)){
				$resp['status'] = 'success';
			}else{
				$resp['status'] = 'failed';
				$resp['error'] = 'failed to delete '.$path;
			}
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = 'Unkown '.$path.' path';
		}
		return json_encode($resp);
	}
	function save_category(){
		if(empty($_POST['id'])){
			$order_by = $this->conn->query("SELECT order_by from `category_list` where delete_flag = 0 order by `order_by` desc limit 1");
			$order_by = $order_by->num_rows > 0 ? $order_by->fetch_array()[0] : 0;
			$_POST['order_by'] = $order_by +1;
		}
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string(trim($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `category_list` where `name` = '{$name}' and delete_flag = 0 ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Category Name already exists.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `category_list` set {$data} ";
		}else{
			$sql = "UPDATE `category_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$bid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Category successfully saved.";
			else
				$resp['msg'] = " Category successfully updated.";
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_category(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `category_list` set `delete_flag` = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Category successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_category_order(){
		extract($_POST);
		$data = "";
		foreach($id as $k => $v){
			if(!empty($data)) $data .= ", ";
			$data .= "('$v','{$k}')";
		}
		$sql = "INSERT INTO `category_list` (`id`,`order_by`) VALUES {$data} ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `order_by` = VALUES(`order_by`)";
		$update = $this->conn->query($sql);
		if($update){
			$resp['status'] = 'success';
			$resp['msg'] = " Category Orders has been updated successfully.";
		}else{
			$resp['status'] = 'success';
			$resp['msg'] = " Category Orders has failed to update.";
			$resp['error'] = $this->conn->error;
			$resp['sql'] = $sql;
		}
		if($resp['status'] == 'success'){
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
		}
	}
	function save_field(){
		if(empty($_POST['id'])){
			$order_by = $this->conn->query("SELECT order_by from `field_list` where delete_flag = 0 and category_id = '{$_POST['category_id']}' order by `order_by` desc limit 1");
			$order_by = $order_by->num_rows > 0 ? $order_by->fetch_array()[0] : 0;
			$_POST['order_by'] = $order_by +1;
		}
		extract($_POST);
		$data = "";
		foreach($_POST as $k =>$v){
			if(!in_array($k,array('id'))){
				if(!empty($data)) $data .=",";
				$v = $this->conn->real_escape_string(trim($v));
				$data .= " `{$k}`='{$v}' ";
			}
		}
		$check = $this->conn->query("SELECT * FROM `field_list` where `name` = '{$name}' and delete_flag = 0 and category_id = '{$category_id}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Field Name already exists in the selected Category.";
			return json_encode($resp);
			exit;
		}
		if(empty($id)){
			$sql = "INSERT INTO `field_list` set {$data} ";
		}else{
			$sql = "UPDATE `field_list` set {$data} where id = '{$id}' ";
		}
			$save = $this->conn->query($sql);
		if($save){
			$bid = !empty($id) ? $id : $this->conn->insert_id;
			$resp['status'] = 'success';
			if(empty($id))
				$resp['msg'] = "New Field successfully saved.";
			else
				$resp['msg'] = " Field successfully updated.";
			
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		if($resp['status'] == 'success')
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
	}
	function delete_field(){
		extract($_POST);
		$del = $this->conn->query("UPDATE `field_list` set `delete_flag` = 1 where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," Field successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
	function save_field_order(){
		extract($_POST);
		$data = "";
		foreach($id as $k => $v){
			if(!empty($data)) $data .= ", ";
			$data .= "('$v','{$k}')";
		}
		$sql = "INSERT INTO `field_list` (`id`,`order_by`) VALUES {$data} ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `order_by` = VALUES(`order_by`)";
		$update = $this->conn->query($sql);
		if($update){
			$resp['status'] = 'success';
			$resp['msg'] = " Field Orders has been updated successfully.";
		}else{
			$resp['status'] = 'success';
			$resp['msg'] = " Field Orders has failed to update.";
			$resp['error'] = $this->conn->error;
			$resp['sql'] = $sql;
		}
		if($resp['status'] == 'success'){
			$this->settings->set_flashdata('success',$resp['msg']);
			return json_encode($resp);
		}
	}
	function save_mobile(){
		$_POST['display_content'] = htmlentities($_POST['display_content']);
		extract($_POST);
		$mobile_allowed_fields = ["model","brand","display_content","status"];
		$data = "";
		foreach($_POST as $k =>$v){
			if(in_array($k,$mobile_allowed_fields)){
				if(!empty($data)) $data .=",";
				$data .= " `{$k}`='{$this->conn->real_escape_string($v)}' ";
			}
		}
		if(empty($id)){
			$sql = "INSERT INTO `mobile_list` set {$data} ";
		}else{
			$sql = "UPDATE `mobile_list` set {$data} where id = '{$id}' ";
		}
		$save = $this->conn->query($sql);
		if($save){
			$mid = empty($id) ? $this->conn->insert_id : $id;
			$resp['mid'] = $mid;
			$upload_path = "uploads/mobile_".$mid;
			if(empty($id))
				$resp['msg'] = " New Smart Phone successfully added.";
			else
				$resp['msg'] = " Smart Phone Details has been updated successfully.";
			$resp['status'] = 'success';
			if(!is_dir(base_app.$upload_path))
				mkdir(base_app.$upload_path);
			if(isset($_FILES['imgs']) && count($_FILES['imgs']['tmp_name']) > 0){
				$err = "";
				foreach($_FILES['imgs']['tmp_name'] as $k => $v){
					if(!empty($_FILES['imgs']['tmp_name'][$k])){
						$accept = array('image/jpeg','image/png');
						if(!in_array($_FILES['imgs']['type'][$k],$accept)){
							$err = "Image file type is invalid";
							break;
						}
						if($_FILES['imgs']['type'][$k] == 'image/jpeg')
							$uploadfile = imagecreatefromjpeg($_FILES['imgs']['tmp_name'][$k]);
						elseif($_FILES['imgs']['type'][$k] == 'image/png')
							$uploadfile = imagecreatefrompng($_FILES['imgs']['tmp_name'][$k]);
						if(!$uploadfile){
							$err = "Image is invalid";
							break;
						}
						list($width,$height) = getimagesize($_FILES['imgs']['tmp_name'][$k]);
						$temp = imagescale($uploadfile,$width,$height);
						$spath = base_app.$upload_path.'/'.$_FILES['imgs']['name'][$k];
						$i = 0;
						while(true){
							if(is_file($spath)){
								$spath = base_app.$upload_path.'/'.$i."_".$_FILES['imgs']['name'][$k];
							}else{
								break;
							}
							$i++;
						}
						if($_FILES['imgs']['type'][$k] == 'image/jpeg')
						imagejpeg($temp, $spath);
						elseif($_FILES['imgs']['type'][$k] == 'image/png')
						imagepng($temp, $spath);

						imagedestroy($temp);
					}
				}
				if(!empty($err)){
					$resp['msg'] .= " But ".$err;
				}
			}
			if(!empty($_FILES['img']['tmp_name'])){
				$err = "";
				if(!is_dir(base_app."uploads/thumbnails")){
					mkdir(base_app."uploads/thumbnails");
				}
				$accept = array('image/jpeg','image/png');
				if(!in_array($_FILES['img']['type'],$accept)){
					$err = "Image file type is invalid";
				}
				$ext = pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION);
				$fname = "uploads/thumbnails/$mid.$ext";
				if($_FILES['img']['type'] == 'image/jpeg')
					$uploadfile = imagecreatefromjpeg($_FILES['img']['tmp_name']);
				elseif($_FILES['img']['type'] == 'image/png')
					$uploadfile = imagecreatefrompng($_FILES['img']['tmp_name']);
				if(!$uploadfile){
					$err = "Image is invalid";
				}
				list($width,$height) = getimagesize($_FILES['img']['tmp_name']);
				$temp = imagescale($uploadfile,$width,$height);
				if(is_file(base_app.$fname))	
					unlink(base_app.$fname);			
				if($_FILES['img']['type'] == 'image/jpeg')
					$uploaded = imagejpeg($temp, base_app.$fname);
				elseif($_FILES['img']['type'] == 'image/png')
					$uploaded = imagepng($temp, base_app.$fname);
				else
					$uploaded = false;
				if($uploaded){
					$this->conn->query("UPDATE `mobile_list` set thumbnail_path = concat('{$fname}','?v=',unix_timestamp(CURRENT_TIMESTAMP)) where id = '{$mid}' ");
				}

				imagedestroy($temp);
				if(!empty($err)){
					$resp['msg'] .= " But ".$err;
				}
			}
			$data="";
			foreach($field_id as $k =>$v){
				if(!empty($data)) $data .=", ";
				$field_value = $this->conn->real_escape_string($v);
				$data .= "('{$mid}', '{$k}', '{$field_value}')";
			}
			if(!empty($data)){
				$this->conn->query("DELETE FROM `mobile_meta` where `mobile_id` = '{$mid}'");
				$sql2 = "INSERT INTO `mobile_meta` (`mobile_id`, `field_id`, `meta_value`) VALUES {$data}";
				$save2 = $this->conn->query($sql2);
				if(!$save2){
					$resp['status'] = 'failed';
					$resp['msg'] = " Saving Real mobile Data failed.";
					$resp['err'] = $this->conn->error;
					$resp['sql'] = $sql2;
					if(empty($id))
					$this->conn->query("DELETE FROM `mobile_list` where id = '{$mid}'");
				}
			}
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	function delete_mobile(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM `mobile_list` where id = '{$id}'");
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success'," mobile successfully deleted.");
			if(is_dir(base_app."uploads/mobile_".$id)){
				$fopen = scandir(base_app."uploads/mobile_".$id);
				foreach($fopen as $file){
					if(!in_array($file,[".",".."])){
						unlink(base_app."uploads/mobile_".$id."/".$file);
					}
				}
				rmdir(base_app."uploads/mobile_".$id);
			}
			
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}
}

$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'delete_img':
		echo $Master->delete_img();
	break;
	case 'save_category':
		echo $Master->save_category();
	break;
	case 'delete_category':
		echo $Master->delete_category();
	break;
	case 'save_category_order':
		echo $Master->save_category_order();
	break;
	case 'save_field':
		echo $Master->save_field();
	break;
	case 'delete_field':
		echo $Master->delete_field();
	break;
	case 'save_field_order':
		echo $Master->save_field_order();
	break;
	case 'save_mobile':
		echo $Master->save_mobile();
	break;
	case 'delete_mobile':
		echo $Master->delete_mobile();
	break;
	default:
		// echo $sysset->index();
		break;
}