ALTER TABLE `ctpag` CHANGE COLUMN `cliente_id` `fornecedor_id` INTEGER(11) DEFAULT NULL;
ALTER TABLE `ctpag` ADD COLUMN `data_venc` DATE DEFAULT NULL;
ALTER TABLE `ctpag` CHANGE COLUMN `nrodoc` `nronf` INTEGER(11) DEFAULT NULL;

ALTER TABLE `ctpag` MODIFY COLUMN `pago` TINYINT(1) DEFAULT NULL;
ALTER TABLE `ctpag` ADD COLUMN `serie` CHAR(3) DEFAULT NULL;
