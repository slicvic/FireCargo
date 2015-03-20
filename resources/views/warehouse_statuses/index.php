<div class="row">
    <h3><i class="fa fa-info-circle"></i> Warehouse Statuses</h3>
    <hr>
</div>

<div class="row filter-block">
    <div class="col-md-12">
        <div class="">
            <a href="/statuses/create" class="btn-flat primary">
                <i class="fa fa-plus"></i>
                New
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="datatable table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($statuses as $status): ?>
                   <tr>
                        <td><?php echo $status->id; ?></td>
                        <td><?php echo $status->name; ?></td>
                        <td><a href="/statuses/edit/<?php echo $status->id; ?>" class="btn-flat icon"><i class="fa fa-pencil"></i></a></td>
                   </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
$(function() {
    $('table').dataTable();
});
</script>
