<?= $this->extend('templates/default') ?>

<?= $this->section('title') ?> Create User <?= $this->endSection() ?>

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

<div class="container w-50 mt-4">
    <h1 class="mb-4">Create user</h1>
    <?= form_open_multipart('/users/create') ?>

        <?= $this->include('user/form') ?>

        <button class="btn btn-primary">Create User</button>


    </form>
</div>

<?= $this->endSection() ?>