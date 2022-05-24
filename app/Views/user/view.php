<?= $this->extend('templates/default.php') ?> 

<?= $this->section('title') ?> Users <?= $this->endSection() ?>

<?= $this->section('content') ?> 
<div class="container mt-5">

    
    <div class="p-5 mb-4 bg-secondary rounded-3">
        <div class="container-fluid py-5">
            <div class="row row-cols-2">
                <div class="col">
                    <h1 class="display-5 fw-bold text-white"><?= $user->name ?></h1>
                    <p class="text-white"><?= $user->email ?></p>
                    <p class="col-md-8 fs-4 text-white"><?= $user->profile_description ?></p>
                    <p class="badge bg-dark text-white p-2 fs-5"><?= $user->is_admin ? "Admin" : "Member" ?></p>
                    <div>
                        <a href="<?= site_url('/users/edit/' . $user->id) ?>" class="btn btn-primary btn-lg" type="button">Edit Profile</a>
                        <a href="<?= site_url('/users/editImage/' . $user->id) ?>" class="btn btn-primary btn-lg" type="button">Edit Profile Image</a>
                    </div>
                </div>
                <div class="col">
                    <img src="/uploads/profile_images/<?= $user->profile_image ?>" class="w-75" alt="Profile Image">
                </div>
            </div>
            
        </div>
    </div>
</div>

<?= $this->endSection() ?>