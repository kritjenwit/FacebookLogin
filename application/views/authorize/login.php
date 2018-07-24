<div class="row mt-5">
    <div class="col-lg-6 offset-lg-3">
        <div class="card-header">
            <h4 class="text-center mt-3"><?php echo $title ?></h4>
            <?php if(validation_errors()) :?>
                <div class="alert alert-danger">
                    <?php echo validation_errors() ?>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('user_registered')): ?>
                <div class="alert alert-success">
                    <?php echo $this->session->flashdata('user_registered') ?>
                </div>
            <?php endif; ?>
            <?php if($this->session->flashdata('login_failed')): ?>
                <div class="alert alert-danger">
                    <?php echo $this->session->flashdata('login_failed') ?>
                </div>
            <?php endif; ?>
            <?php  echo form_open('/login')?>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" class="form-control" placeholder="eg. example@example.com">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password"  class="form-control" placeholder="eg. password">
            </div>
            <input type="submit" value="Login" class="btn btn-success btn-block" name="register">
            <?php echo '</form>' ?>
            <div class="text-center">
                <?php echo $url ?><br><br>
                <a href="">No account yet!. Register here</a>
            </div>
        </div>
    </div>
</div>