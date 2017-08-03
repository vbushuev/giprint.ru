<?php
$entryIds = [24,25,30,35,49,51,52,53,54,123,124,134,160,230,231,234];
foreach ($entryIds as $entry_id) {
    echo "\n#".$entry_id."\n";
    echo "delete FROM `exp_store_product_modifiers` where entry_id=".$entry_id.";\n";
    echo "delete FROM `exp_store_stock` where entry_id=".$entry_id.";\n";
    echo "delete FROM `exp_store_stock_options` where entry_id=".$entry_id.";\n";
    echo "insert into `exp_store_stock`(`sku`,`entry_id`,`min_order_qty`,`track_stock`) values('sku-000-".$entry_id."',".$entry_id.",0,'n');\n";
    echo "INSERT INTO `exp_store_product_modifiers` (`entry_id`, `mod_type`, `mod_name`, `mod_instructions`, `mod_order`) VALUES \n\t(".$entry_id.", 'text', 'price', '', 1),\n\t(".$entry_id.", 'text', 'Комментарий к заказу', '', 0),\n\t(".$entry_id.", 'text', 'data', '', 2),\n\t(".$entry_id.", 'text', '^Files', '', 3);\n";
}
?>
