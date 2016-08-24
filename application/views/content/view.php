<main id="main">
    <div class="page-title">
        <div class="container">
            <h1><?php echo $content->title ?></h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-<?php echo ! empty($content->parent->childs) || ! empty($content->childs) ? 9:12 ?>">
                <div class="typography">
                    <?php echo $content->detail ?>
                </div>

                <div class="buttons">
                    <a class="btn" href="javascript:history.back();"><span class="fa fa-chevron-left"></span> <?php echo lang('content-go-back') ?></a>
                </div>

                <div class="share-box">
                    <p><strong><?php echo lang('content-share-social') ?></strong></p>
                    <a class="facebook" href="http://facebook.com/sharer.php?u=<?php echo current_url() ?>" title="<?php echo lang('content-share-facebook') ?>"><?php echo lang('content-share-facebook') ?></a>
                    <a class="twitter" href="https://twitter.com/share?url=<?php echo current_url() ?>&text=<?php echo htmlspecialchars($content->title) ?>" title="<?php echo lang('content-share-twitter') ?>"><?php echo lang('content-share-twitter') ?></a>
                    <a class="google" href="https://plus.google.com/share?url=<?php echo current_url() ?>" title="<?php echo lang('content-share-google') ?>"><?php echo lang('content-share-google') ?></a>
                </div>

            </div>

            <?php if (! empty($content->parent->childs)): ?>
                <div class="col-md-3">

                    <?php if (! empty($content->parent->childs)): ?>
                        <div class="sidemenu">
                            <a class="parent item" href="<?php echo clink(array('@content', $content->parent->slug, $content->parent->id)) ?>" title="<?php echo $content->parent->title ?>"><?php echo $content->parent->title ?></a>
                            <?php foreach ($content->parent->childs as $child): ?>
                                <a class="item <?php echo $content->id === $child->id ? 'active':'' ?>" href="<?php echo clink(array('@content', $child->slug, $child->id)) ?>" title="<?php echo $child->title ?>"><?php echo $child->title ?></a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</main>