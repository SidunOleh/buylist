<?php require_once APPPATH . 'views/components/header.php' ?>

<section class="buys">
    <div class="container">
        <div class="buys__body">
            <div class="buys__add">
                <div class="errors"></div>

                <form method="POST" action="/buys" class="mb-4" id="form-add-buy">
                    <div class="form-group mb-2">
                        <input type="text" name="name" class="form-control" placeholder="Enter name">
                    </div>

                    <select class="form-select mb-2" name="category_id">
                        <option selected disabled>Choose category</option>
                        
                        <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                        <?php endforeach ?>
                    </select>

                    <button type="submit" class="btn btn-primary w-100">Add new buy</button>
                </form>
            </div>

            <div class="buys__filters d-flex mb-3">
                <select class="form-select me-2 filter filter-status" name="status">
                    <option selected value="all">Status</option>
                    <option value="bought">Bought</option>
                    <option value="not bought">Not bought</option>
                </select>

                <select class="form-select filter filter-cat" name="category">
                    <option selected value="all">Category</option>
                    
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <ul class="list-group position-relative buys__list list">
                <span class="position-absolute text-secondary h6 ps-2 no">No lists</span>
                
                <?php foreach ($buys as $buy): ?>
                    
                    <li class="list-group-item list__item d-flex justify-content-between align-items-center"
                        status="<?php echo $buy->status ?>" cat-id="<?php echo $buy->category_id ?>">
                        <span><?php echo $buy->name ?></span>
                       
                        <?php if ($buy->status == 'bought'): ?>
                            <span><?php echo $buy->status ?></span>
                        <?php else: ?>
                            <a href="/buys/<?php echo $buy->id ?>" class="not-buy" title="buy"><?php echo $buy->status ?></a>
                        <?php endif ?>
                        
                        <span><?php echo $buy->category_name ?></span>
                        <span><?php echo $buy->created_at ?></span>
                        <a href="/buys/<?php echo $buy->id ?>" class="delete text-end" title="deleete">&#10060;</a>
                    </li>
                
                <?php endforeach ?>
            </ul>
        </div>
    </div>
</section>

<?php require_once APPPATH . 'views/components/footer.php' ?>
