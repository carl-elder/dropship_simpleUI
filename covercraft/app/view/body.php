<?php
$controls = new Controls();
$table = new Table();
?>
<header class="container">
    <div class="row">
        <h1>Sporty's Covercraft Orders</h1>
    </div>
</header>
<div class="container">
    <div class="row">
        <div class="btn-toolbar" role="toolbar" aria-label="Table Controls">
            <?php
                $controls->printInputs();
                $controls->printControls();
                $controls->printPagination();
            ?>
        </div>
    </div>
    <div class="row">
        <?php echo $table->printTable(); ?>
    </div>
    <div class="row">

    </div>
</div>