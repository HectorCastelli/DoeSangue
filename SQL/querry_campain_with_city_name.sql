SELECT `campain`.`idcampain`,
    `city`.`name`,
    `campain`.`date`,
    `campain`.`enabled`
FROM `sangue`.`campain`
INNER JOIN `sangue`.`city`
ON `campain`.`idcity`=`city`.`idcity`
WHERE `campain`.`enabled` = '1'
ORDER BY `name` ASC;