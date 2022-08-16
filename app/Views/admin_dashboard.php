

<?= $this->extend('layouts/admin_main_layout') ?>

<?= $this->section('content') ?>
    <div class="text-light">
        <div><h1><?php echo "NAME: {$first_name} {$last_name}" ?></h1></div>
        <div><h1><?php echo "USER ID : {$user_id}" ?></h1></div>
        <div><h1><?php echo "THEATER ID: {$theater_id}" ?></h1></div>
    </div>
<?= $this->endSection() ?>