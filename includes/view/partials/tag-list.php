<?php
?>
<?php if($aSettings['tag_list_title'] != '') { ?>
    <h3><?=$aSettings['tag_list_title']?></h3>
<?php }?>
<ul class="plc-tag-list">
    <?php
    if(is_array($aItems)) {
        if(count($aItems) > 0) {
            foreach($aItems as $oItem) { ?>
                <li>
                <?php if(get_option('plcarticle_listview_active') == 1) {
                    $sListViewSlug = get_option('plcarticle_listview_slug');
                    ?>
                    <a href="/<?=$sListViewSlug?>/category/<?=$oItem->id?>" title="<?=__('View Category','wp-plc-tag')?>">
                        <?=$oItem->label?> (<?=$oItem->count?>)
                    </a>
                <?php } else { ?>
                    <?=$oItem->label?> (<?=$oItem->count?>)
                <?php } ?>
                </li>
            <?php
            }
        }
    }
    ?>
</ul>