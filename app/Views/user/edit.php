<?= $this->extend('templates/default') ?>

<?=$this->section('title') ?> Edit <?= $this->endSection() ?>


<?= $this->section('content') ?>

<?php if(session()->has('errors')): ?>
    <div class="container mt-4">
        <ul class="notification is-danger is-light">
            <button class="delete"></button>
    
            <?php foreach(session('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<div class="container my-5 w-50">

    <h1 class="mb-2">Edit User Profile</h1>
    <p class="text-danger mb-5">*Required Field</p>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link <?php if(session('tabs') !== 'editImage' && !session()->has('tabs')): ?>active<?php endif; ?>" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="<?php if(session('tabs') == 'editProfie' || !session()->has('tabs')): ?>true <?php else: ?> false <?php endif; ?>">Edit Profile</button>
            <button class="nav-link <?php if(session('tabs') == 'editImage'): ?> active <?php endif; ?>" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="<?php if(session('tabs') == 'editImage'):?> true <?php else: ?> false <?php endif; ?> " >Edit Profile Image</button>
        </div>
    </nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade <?php if(session('tabs') !== 'editImage' && !session()->has('tabs')): ?>show active<?php endif; ?>" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
        <div class="container my-4">
            <?= form_open('/users/update/'. $user->id) ?>
                <?= $this->include('user/form') ?>
                <div>

                    <button class="btn btn-primary shadow-sm">
                        Update 
                    </button>
                    
                    <a href="<?= site_url('/users/show/' . $user->id) ?>" class="is-link btn-outline-secondary btn">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <div class="tab-pane <?php if(session('tabs') == 'editImage'): ?>show active <?php endif; ?> fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
        <div class="container my-4">
        <?= form_open_multipart('/users/updateImage/'. $user->id) ?>
            <div class="mb-3 text-center card">
                <div class="card-header justify-content-center mb-3">Current Profile Image</div>
                <div class="card-body mb-2">
                    <img src="/uploads/profile_images/<?= $user->profile_image ?>" width="250px" height="250px"  alt="">
                </div>
            </div>
    
            <?= $this->include('user/imageField') ?>
            <div>
                <button class="btn btn-primary">
                    Update 
                </button>
                
                <a href="<?= site_url('/users/show/' . $user->id) ?>" class="is-link btn-outline-secondary btn">Cancel</a>
            </div>
            
        </form>
        </div>
    </div>
    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">...</div>
</div>
   
</div>

<?= $this->endSection() ?>  