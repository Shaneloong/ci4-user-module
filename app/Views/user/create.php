<?= $this->extend('templates/default') ?>

<?= $this->section('title') ?> Create User <?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-3" id="errorNotification">
    <?php if(session()->has('errors') && count(session('errors')) != 0 ): ?>
        <ul class="notification is-danger is-light">
            <button class="delete"></button>
    
            <?php foreach(session('errors') as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<div class="container w-50 mt-4">
    <h1 class="mb-4">Create user</h1>
    <p class="text-danger">*Required Field</p>
    <?= form_open_multipart('/users/create') ?>

        <?= $this->include('user/form') ?>
        <div>

            <button class="btn shadow-sm btn-primary">Create User</button>
            
            <a href="<?= site_url('/') ?>" class="btn shadow-sm btn-outline-secondary">Cancel</a>
        </div>


    </form>
</div>

<script>
    document.getElementById('fileInput').addEventListener('change', function(e) {
        // Get the file name
        var fileName = document.getElementById('fileInput').files[0].name;
        console.log(fileName);

    });

    $()

    $.post('<?= site_url('/users/checkvalidate') ?>', {
            name: 'John',
            email: 'John',
            gender: ''
        },
        function(data, status){
            // console.log(data);
            if(data.length > 0){
                $('#errorNotification').append('<ul class="notification is-danger is-light" id="errorContent"><button class="delete"></button><li>' + value + '</li>');
                jQuery.each(data, function(index, value){
                    $('#errorContent').append('<li>' + value + '</li>');
                })
                $('#errorNotification').append("</ul>");
            }
        }
    )
</script>

<?= $this->endSection() ?>