
<div class="row">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="col-md-8">
            <?php echo $this->utils->alert(); ?>

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-edit"></i> Kayıt Düzenle</div>
                <div class="panel-body">

                    <?php echo bsFormText('title', 'Başlık', array('required' => true, 'value' => $record->title)) ?>
                    <?php echo bsFormSlug('slug', 'Slug', array('required' => true, 'value' => $record->slug)) ?>
                    <?php echo bsFormImage('image', 'Resim', array('value' => $record->image, 'path' => '../public/upload/content/')) ?>
                    <?php echo bsFormTextarea('summary', 'Özet', array('value' => $record->summary)) ?>
                    <?php echo bsFormEditor('detail', 'Detay', array('value' => $record->detail)) ?>


                </div>
                <div class="panel-footer">
                    <button class="btn btn-success" type="submit">Kaydet</button>
                    <a class="btn btn-default" href="<?php echo $this->module ?>/records">Vazgeç</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-plus-square"></i> Özel Değerler</div>
                <div class="panel-body">
                    <?php echo bsFormText('reserved', 'Rezerve kayıt ise adını yazınız', array('value' => $record->reserved)) ?>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-heading"><i class="fa fa-plus-square"></i> Meta Bilgileri</div>

                <div class="panel-body">
                    <?php echo bsFormText('metaTitle', 'Title', array('value' => $record->metaTitle)) ?>
                    <?php echo bsFormTextarea('metaDescription', 'Description', array('value' => $record->metaDescription)) ?>
                    <?php echo bsFormTextarea('metaKeywords', 'Keywords', array('value' => $record->metaKeywords)) ?>
                </div>
            </div>
        </div>
    </form>
</div>

