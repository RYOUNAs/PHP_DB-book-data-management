CREATE TABLE `m_book` (
  `id` int(11) NOT NULL COMMENT '主キー',
  `title` varchar(255) NOT NULL COMMENT '本のタイトル',
  `volume` int(11) NOT NULL COMMENT '巻数',
  `price` int(11) NOT NULL COMMENT '価格',
  `release_date` date NOT NULL COMMENT '発売日',
  `purchase_date` date DEFAULT NULL COMMENT '購入日：購入していない場合はnull',
  `del_date` date DEFAULT NULL COMMENT '削除日：削除していない場合はnull'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `m_book`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `m_book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '主キー';




-- テスト
CREATE TABLE `m_book`(
    `id` INT(11) NOT NULL COMMENT '主キー',
    `title` VARCHAR(255) NOT NULL COMMENT '本のタイトル',
    `volume` INT(11) NOT NULL COMMENT '巻数',
    `price` INT(11) NOT NULL COMMENT '価格',
    `release_date` DATE NOT NULL COMMENT '発売日',
    `purchase_date` DATE DEFAULT NULL COMMENT '購入日：購入していない場合はnull',
    `del_date` DATE DEFAULT NULL COMMENT '削除日：削除していない場合はnull'
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4; ALTER TABLE
    `m_book` ADD PRIMARY KEY(`id`);
ALTER TABLE
    `m_book` MODIFY `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT '主キー';
-- テスト




INSERT INTO m_book (`id`, `title` , `volume` , `price` , `release_date` , `purchase_date` , `del_date`) VALUES(1 , 'Azure' , 1 , 780 , '2022-06-26' , '2022-07-02' , null);
INSERT INTO m_book (`id`, `title` , `volume` , `price` , `release_date` , `purchase_date` , `del_date`) VALUES(2 , 'Linux' , 36 , 520 , '2022-01-07' , null , null);
INSERT INTO m_book (`id`, `title` , `volume` , `price` , `release_date` , `purchase_date` , `del_date`) VALUES(3 , 'スカルプター' , 28 , 1980 , '2022-01-07' , null , '2022-07-05');



SELECT * FROM m_book;

UPDATE m_book SET del_date=NULL;

drop TABLE m_book;