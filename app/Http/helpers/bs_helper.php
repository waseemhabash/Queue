<?php


function bs_input($name,$value = null,$required = false)
{
?>
<div class="form-group">
    <label class="col-sm-1 control-label" for="<?= $name ?>" style="text-align:right">
        <?= __("dashboard.$name") ?>
    </label>
    <div class="col-sm-6">
        <input type="text" name="<?= $name ?>" placeholder='<?= __("dashboard.$name") ?>' id="<?= $name ?>" class="form-control"
            <?=$required ? 'required' : '' ?> value="
        <?= old($name) ?? $value ?? ''  ?>">
    </div>
</div>

<?php    
}



function bs_date($name,$value = null,$required = false)
{
?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?= $name ?>" style="text-align:right">
        <?= __("dashboard.$name") ?>
    </label>
    <div class="col-sm-6">
        <input type="date" name="<?= $name ?>" placeholder='<?= __("dashboard.$name") ?>' id="<?= $name ?>" class="form-control"
            <?=$required ? 'required' : '' ?> value='
        <?= old($name) ?? $value ?? ""  ?>'>
    </div>
</div>

<?php    
}


function bs_number($name,$value = null,$required = false)
{
?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?= $name ?>" style="text-align:right">
        <?= __("dashboard.$name") ?>
    </label>
    <div class="col-sm-6">
        <input type="number" name="<?= $name ?>" placeholder='<?= __("dashboard.$name") ?>' id="<?= $name ?>" class="form-control"
            <?=$required ? 'required' : '' ?> value='
        <?= old($name) ?? $value ?? ""  ?>'>
    </div>
</div>

<?php    
}






function bs_text($name,$value = null,$required = false)
{
?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?= $name ?>" style="text-align:right">
        <?= __("dashboard.$name") ?>
    </label>
    <div class="col-sm-6">
        <textarea name="<?= $name ?>" placeholder='<?= __("dashboard.$name") ?>' class="form-control ckeditor" <?=$required
            ? 'required' : '' ?> ><?= old($name) ?? $value ?? ""  ?></textarea>
    </div>
</div>

<?php    
}







function bs_image($name,$value = null,$required = false)
{
?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?= $name ?>" style="text-align:right">
        <?= __("dashboard.$name") ?>
    </label>
    <div class="col-sm-6">
        <input type="file" accept="image/*" name="<?= $name ?>" id="<?= $name ?>" class="form-control" <?=$required ?
            'required' : '' ?> >
    </div>
</div>

<?php if($value): ?>
<div class="form-group">
    <label class="col-sm-1 control-label" for="<?= $name ?>" style="text-align:right">
    </label>
    <div class="col-sm-6">
        <img src="<?= url('/'.$value) ?>" width="50%">
    </div>
</div>
<?php endif;?>

<?php    
}




function bs_video($name,$value = null,$required = false)
{
?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?= $name ?>" style="text-align:right">
        <?= __("dashboard.$name") ?>
    </label>
    <div class="col-sm-6">
        <input type="file" accept="video/*" name="<?= $name ?>" id="<?= $name ?>" class="form-control" <?=$required ?
            'required' : '' ?> >
    </div>
</div>

<?php if($value): ?>
<div class="form-group">
    <label class="col-sm-1 control-label" for="<?= $name ?>" style="text-align:right">
    </label>
    <div class="col-sm-6">
        <video width="50%" controls>
            <source src="<?= url('/'.$value) ?>">
        </video>
    </div>
</div>
<?php endif;?>

<?php    
}




function bs_multiple_files($name,$value = null,$required = false)
{
?>

<div class="form-group">
    <label class="col-sm-1 control-label" for="<?= $name ?>" style="text-align:right">
        <?= __("dashboard.$name") ?>
    </label>
    <div class="col-sm-6">
        <input type="file" accept="video/*" name="<?= $name ?>" id="<?= $name ?>" class="form-control" <?=$required ?
            'required' : '' ?> >
    </div>
</div>



<?php    
}




function alert_box($type,$value,$with_circle = false)
{
?>

<div class="alert alert-<?= $type?>">
    <?php if($with_circle):?>
    <button data-dismiss="alert" class="close">
        ×
    </button>
    <?php endif;?>
    <i class="fa fa-check-circle"></i>
    <?= $value?>
</div>


<?php    
}
