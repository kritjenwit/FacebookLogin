<div class="row mt-5">
    <div class="col-md-4 text-center mt-3">
        <img src="<?php echo $this->session->userdata('picture') ?>" alt="" class="thumbnail">
    </div>
    <div class="col-md-8">
        <?php if($this->session->userdata('link')): ?>
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="" id="" class="form-control" disabled value="<?php echo $this->session->userdata('name') ?>">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="" id="" class="form-control" disabled value="<?php echo $this->session->userdata('email') ?>">
            </div>
            <div class="form-group">
<!--                <input type="text" name="" id="" class="form-control" disabled value="--><?php //echo $this->session->userdata('link') ?><!--">-->
                <a class="btn btn-primary" href="<?php echo $this->session->userdata('link') ?>">Go to Facebook</a>
            </div>
        <?php else: ?>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="email" id="" value="<?php echo $this->session->userdata('email') ?>">
            </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="email" id="" value="<?php echo $this->session->userdata('password') ?>">
            </div>
        <?php endif; ?>
    </div>
</div>