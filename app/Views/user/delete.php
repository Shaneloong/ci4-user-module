<?= $this->extend('templates/default') ?>

<?= $this->section('title') ?> Delete <?= $this->endSection() ?>

<?= $this->section('content') ?>

    <?= form_open('/users/delete/' . $user->id) ?>
        <div class="container my-5 w-50">
            <h1 class="text-center">Are you sure you want to delete this user?</h1>
            <div class="form-group">
                <button class="btn btn-danger">
                    Yes 
                </button>
                <a href="<?= site_url('/') ?>" class="btn btn-primary">No</a>
            </div>
        </div>
    </form>

<?= $this->endSection() ?>