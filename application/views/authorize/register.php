<div class="row mt-5">
    <div class="col-lg-6 offset-lg-3">
        <div class="card-header">
            <h4 class="text-center mt-3"><?php echo $title ?></h4>
            <?php if(validation_errors()) :?>
                <div class="alert alert-danger">
                    <?php echo validation_errors() ?>
                </div>
            <?php endif; ?>
            <?php  echo form_open_multipart('/register')?>

                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="name" class="form-control" placeholder="eg. John Doe" minle>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" placeholder="eg. example@example.com" minle>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password"  class="form-control" placeholder="eg. password">
                </div>
                <div class="form-group">
                    <label for="">Picture</label>
                    <input type="file" name="userfile" class="form-control">
                </div>
                <input type="submit" value="Register" class="btn btn-success btn-block" name="register">
            <?php echo '</form>' ?>
            <br>
            <div class="text-center">
                <a href="<?php echo  base_url()?>login">Already had account. Login here</a><br><br>
            </div>
        </div>
    </div>
</div>