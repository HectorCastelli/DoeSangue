SELECT `campain`.`idcampain`,
    `campain`.`date`,
    `campain`.`enabled`
FROM `sangue`.`campain`
INNER JOIN `sangue`.`city`
ON `campain`.`idcity`=`city`.`idcity`
WHERE `campain`.`enabled` = '1' AND `city`.`name` = 'FILTER'
ORDER BY `name` ASC;