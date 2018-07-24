<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://bootswatch.com/4/lux/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="./assets/js/main.js"></script>
    <title>Document</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?php echo base_url()?>">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav ml-auto">
                <?php if(!$this->session->userdata('logged')): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url() ?>login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo base_url() ?>register">Register</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url() ?>profile"><?php echo $this->session->userdata('name') ?></a>
                    </li>
                    <?php if($this->session->userdata('link')): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url() ?>profile"><img style="width:33px" class="rounded-circle" src="<?php echo $this->session->userdata('picture') ?>" alt=""></a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo base_url() ?>profile"><img style="width:33px" class="rounded-circle" src="<?php echo base_url()?>assets/images/profile/<?php echo $this->session->userdata('picture') ?>" alt=""></a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url() ?>logout">Logout</a>
                    </li>
                <?php endif;?>
            </ul>
        </div>
    </div>
</nav>

<div class="container">

