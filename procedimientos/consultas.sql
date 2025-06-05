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
/////////////////////////-MOSTRAR TODO CATEGORIA-///////////////////////////////////////
DELIMITER //
CREATE PROCEDURE Mostrar_todo_categoria()
BEGIN
SELECT *
FROM categoria;
END
/////////////////////////-MOSTRAR TODO ZONA-///////////////////////////////////////
DELIMITER //
CREATE PROCEDURE Mostrar_todo_zona()
BEGIN
SELECT *
FROM zona;
END
////////////////////////////////-MOSTRAR TODO RADIOGRAFIA-///////////////////////////////////////
DELIMITER //
CREATE PROCEDURE Mostrar_todo_radiografia()
BEGIN
SELECT 
    r.Archivo_radiografia,
    r.Id_radiografia AS ID,
    r.Fecha_hora AS "Fecha y hora",
    r.Observaciones,
    z.Nombre_zona AS Zona,
    c.Nombre_categoria AS Categoria,
    CONCAT(e.Nombre, ' ', e.Apellido) AS nombre_empleado,
    p.Id_paciente AS "Cedula paciente",
    p.Fecha_nacimiento,
    CONCAT(p.Nombres, ' ', p.Apellidos) AS "Nombre completo",
    p.Genero
FROM 
    radiografia r
INNER JOIN zona z ON r.Id_zona = z.Id_zona
INNER JOIN categoria c ON r.Id_categoria = c.Id_categoria
INNER JOIN empleado e ON r.Id_empleado = e.Cedula
INNER JOIN paciente p ON r.Id_paciente = p.Id_paciente;

END
/////////////////////////-CONSULTAR RADIOGRAFIA-///////////////////////////////////////
DELIMITER //
CREATE PROCEDURE Consultar_radiografia(ide varchar(100))
BEGIN
SELECT 
    r.Archivo_radiografia,
    r.Id_radiografia AS ID,
    r.Fecha_hora AS "Fecha y hora",
    r.Observaciones,
    z.Nombre_zona AS Zona,
    c.Nombre_categoria AS Categoria,
    CONCAT(e.Nombre, ' ', e.Apellido) AS nombre_empleado,
    p.Id_paciente AS "Cedula paciente",
    p.Fecha_nacimiento,
    CONCAT(p.Nombres, ' ', p.Apellidos) AS "Nombre completo",
    p.Genero
FROM 
    radiografia r
INNER JOIN zona z ON r.Id_zona = z.Id_zona
INNER JOIN categoria c ON r.Id_categoria = c.Id_categoria
INNER JOIN empleado e ON r.Id_empleado = e.Cedula
INNER JOIN paciente p ON r.Id_paciente = p.Id_paciente
WHERE r.Id_radiografia = ide;

END