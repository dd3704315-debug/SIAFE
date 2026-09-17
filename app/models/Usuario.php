<?php

require_once "app/config/database.php";

class Usuario
{
    private $conexion;


    // ==========================================
    // CONSTRUCTOR
    // ==========================================

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }


    // ==========================================
    // LISTAR USUARIOS
    // ==========================================

    public function obtenerTodos()
    {
        $sql = "SELECT
                    u.id_usuario,
                    u.id_rol,
                    u.nombre_usuario,
                    u.apellido_usuario,
                    u.tipo_documento_usuario,
                    u.numero_documento_usuario,
                    u.correo_usuario,
                    u.telefono_usuario,
                    u.direccion_usuario,
                    u.usuario,
                    u.estado_usuario,
                    r.nombre_rol
                FROM usuarios u
                INNER JOIN roles r
                    ON u.id_rol = r.id_rol
                ORDER BY u.id_usuario ASC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // OBTENER USUARIO POR ID
    // ==========================================

    public function obtenerPorId($id)
    {
        $sql = "SELECT *
                FROM usuarios
                WHERE id_usuario = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // VERIFICAR DOCUMENTO
    // ==========================================

    public function existeDocumento($numeroDocumento)
    {
        $sql = "SELECT COUNT(*)
                FROM usuarios
                WHERE numero_documento_usuario = :documento";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":documento" => $numeroDocumento
        ]);

        return $stmt->fetchColumn() > 0;
    }


    // ==========================================
    // VERIFICAR CORREO
    // ==========================================

    public function existeCorreo($correo)
    {
        $sql = "SELECT COUNT(*)
                FROM usuarios
                WHERE correo_usuario = :correo";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":correo" => $correo
        ]);

        return $stmt->fetchColumn() > 0;
    }


    // ==========================================
    // VERIFICAR NOMBRE DE USUARIO
    // ==========================================

    public function existeUsuario($usuario)
    {
        $sql = "SELECT COUNT(*)
                FROM usuarios
                WHERE usuario = :usuario";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":usuario" => $usuario
        ]);

        return $stmt->fetchColumn() > 0;
    }


    // ==========================================
    // CREAR USUARIO
    // ==========================================

    public function crear(
        $idRol,
        $nombre,
        $apellido,
        $tipoDocumento,
        $numeroDocumento,
        $correo,
        $telefono,
        $direccion,
        $observaciones,
        $usuario,
        $password,
        $estado
    ) {

        // --------------------------------------
        // ENCRIPTAR CONTRASEÑA
        // --------------------------------------

        $passwordHash = password_hash(
            $password,
            PASSWORD_DEFAULT
        );


        $sql = "INSERT INTO usuarios
                (
                    id_rol,
                    nombre_usuario,
                    apellido_usuario,
                    tipo_documento_usuario,
                    numero_documento_usuario,
                    correo_usuario,
                    telefono_usuario,
                    direccion_usuario,
                    observaciones,
                    usuario,
                    password,
                    estado_usuario
                )
                VALUES
                (
                    :id_rol,
                    :nombre,
                    :apellido,
                    :tipo_documento,
                    :numero_documento,
                    :correo,
                    :telefono,
                    :direccion,
                    :observaciones,
                    :usuario,
                    :password,
                    :estado
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_rol" => $idRol,
            ":nombre" => $nombre,
            ":apellido" => $apellido,
            ":tipo_documento" => $tipoDocumento,
            ":numero_documento" => $numeroDocumento,
            ":correo" => $correo,
            ":telefono" => $telefono,
            ":direccion" => $direccion,
            ":observaciones" => $observaciones,
            ":usuario" => $usuario,
            ":password" => $passwordHash,
            ":estado" => $estado
        ]);
    }


    // ==========================================
    // ACTUALIZAR USUARIO
    // ==========================================

    public function actualizar(
        $idUsuario,
        $idRol,
        $nombre,
        $apellido,
        $tipoDocumento,
        $numeroDocumento,
        $correo,
        $telefono,
        $direccion,
        $observaciones,
        $usuario,
        $estado
    ) {

        $sql = "UPDATE usuarios
                SET
                    id_rol = :id_rol,
                    nombre_usuario = :nombre,
                    apellido_usuario = :apellido,
                    tipo_documento_usuario = :tipo_documento,
                    numero_documento_usuario = :numero_documento,
                    correo_usuario = :correo,
                    telefono_usuario = :telefono,
                    direccion_usuario = :direccion,
                    observaciones = :observaciones,
                    usuario = :usuario,
                    estado_usuario = :estado,
                    fecha_actualizacion_usuario = NOW()
                WHERE id_usuario = :id_usuario";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_usuario" => $idUsuario,
            ":id_rol" => $idRol,
            ":nombre" => $nombre,
            ":apellido" => $apellido,
            ":tipo_documento" => $tipoDocumento,
            ":numero_documento" => $numeroDocumento,
            ":correo" => $correo,
            ":telefono" => $telefono,
            ":direccion" => $direccion,
            ":observaciones" => $observaciones,
            ":usuario" => $usuario,
            ":estado" => $estado
        ]);
    }


    // ==========================================
    // ELIMINAR USUARIO
    // ==========================================

    public function eliminar($idUsuario)
    {
        // Verificar primero el rol del usuario

        $sqlVerificar = "SELECT id_rol
                         FROM usuarios
                         WHERE id_usuario = :id_usuario
                         LIMIT 1";

        $stmtVerificar = $this->conexion->prepare($sqlVerificar);

        $stmtVerificar->execute([
            ":id_usuario" => $idUsuario
        ]);

        $usuario = $stmtVerificar->fetch(PDO::FETCH_ASSOC);


        // No permitir eliminar un Super Administrador

        if ($usuario && (int)$usuario["id_rol"] === 1) {
            return false;
        }


        // Eliminar usuario

        $sql = "DELETE FROM usuarios
                WHERE id_usuario = :id_usuario";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_usuario" => $idUsuario
        ]);
    }


    // ==========================================
    // INICIAR SESIÓN
    // ==========================================

    public function iniciarSesion($correo, $password)
    {
        $correo = trim($correo);

        $sql = "SELECT
                    u.*,
                    r.nombre_rol
                FROM usuarios u
                INNER JOIN roles r
                    ON u.id_rol = r.id_rol
                WHERE LOWER(TRIM(u.correo_usuario)) = LOWER(:correo)
                AND u.estado_usuario = 'Activo'
                LIMIT 1";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":correo" => $correo
        ]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);


        if (!$usuario) {
            return false;
        }


        // Verificar contraseña

        if (!password_verify($password, $usuario["password"])) {
            return false;
        }


        return $usuario;
    }


    // ==========================================
    // BUSCAR USUARIO POR CORREO
    // ==========================================

    public function buscarPorCorreo($correo)
    {
        $correo = trim($correo);

        $sql = "SELECT
                    id_usuario,
                    nombre_usuario,
                    apellido_usuario,
                    correo_usuario,
                    estado_usuario
                FROM usuarios
                WHERE LOWER(TRIM(correo_usuario)) = LOWER(:correo)
                LIMIT 1";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":correo" => $correo
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // ACTUALIZAR CONTRASEÑA
    // ==========================================

    public function actualizarPassword($idUsuario, $nuevaPassword)
    {
        // Encriptar nueva contraseña

        $passwordHash = password_hash(
            $nuevaPassword,
            PASSWORD_DEFAULT
        );


        $sql = "UPDATE usuarios
                SET
                    password = :password,
                    fecha_actualizacion_usuario = NOW()
                WHERE id_usuario = :id_usuario";


        $stmt = $this->conexion->prepare($sql);


        return $stmt->execute([
            ":password" => $passwordHash,
            ":id_usuario" => $idUsuario
        ]);
    }
}