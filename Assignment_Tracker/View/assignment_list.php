<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php include('view/header.php') ?>
        <!<!-- between header and footer -->
        <section id="list" class="list">
            <header class="list__row list__header">
                <h1>
                    Assignments
                </h1>
                <form action="." method="get" id="list__header_select" class="list__header_select">
                    <input type="hidden" name="action" value="list_assignments">
                    <select name="category_id" required>
                        <option value="0">View All</option>
                        <?php foreach ($categories as $category) : ?>
                            <?php if ($category_id == $category['category_id']) { ?>
                        <!<!-- what category selected and what assignments are displayed -->
                                <option value="<?= $category['category_id'] ?>" selected>
                                <?php } else { ?>
                                <option value="<?= $category['category_id'] ?>">
                                <?php } ?>
                                <?= $category['category_name'] ?>
                            </option>
                        <?php endforeach; //for each loop?>
                    </select>
                    <button class="add-button bold">Go</button>
                </form>
            </header>
            <?php if ($assignments) { ?>
                <?php foreach ($assignments as $assignment) : ?>
                    <div class="list__row">
                        <div class="list__item">
                            <p class="bold"><?= "{$assignment['category_name']}" ?></p>
                            <p><?= $assignment['description']; ?></p>
                        </div>
                        <div class="list__removeItem">
                            <form action="." method="post">
                                <input type="hidden" name="action" value="delete_assignment">
                                <input type="hidden" name="assignment_id" value="<?= $assignment['id']; ?>">
                                <button class="remove-button">❌</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } else { ?>
                <br>
                <?php if ($category_id) { ?>
                    <p>No assignments exist for this category yet.</p>
                <?php } else { ?>
                    <p>No assignments exist yet.</p>
                <?php } ?>
                <br>
            <?php } ?>
        </section>

        <section id="add" class="add">
            <h2>Add Assignment</h2>
            <form action="." method="post" id="add__form" class="add__form">
                <input type="hidden" name="action" value="add_assignment">
                <div class="add__inputs">
                    <label>category:</label>
                    <select name="category_id" required>
                        <option value="">Please select</option>
                        <?php foreach ($categories as $category) : ?>
                            <option value="<?= $category['category_id']; ?>">
                                <?= $category['category_name']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <label>Description:</label>
                    <input type="text" name="description" maxlength="120" placeholder="Description" required>
                </div>
                <div class="add__addItem">
                    <button class="add-button bold">Add</button>
                </div>
            </form>
        </section>
        <br>
        <p><a href=".?action=list_categories">View/Edit Categories</a></p>
        <?php include('view/footer.php') ?>
    </body>
</html>
