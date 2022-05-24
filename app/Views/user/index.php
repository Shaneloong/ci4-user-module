<?= $this->extend('templates/default.php') ?> 

<?= $this->section('title') ?> Users <?= $this->endSection() ?>

<?= $this->section('content') ?> 


<section>
    <div class="container my-5">
        <div class="field w-25">
            <label class="form-label" for="query">Search</label>
            <input class="form-control" type="text" name="search" id="search">
        </div>
    </div>

    <div class="container my-5">
        <table class="table table-responsive table-hover align-middle table-striped">
            <thead>
                <th>Username</th>
                <th>Email</th>
                <th>Admin Availability</th>
                <th>Created at</th>
                <th>Action</th>
            </thead>
            <?php if($users): ?>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td>
                            <a href="<?= site_url('/users/show/' . $user->id) ?>">
                                <?= $user->name ?>
                            </a>
                        </td>
                        <td><?= $user->email ?></td>
                        <td><?= $user->is_admin ? 'Yes' : 'No' ?></td>
                        <td><?= $user->created_at ?></td>
                        <td>
                            <a href="<?= site_url('/users/edit/'.$user->id) ?>" class="btn btn-primary">Edit <i class="uil uil-edit-alt"></i></a>
                            <a href="<?= site_url('/users/delete/' . $user->id) ?>" class="btn btn-danger" >Delete <i class="uil uil-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</section>


<script src="<?= site_url('/js/auto-complete.min.js') ?>"></script>
<script>
    var searchURL = "<?= site_url('/users/search?keyword=') ?>";

    var showURL = "<?= site_url('/users/show/') ?>";
    var data;
    var i;

    var searchAutoComplete = new autoComplete({
        selector: 'input[name="search"]',
        cache: false,
        source: function(term, response){
            var request = new XMLHttpRequest();

            request.open("GET", searchURL + term, true);

            request.onload = function(){

                data = JSON.parse(this.response);
                i=0;
                var suggestions = data.map(user => user.name);

                response(suggestions);

            }

            request.send();
        },
        renderItem: function(item, search){
            var id = data[i].id;
            i++;
            return '<div class="autocomplete-suggestion" data-id="' + id + '">' + item + '</div>';
        },
        onSelect: function(e, term, item){
            window.location.href = showURL + item.getAttribute('data-id');
        }
    });
</script>


<?= $this->endSection() ?>

