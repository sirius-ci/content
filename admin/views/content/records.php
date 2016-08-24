
<?php echo $this->utils->alert(); ?>

<div class="panel panel-default">
    <div class="panel-heading"><i class="fa fa-table"></i> <?php echo $this->moduleTitle ?></div>
    <div class="panel-toolbar clearfix">
        <div class="row">
            <div class="col-md-4">
                <?php if ($this->permission('delete')): ?>
                    <a class="btn btn-sm btn-info checkall" data-toggle="button"><i class="fa fa-check-square-o"></i> Hepsini Seç</a>
                    <a class="btn btn-sm btn-danger deleteall" href="<?php echo $this->module ?>/delete"><i class="fa fa-trash-o"></i></a>
                <?php endif; ?>
                <?php if ($this->permission('insert')): ?>
                    <a class="btn btn-sm btn-success" href="<?php echo $this->module ?>/insert<?php echo isset($parent) ? "/{$parent->id}":'' ?>"><i class="fa fa-plus"></i> Yeni Kayıt</a>
                <?php endif; ?>

                <a id="order-update" class="btn btn-sm btn-info hide" href="<?php echo $this->module ?>/order"><i class="fa fa-check-square"></i> Sırayı Güncelle</a>
            </div>
            <div class="col-md-8 text-right">
                <form class="form-inline" action="" method="get" id="filter" accept-charset="utf-8" style="display: inline-block;">
                    <?php $this->view('filter') ?>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th width="40" class="text-center"><i class="fa fa-ellipsis-v"></i></th>
            <th width="50">#</th>
            <th>Başlık</th>
            <th>Slug</th>
            <th width="100" class="text-center">Kayıtlar</th>
            <th width="100" class="text-center">Sıra</th>
            <th width="100" class="text-right">İşlem</th>
        </tr>
        </thead>
        <tbody class="sortable">
        <?php foreach ($records as $item): ?>
        <tr data-id="<?php echo $item->id ?>">
            <td class="text-center">
                <?php if (empty($item->reserved)): ?>
                <input type="checkbox" class="checkall-item" value="<?php echo $item->id ?>" />
                <?php endif; ?>
            </td>
            <td><?php echo $item->id ?></td>
            <td><?php echo $item->title ?></td>
            <td>@<?php echo $this->module ?>/<?php echo $item->slug ?>/<?php echo $item->id ?></td>
            <td class="text-center"><a class="btn btn-success btn-xs" href="<?php echo $this->module ?>/childs/<?php echo $item->id ?>"><i class="fa fa-link"></i> <?php echo $item->childs ?></a></td>
            <td class="text-center">
                <div class="btn-group">
                    <a class="btn btn-xs btn-info disabled"><?php echo $item->order ?></a>
                    <?php if (! $this->input->get() || $this->input->get('page')): ?>
                    <a class="btn btn-xs btn-default sortable-handle"><i class="fa fa-arrows"></i></a>
                    <?php endif; ?>
                </div>
            </td>
            <td class="text-right">
                <?php if ($this->permission('update')): ?>
                <a class="btn btn-xs btn-primary" href="<?php echo $this->module ?>/update/<?php echo $item->id ?>"><i class="fa fa-edit"></i></a>
                <?php endif; ?>
                <?php if ($this->permission('delete') && empty($item->reserved)): ?>
                <a class="btn btn-xs btn-danger confirm-delete" href="<?php echo $this->module ?>/delete/<?php echo $item->id ?>"><i class="fa fa-trash-o"></i></a>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php if (! empty($pagination)): ?>
        <div class="panel-footer">
            <?php echo $pagination ?>
        </div>
    <?php endif; ?>
</div>