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

    
    <?= form_open('/users/update/'. $user->id) ?>
        <?= $this->include('user/form') ?>

        <button class="btn btn-primary">
            Update 
        </button>
    </form>
</div>

<?= $this->endSection() ?>  