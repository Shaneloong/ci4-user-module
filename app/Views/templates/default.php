<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    
    <!-- bulma CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.4/css/bulma.min.css" integrity="sha512-HqxHUkJM0SYcbvxUw5P60SzdOTy/QVwA1JJrvaXJv4q7lmbDZCmZaqz01UPOaQveoxfYRv1tHozWGPMcuTBuvQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- BootStrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <link rel="stylesheet" href="<?= site_url('/css/auto-complete.css') ?>">

    <title><?= $this->renderSection('title') ?></title>
</head>
<body class="mb-5">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid mx-5">
    <a class="navbar-brand" style="min-height: 0;" href="<?= site_url('/') ?>">User</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarContent">
      <ul class="navbar-nav ms-auto me-5 mb-2 mb-lg-0">
        <li class="nav-item mx-3">
          <a class="nav-link" aria-current="page" href="<?= site_url('/') ?>">Home</a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('/users/new') ?>" class="nav-link">Create User</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <?php if(session()->has('info')): ?>
      <div class="container mt-4 mb-2">

        <div class="notification is-info is-light">
          <button class="delete"></button>
          <?= session('info') ?>
        </div>
      </div>

    <?php endif; ?>

    <?php if(session()->has('warning')): ?>
      <div class="container mt-4 mb-2">

        <div class="notification is-warning is-light">
          <button class="delete"></button>
          <?= session('warning') ?>
        </div>
      </div>

    <?php endif; ?>

    <?php if(session()->has('error')): ?>
      <div class="container mt-4 mb-2">

        <div class="notification is-danger is-light">
          <button class="delete"></button>
          <?= session('error') ?>
        </div>
      </div>

    <?php endif; ?>

    <?php if(session()->has('success')): ?>
      <div class="container mt-4 mb-2">

        <div class="notification is-primary is-light">
          <button class="delete"></button>
          <?= session('success') ?>
        </div>
      </div>

    <?php endif; ?>

    <?= $this->renderSection('content') ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tarekraafat-autocomplete.js/10.2.7/autoComplete.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                const $notification = $delete.parentNode;

                $delete.addEventListener('click', () => {
                    $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>
</body>
</html>