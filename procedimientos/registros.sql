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
//////////////////////-REGISTRAR DIAGNOSTICO-///////////////////////
DELIMITER //

CREATE PROCEDURE Insertar_diagnostico (
    IN p_Descripcion  VARCHAR(100),
    IN p_Nivel_gravedad VARCHAR(100),
    IN p_Porcentaje_confianza_IA  VARCHAR(100),
    IN p_Tipo_Fractura_IA VARCHAR(100),
    IN p_Fecha_hora  VARCHAR(100),
    IN p_Id_radiografia  VARCHAR(100),
    IN p_Id_patologia  VARCHAR(100)
)
BEGIN
    INSERT INTO diagnostico (
        Descripcion,
        Nivel_gravedad,
        Porcentaje_confianza_IA,
        Tipo_Fractura_IA,
        Fecha_hora,
        Id_radiografia,
        Id_patologia
    ) VALUES (
        p_Descripcion,
        p_Nivel_gravedad,
        p_Porcentaje_confianza_IA,
        p_Tipo_Fractura_IA,
        p_Fecha_hora,
        p_Id_radiografia,
        p_Id_patologia
    );
END
///////////////////////-REGISTRAR PATOLOGIA-///////////////////////
DELIMITER //

CREATE PROCEDURE Insertar_patologia (
    IN p_Nombre_patologia VARCHAR(100),
    IN p_Tipo_patologia VARCHAR(100),
    IN p_Descripcion_patologia VARCHAR(100)
)
BEGIN
    INSERT INTO patologia (
        Nombre_patologia,
        Tipo_patologia,
        Descripcion_patologia
    ) VALUES (
        p_Nombre_patologia,
        p_Tipo_patologia,
        p_Descripcion_patologia
    );
END
///////////////////////-Actualizar Empleado-///////////////////////
DELIMITER //
CREATE PROCEDURE Actualizar_Empleado (
    IN p_cedula VARCHAR(20),
    IN p_nombre VARCHAR(100),
    IN p_apellido VARCHAR(100),
    IN p_direccion VARCHAR(200),
    IN p_email VARCHAR(100),
    IN p_celular VARCHAR(100),
    IN p_especialidad VARCHAR(100),
    IN p_password VARCHAR(255),
    IN p_foto VARCHAR(255)
)
BEGIN
    UPDATE empleado
    SET 
        nombre = p_nombre,
        apellido = p_apellido,
        direccion = p_direccion,
        email = p_email,
        celular = p_celular,
        especialidad = p_especialidad,
        password = p_password,
        foto = p_foto
    WHERE cedula = p_cedula;
END ;
/////////////////////////////////-eliminar diagnostico-////////////////////////////////
DELIMITER //

CREATE PROCEDURE Eliminar_Diagnostico(
    IN p_Id_diagnostico varchar(100)
)
BEGIN
SELECT 
    d.*,
    r.Fecha_hora AS Fecha_radiografia,
    pa.Nombres AS Nombre_paciente,
    pa.Apellidos AS Apellido_paciente,
	z.Nombre_zona AS Zona_radiografiada,
    p.Nombre_patologia
    
FROM diagnostico d
INNER JOIN radiografia r ON d.Id_radiografia = r.Id_radiografia
INNER JOIN zona z ON r.Id_zona = z.Id_zona
INNER JOIN patologia p ON d.Id_patologia = p.Id_patologia
INNER JOIN paciente pa ON r.Id_paciente = pa.Id_paciente
WHERE d.Id_diagnostico = ide;
END
//////////////////////////////-Actualizar Diagnostico-////////////////////////////////
DELIMITER //

CREATE PROCEDURE Actualizar_diagnostico(
    IN p_Id_diagnostico varchar(100),
    IN p_Id_patologia varchar(100),
    IN p_Descripcion varchar(100),
    IN p_Nivel_gravedad VARCHAR(100)
)
BEGIN
    UPDATE diagnostico
    SET 
        Id_patologia = p_Id_patologia,
        Descripcion = p_Descripcion,
        Nivel_gravedad = p_Nivel_gravedad
    WHERE Id_diagnostico = p_Id_diagnostico;
END 

