<?= $this->extend('templates/default') ?>

<?=$this->section('title') ?> Edit <?= $this->endSection() ?>


<?= $this->section('content') ?>
<div class="container my-5 w-50">

    
    <?= form_open('/users/update/'. $user->id) ?>
        <?= $this->include('user/form') ?>

        <button class="btn btn-primary">
            Update 
        </button>
    </form>
</div>

<?= $this->endSection() ?>  