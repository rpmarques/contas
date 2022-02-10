ALTER TABLE `ctrec` CHANGE COLUMN `fornec_id` `cliente_id` INTEGER(11) DEFAULT NULL;
ALTER TABLE `ctrec` ADD COLUMN `forma_pgto_id` INTEGER DEFAULT NULL;
ALTER TABLE `ctrec` ADD COLUMN `total_ordem`   INTEGER DEFAULT NULL;
ALTER TABLE `ctrec` ADD COLUMN `valor_pago` FLOAT DEFAULT 0;
ALTER TABLE `ctrec` ADD COLUMN `data_venc` DATE DEFAULT NULL;
ALTER TABLE `ctrec` ADD COLUMN `nronf` INTEGER(11) DEFAULT NULL;
ALTER TABLE `ctrec` MODIFY COLUMN `pago` TINYINT(1) DEFAULT NULL;
ALTER TABLE `ctrec` ADD COLUMN `serie` CHAR(3) DEFAULT NULL;
ALTER TABLE `ctrec` ADD COLUMN `historico` VARCHAR(100) DEFAULT NULL;
ALTER TABLE `ctrec` ADD COLUMN `ordem` INTEGER DEFAULT NULL;