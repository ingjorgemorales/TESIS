////////////////////////-CONSULTAR TODO PACIENTE-///////////////////////////////////////
DELIMITER //
CREATE PROCEDURE Consultar_todo_paciente()
BEGIN
SELECT *
FROM paciente;
END
/////////////////////-REGISTRAR PACIENTE-///////////////////////
DELIMITER //

CREATE PROCEDURE Registrar_paciente(
    IN p_Id_paciente INT,
    IN p_Nombres VARCHAR(100),
    IN p_Apellidos VARCHAR(100),
    IN p_Direccion VARCHAR(255),
    IN p_Fecha_nacimiento DATE,
    IN p_Email VARCHAR(100),
    IN p_Celular VARCHAR(20),
    IN p_Genero VARCHAR(50)
)
BEGIN
    INSERT INTO paciente (
        Id_paciente,
        Nombres,
        Apellidos,
        Direccion,
        Fecha_nacimiento,
        Email,
        Celular,
        Genero
    ) VALUES (
        p_Id_paciente,
        p_Nombres,
        p_Apellidos,
        p_Direccion,
        p_Fecha_nacimiento,
        p_Email,
        p_Celular,
        p_Genero
    );
END
//////////////////////-REGISTRAR RADIOGRAFIA-///////////////////////
DELIMITER //

CREATE PROCEDURE Registrar_radiografia (
    IN p_Fecha_hora DATETIME,
    IN p_Archivo_radiografia VARCHAR(255),
    IN p_Observaciones VARCHAR(255),
    IN p_Id_zona VARCHAR(255),
    IN p_Id_categoria VARCHAR(255),
    IN p_Id_empleado VARCHAR(255),
    IN p_Id_paciente VARCHAR(255)
)
BEGIN
    INSERT INTO radiografia (
        Fecha_hora,
        Archivo_radiografia,
        Observaciones,
        Id_zona,
        Id_categoria,
        Id_empleado,
        Id_paciente
    ) VALUES (
        p_Fecha_hora,
        p_Archivo_radiografia,
        p_Observaciones,
        p_Id_zona,
        p_Id_categoria,
        p_Id_empleado,
        p_Id_paciente
    );
END
