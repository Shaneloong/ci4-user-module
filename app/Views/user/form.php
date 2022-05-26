<div class="mb-3">
    <label for="name" class="form-label">Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control shadow-sm" name="name" id="name" value="<?= esc(old('name', $user->name)) ?>">
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
    <input type="text" class="form-control shadow-sm" name="email" id="email" value="<?= esc(old('email', $user->email)) ?>">
</div>

<div class="mb-4">
    <label for="floatingTextarea" class="form-label">Profile Bio <?php if(strpos(current_url(), 'new')): ?>
    (optional)
<?php endif; ?></label>
    <textarea class="form-control shadow-sm" name="profile_description" placeholder="" id="floatingTextarea"><?= esc(old('profile_description', $user->profile_description)) ?></textarea>
</div>

<p  class="form-label">Gender <span class="text-danger">*</span></p>

<div class="form-check form-check-inline mb-3">
    <input class="form-check-input" name="gender" type="radio" value="male" 
    <?php if(old('gender', $user->gender)=== 'male' ): ?> checked <?php endif; ?> id="male">
    <label class="form-check-label" for="male">
        Male
    </label>
</div>


<div class="form-check form-check-inline mb-3">
    <input class="form-check-input" name="gender" type="radio" value="female" 
    <?php if(old('gender', $user->gender) === 'female'): ?> checked <?php endif; ?> id="female">
    <label class="form-check-label" for="female">
        Female
    </label>
</div>

<?php if(strpos(current_url(), 'new')): ?>
    <?= $this->include('user/imageField') ?>
<?php endif; ?>
