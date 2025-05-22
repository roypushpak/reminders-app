<?php require_once 'app/views/templates/header.php' ?>
<div class="container">
    <div class="page-header" id="banner">
        <div class="row">
            <div class="col-lg-12 text-center">
                    <h1 class="display-5 text-center">You are at a secret page!</h1>
                <h1> <?=$_SESSION['username'] ?>, SHH!</h1> 
                <h3>Click "Home" to return.</h3>
                <p class="lead"> <?= date("F jS, Y"); ?></p>
            </div>
        </div>
    </div>

    <?php require_once 'app/views/templates/footer.php' ?>
