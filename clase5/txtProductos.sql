INSERT INTO `producto`(`id`, `código_de_barra`, `nombre`, `tipo`, `stock`, `precio`, `fecha_de_creación`, `fecha_de_modificación`) VALUES('77900361','Westmacott','liquido','33','15.87','2021/2/9','2020/9/26'),
 ('77900362','Spirit','solido','45','69.74','2020/9/18','2020/4/14'),
 ('77900363','Newgrosh','polvo','14','68.19','2020/11/29','2021/2/11'),
 ('77900364','McNickle','polvo','19','53.51','2020/11/28','2020/4/17'),
 ('77900365','Hudd','solido','68','26.56','2020/12/19','2020/6/19'),
 ('77900366','Schrader','polvo','17','96.54','2020/8/2','2020/4/18'),
 ('77900367','Bachellier','solido','59','69.17','2021/1/30','2020/6/7'),
 ('77900368','Fleming','solido','38','66.77','2020/10/26','2020/10/3'),
 ('77900369','Hurry','solido','44','43.01','2020/7/4','2020/5/30'),
 ('77900310','Krauss','polvo','73','35.73','2021/3/3','2020/8/30');


ALTER TABLE contacts AUTO_INCREMENT = 50;


INSERT INTO `usuario`( `nombre`, `apellido`, `clave`, `mail`, `fecha_de_registro`, `localidad`) 
    VALUES ('Esteban','Madou','2345','dkantor0@example.com','2021/1/7','Quilmes'),
    ('German','Gerram','1234','ggerram1@hud.gov','2020/5/8','Berazategui'),
    ('Deloris','Fosis','5678','bsharpe2@wisc.edu','2020/11/28','Avellaneda'),
    ('Brok','Neiner','4567','bblazic3@desdev.cn','2020/12/8','Quilmes'),
    ('Garrick','Brent','6789','gbrent4@theguardiam.com','2020/12/17','Moron'),
    ('Bili','Baus','0123','bhoff5@addthis.com','2020/11/27','Moreno');

INSERT INTO `venta`(`id_producto`, `id_usuario`, `cantidad`, `fecha_de_venta`) 
    VALUES ('1001','101','2','2020/7/19'),
    ('1008','102','3','2020/8/16'),
    ('1007','102','4','2021/1/24'),
    ('1006','103','5','2021/1/14'),
    ('1003','104','6','2021/3/20'),
    ('1005','105','7','2021/2/22'),
    ('1003','104','6','2020/12/2'),
    ('1003','106','6','2020/6/10'),
    ('1002','106','6','2021/2/4'),
    ('1001','106','1','2020/5/17');

1- SELECT * FROM usuario ORDER BY apellido ASC

2 - SELECT * FROM `producto` WHERE tipo = 'liquido'

3 - SELECT * FROM `venta` WHERE cantidad BETWEEN 6 AND 10

4 - SELECT SUM(cantidad) from venta

5 - 

6 - SELECT usuario.nombre , producto.nombre , venta.id_producto , venta.id_usuario
FROM venta INNER JOIN usuario,producto
WHERE venta.id_producto = producto.id AND usuario.id_usuario = venta.id_usuario

7 - SELECT v.id_producto AS "id de venta" , v.cantidad * p.precio AS 'total'
FROM venta v INNER JOIN producto p ON v.id_producto = p.id

8 - SELECT SUM(venta.cantidad) AS 'total'
FROM venta WHERE venta.id_producto = 1003 AND venta.id_usuario = 104

9 -SELECT COUNT(venta.cantidad) as 'TOTAL VENDIDO EN AVELLANEDA'
FROM venta INNER JOIN usuario
ON venta.id_usuario = usuario.id_usuario
WHERE usuario.localidad = 'Avellaneda'

10 - SELECT * FROM usuario WHERE usuario.nombre LIKE '%u%'

11 - SELECT * FROM venta WHERE venta.fecha_de_venta BETWEEN '2020/6/1' AND '2021/2/1'

12 - SELECT usuario.fecha_de_registro AS 'REGISTRO ANTES DEL 2021'
FROM usuario WHERE fecha_de_registro <= "2021/1/1"

13 - INSERT INTO `producto`(`código_de_barra`, `nombre`, `tipo`, `stock`, `precio`) 
VALUES ('77900311','Chocolate','Solido','33','25,35')

14 - INSERT INTO `usuario`( `nombre`, `apellido`, `clave`, `mail`, `localidad`)
VALUES ('LeBron','James','2306','lebronjames@aol.com',"Los Angeles")

15 - UPDATE `producto` SET `precio`= 66.60 WHERE producto.tipo = 'solido'

16 - UPDATE `producto` SET `stock`= 0 WHERE producto.stock < 20

17 - DELETE FROM `producto` WHERE producto.id = 1010

18 - DELETE FROM usuario WHERE usuario.id_usuario NOT IN (SELECT id_usuario FROM venta)

