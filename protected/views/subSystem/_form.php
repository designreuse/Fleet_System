<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/jquery.form.js');?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'sub-system-form',
	'htmlOptions'=>array('autocomplete'=>'off','enctype' =>'multipart/form-data'),
	'enableAjaxValidation'=>true,
)); ?>


<table>
<tr>
<td>
<b>Car System</b>
</td>
<td>
 <?php echo CHtml::activeDropDownList($model,'system_id',CHtml::listData(System::model()->findAll("is_default=0 AND status=1"),'id','title') ,array('empty' => '--Select Car System--')); ?>
<div id="system_error"></div>
</td>
</tr>

<tr>
<td>
<b>Car Sub System</b>
</td>
<td>
<?php echo $form->textField($model,'title',array('size'=>50,'maxlength'=>50)); ?>
<div id="title_error"></div>
</td>
</tr>

<tr>
<td>
<b>Status</b>
</td>
<td>
<?php echo $form->dropdownlist($model,'status',array(''=>'--Select Status--','1'=>'Active','0'=>'Inactive')); ?>
<div id="status_error"></div>
</td>
</tr>


<tr>
<td></td>
<td>
<input type="hidden" id="current_task" name="current_task" value="<?php if($model->isNewRecord){ echo 'Add';}else{ echo 'Update'; } ?>">
<?php echo $form->hiddenField($model,'id',array('size'=>60,'maxlength'=>200)); ?>
<?php echo CHtml::Button($model->isNewRecord ? 'Add' : 'Update',array('onClick'=>'PostSubSystem()')); ?>
<br>
<span class="preloader_div" id="save_preloader_div"><img src="images/loader.gif" /></span>
<div id="info_frm"></div>
</td>
</tr>
</table>
<?php $this->endWidget(); ?>
</div>


<script language="javascript" type="text/javascript">
highlightMenu('Sub Systems');

function displayError(errorMsg,error_div)
{
	$("#"+error_div).addClass('error').html(errorMsg).show();
	$('body, html').animate({
	scrollTop: $("#"+error_div).offset().top-30
	}, 1200);
	$("#info_frm").removeClass('error').removeClass('success').html('').hide();	
}


function PostSubSystem()
{
	var current_task=$("#current_task").val();
	var SubSystem_system_id=$("#SubSystem_system_id").val();
	var SubSystem_title=$("#SubSystem_title").val();
	var SubSystem_status=$("#SubSystem_status").val();
	
	if(SubSystem_system_id!==""){
		$("#system_error").removeClass('error').html('').hide();
		if(SubSystem_title!==""){
		$("#title_error").removeClass('error').html('').hide();
		if(SubSystem_status!==""){
			$("#status_error").removeClass('error').html('').hide();
			
			/*Start submit the form*/
			$("#save_preloader_div").show();
			$("#sub-system-form").ajaxForm({
			dataType:'html',
			success: function (response){
			$("#save_preloader_div").fadeOut(500);
			try 
			{
			jQuery.parseJSON(response);
			var TRANSACTION_DETAILS = jQuery.parseJSON(response);
			//$("#"+TRANSACTION_DETAILS.field).css('border','1px solid red');
			$("#"+TRANSACTION_DETAILS.error_div).html(TRANSACTION_DETAILS.error).addClass('error').show();
			$('html, body').animate({
			scrollTop: $("#"+TRANSACTION_DETAILS.field).offset().top	
			});	
			} catch(error) {
			if(current_task=='Add'){
			$('#sub-system-form')[0].reset();
			$("#info_frm").addClass('success').removeClass('error').html('Car Sub System successfully added.').show();
			}else if(current_task=='Update'){
			$("#info_frm").addClass('success').removeClass('error').html('Car Sub System successfully updated.').show();
			}
			}
			}
			}).submit();
			/*End submit the form*/					

		}else{
			displayError("Please select the status.","status_error");
		}
	}else{
		displayError("Please enter the car sub system name.","title_error");
	}
	}else{
		displayError("Please select the car system.","system_error");
	}	
}

	


$(document).keypress(function(e) {
		if(e.which == 13) {
			PostSubSystem();
		}
	});

</script>