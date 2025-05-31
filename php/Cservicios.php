<?php if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['k_id'])) {
    $id = $_SESSION['k_id'];
} else {
    //echo "Las variables de sesión no están establecidas.";
}
class cCliente {
    public $id;
    public function __construct() {
        global $id;
        $this->id_para_todo = $id;
    }

    public function obtenerIdParaTodo() {
        return $this->id_para_todo;
    }
  private function createConnection() {
    $conexion = new mysqli("127.0.0.1", "root", "", "x-ray");
    if ($conexion->connect_error) {
      die("Conexión fallida: " . $conexion->connect_error);
    }
    return $conexion;
  }

  function Usuario_logueado(){
    global $id;
    if (isset($id)) {
      return $id;
    } else {
      return false;
    }
  }

  function verificar_usuario($id_empleado, $password) {
    $conexion = $this->createConnection();
    $sql = "CALL verificar_usuario(?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("is", $id_empleado, $password);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado;
    }

  function consultar_todo_diagnosticos() {
    $conexion = $this->createConnection();
    $sql = "SELECT * FROM diagnostico";
    $rec = mysqli_query($conexion, $sql);
    return $rec;
  }
function cerrar_session(){
    global $id;
    $id = 0;
    session_start();
    session_destroy();
    header("Location: ../index.html");
    exit();
    return true;
}

function Consultar_empleado($id_empleado){
    $conexion = $this->createConnection();
    $sql = "CALL Consultar_empleado(?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_empleado);
    $stmt->execute();
    $resultado = $stmt->get_result();
    return $resultado;
}
}

?>