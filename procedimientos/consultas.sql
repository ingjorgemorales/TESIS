////////////////-VERIFICAR USUARIO-////////////////////
DELIMITER //

CREATE PROCEDURE verificar_usuario(
    IN p_email VARCHAR(100),
    IN p_contrasena VARCHAR(100)
)
BEGIN
    SELECT *
    FROM empleado
    WHERE Cedula = p_id_empleado AND contraseña = p_contrasena;
END
/////////////////////////-CONSULTAR EMPLEADO-///////////////////////////////////////
DELIMITER //
CREATE PROCEDURE Consultar_empleado(ide varchar(100))
BEGIN
SELECT *
FROM empleado
WHERE Cedula = ide;
END
