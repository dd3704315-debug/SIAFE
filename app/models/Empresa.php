<?php

require_once "app/config/database.php";

class Empresa
{
    private $conexion;

    public function __construct()
    {
        $db = new Database();
        $this->conexion = $db->conectar();
    }


    // ==========================================
    // LISTAR EMPRESAS
    // ==========================================

    public function obtenerTodos()
    {
        $sql = "SELECT
                    e.id_empresa,
                    e.id_usuario,
                    e.nit_empresa,
                    e.razon_social_empresa,
                    e.nombre_comercial_empresa,
                    e.correo_empresa,
                    e.telefono_empresa,
                    e.direccion_empresa,
                    e.ciudad_empresa,
                    e.departamento_empresa,
                    e.sector_economico_empresa,
                    e.representante_legal_empresa,
                    e.estado_empresa,
                    e.fecha_creacion_empresa,
                    e.fecha_actualizacion_empresa,
                    CONCAT(
                        u.nombre_usuario,
                        ' ',
                        u.apellido_usuario
                    ) AS nombre_usuario
                FROM empresas e
                INNER JOIN usuarios u
                    ON e.id_usuario = u.id_usuario
                ORDER BY e.id_empresa ASC";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // OBTENER EMPRESA POR ID
    // ==========================================

    public function obtenerPorId($id)
    {
        $sql = "SELECT *
                FROM empresas
                WHERE id_empresa = :id";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id" => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // OBTENER EMPRESA POR USUARIO
    // ==========================================

    public function obtenerPorUsuario($idUsuario)
    {
        $sql = "SELECT *
                FROM empresas
                WHERE id_usuario = :id_usuario
                LIMIT 1";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":id_usuario" => $idUsuario
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    // ==========================================
    // VERIFICAR NIT
    // ==========================================

    public function existeNit($nit)
    {
        $sql = "SELECT COUNT(*)
                FROM empresas
                WHERE nit_empresa = :nit";

        $stmt = $this->conexion->prepare($sql);

        $stmt->execute([
            ":nit" => $nit
        ]);

        return $stmt->fetchColumn() > 0;
    }


    // ==========================================
    // CREAR EMPRESA
    // ==========================================

    public function crear(
        $idUsuario,
        $nit,
        $razonSocial,
        $nombreComercial,
        $correo,
        $telefono,
        $direccion,
        $ciudad,
        $departamento,
        $sectorEconomico,
        $representanteLegal,
        $estado
    ) {

        $sql = "INSERT INTO empresas
                (
                    id_usuario,
                    nit_empresa,
                    razon_social_empresa,
                    nombre_comercial_empresa,
                    correo_empresa,
                    telefono_empresa,
                    direccion_empresa,
                    ciudad_empresa,
                    departamento_empresa,
                    sector_economico_empresa,
                    representante_legal_empresa,
                    estado_empresa
                )
                VALUES
                (
                    :id_usuario,
                    :nit,
                    :razon_social,
                    :nombre_comercial,
                    :correo,
                    :telefono,
                    :direccion,
                    :ciudad,
                    :departamento,
                    :sector_economico,
                    :representante_legal,
                    :estado
                )";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_usuario" => $idUsuario,
            ":nit" => $nit,
            ":razon_social" => $razonSocial,
            ":nombre_comercial" => $nombreComercial,
            ":correo" => $correo,
            ":telefono" => $telefono,
            ":direccion" => $direccion,
            ":ciudad" => $ciudad,
            ":departamento" => $departamento,
            ":sector_economico" => $sectorEconomico,
            ":representante_legal" => $representanteLegal,
            ":estado" => $estado
        ]);
    }


    // ==========================================
    // ACTUALIZAR EMPRESA
    // ==========================================

    public function actualizar(
        $idEmpresa,
        $idUsuario,
        $nit,
        $razonSocial,
        $nombreComercial,
        $correo,
        $telefono,
        $direccion,
        $ciudad,
        $departamento,
        $sectorEconomico,
        $representanteLegal,
        $estado
    ) {

        $sql = "UPDATE empresas
                SET
                    id_usuario = :id_usuario,
                    nit_empresa = :nit,
                    razon_social_empresa = :razon_social,
                    nombre_comercial_empresa = :nombre_comercial,
                    correo_empresa = :correo,
                    telefono_empresa = :telefono,
                    direccion_empresa = :direccion,
                    ciudad_empresa = :ciudad,
                    departamento_empresa = :departamento,
                    sector_economico_empresa = :sector_economico,
                    representante_legal_empresa = :representante_legal,
                    estado_empresa = :estado,
                    fecha_actualizacion_empresa = NOW()
                WHERE id_empresa = :id_empresa";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_empresa" => $idEmpresa,
            ":id_usuario" => $idUsuario,
            ":nit" => $nit,
            ":razon_social" => $razonSocial,
            ":nombre_comercial" => $nombreComercial,
            ":correo" => $correo,
            ":telefono" => $telefono,
            ":direccion" => $direccion,
            ":ciudad" => $ciudad,
            ":departamento" => $departamento,
            ":sector_economico" => $sectorEconomico,
            ":representante_legal" => $representanteLegal,
            ":estado" => $estado
        ]);
    }


    // ==========================================
    // ELIMINAR EMPRESA
    // ==========================================

    public function eliminar($idEmpresa)
    {
        $sql = "DELETE FROM empresas
                WHERE id_empresa = :id_empresa";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ":id_empresa" => $idEmpresa
        ]);
    }
}