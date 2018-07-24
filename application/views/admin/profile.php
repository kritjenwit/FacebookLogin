<div class="row mt-5">
    <div class="col-md-4 text-center mt-3">
        <?php if($this->session->userdata('link')): ?>
            <img src="<?php echo $this->session->userdata('picture') ?>" alt="" class="thumbnail">
        <?php else: ?>
            <img src="<?php echo base_url() ?>assets/images/profile/<?php echo $this->session->userdata('picture') ?>" alt="" class="thumbnail">
        <?php endif; ?>
    </div>
    <div class="col-md-8">
        <?php if($this->session->userdata('link')): ?>
            <input type="hidden" name="id"  value="<?php echo $this->session->userdata('id') ?>">
            <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="" id="" class="form-control" disabled value="<?php echo $this->session->userdata('name') ?>">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" name="" id="" class="form-control" disabled value="<?php echo $this->session->userdata('email') ?>">
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="<?php echo $this->session->userdata('link') ?>">Go to Facebook</a>
            </div>
        <?php else: ?>
            <?php echo form_open('admin/update') ?>
                <input type="hidden" name="id"  value="<?php echo $this->session->userdata('id') ?>">
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" value="<?php echo $this->session->userdata('name') ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" value="<?php echo $this->session->userdata('email') ?>" class="form-control">
                </div>

                <input class="btn btn-warning" type="submit" value="Update" name="update">
            </form>
        <?php endif; ?>
    </div>
</div>