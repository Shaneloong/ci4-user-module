<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input type="text" class="form-control" name="name" id="name" value="<?= esc(old('name', $user->name)) ?>">
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" name="email" id="email" value="<?= esc(old('email', $user->email)) ?>">
</div>

<div class="mb-4">
    <label for="floatingTextarea" class="form-label">Profile Bio</label>
    <textarea class="form-control" name="profile_description" placeholder="" id="floatingTextarea"><?= esc(old('profile_description', $user->profile_description)) ?></textarea>
</div>

<?php if(strpos(current_url(), 'new')): ?>
    <?= $this->include('user/imageField') ?>
<?php endif; ?>

<div class="form-check mb-3">
    <input class="form-check-input" name="is_admin" type="checkbox" value="1" 
    <?php if(old('is_admin', $user->is_admin)): ?> checked <?php endif; ?> id="flexCheckDefault">
    <label class="form-check-label" for="flexCheckDefault">
        Admin
    </label>
</div>