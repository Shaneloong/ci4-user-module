<?= $this->extend('templates/default') ?>

<?= $this->section('title') ?> Edit Profile Image <?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container w-50 my-5">

    <h1 class="mb-4">Edit Profile Image</h1>
    
    <?= form_open_multipart('/users/updateImage/'. $user->id) ?>
    
        <?= $this->include('user/imageField') ?>
        
        <button class="btn btn-primary">
            Update 
        </button>
        
    </form>

</div>

<?= $this->endSection() ?>