SELECT `campain`.`idcampain`,
    `campain`.`date`,
    `campain`.`vacant`,
    `campain`.`occupied`
FROM `sangue`.`campain`
INNER JOIN `sangue`.`city`
ON `campain`.`idcity`=`city`.`idcity`
WHERE `campain`.`enabled` = '1' AND `campain`.`idcampain` = '1'
ORDER BY `name` ASC;