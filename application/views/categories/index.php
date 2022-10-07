<?php require_once APPPATH . 'views/components/header.php' ?>

<section class="cat-form mb-3">
    <div class="container">
        <div class="cat-form__body">
            <div class="errors"></div>

            <form method="POST" action="/categories" class="form-inline d-flex" id="form-add-cat">
                <input type="text" name="name" class="form-control me-2" placeholder="Add category">
                <button type="submit" class="btn btn-primary">Add</button>
            </form>
        </div>
    </div>
</section>

<section class="cats">
    <div class="container">
        <div class="cats__body">
            <ul class="cats__list list-group position-relative list">
                <span class="position-absolute text-secondary h6 ps-2 no">No categories</span>

                <?php foreach ($categories as $category): ?>

                    <li class="list-group-item list__item d-flex justify-content-between align-items-center">
                        <span><?php echo $category->name ?></span>
                        <a href="/categories/<?php echo $category->id ?>" class="delete" title="deleete">&#10060;</a>
                    </li>

                <?php endforeach ?>
            </ul>
        </div>
    </div>
</section>

<?php require_once APPPATH . 'views/components/footer.php' ?>
