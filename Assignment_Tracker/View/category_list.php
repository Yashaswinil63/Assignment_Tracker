<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php include('header.php') ;
 ?>

<?php if($categories) { ?>

<section id="list" class="list">
    <header class="list__row list__header">
        <h1>
            Category List
        </h1>
    </header>

    <?php foreach ($categories as $category) : ?>
    <div class="list__row">
        <div class="list__item">
            <p class="bold"><?= $category['category_name'] ?></p>
        </div>
        <div class="list__removeItem">
            <form action="." method="post">
                <input type="hidden" name="action" value="delete_category">
                <input type="hidden" name="category_id" value="<?= $category['category_id']; ?>">
                <button class="remove-button">❌</button>
            </form>
        </div>
    </div>
    <?php endforeach; ?>
</section>
<?php } else { ?>
<p>No categories exist yet.</p>
<?php } ?>

<section id="add" class="add">
    <h2>Add Category</h2>
    <form action="." method="post" id="add__form" class="add__form">
        <input type="hidden" name="action" value="add_category">
        <div class="add__inputs">
            <label>Name:</label>
            <input type="text" name="category_name" maxlength="30" placeholder="Name" autofocus required>
        </div>
        <div class="add__addItem">
            <button class="add-button bold">Add</button>
        </div>
    </form>
</section>

<br>
<p><a href=".">View &amp; Add Assignments</a></p>

<?php include('footer.php') ?>