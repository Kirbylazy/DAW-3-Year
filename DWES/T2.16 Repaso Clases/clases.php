<?php
// ====================================================================
// ARCHIVO: clases.php
// Contiene todas las definiciones de clases e interfaces.
// La lógica se mantiene igual, solo se actualiza generarDocumentos().
// ====================================================================

require_once('interfaz.php');

// Superclase Abstracta 
abstract class Documento {

    // Atributos
    protected string $titulo;
    public string $autor;
    private static int $contadorDocumentos = 0;

    // Constructor
    public function __construct(string $titulo, string $autor) {
        $this->titulo = $titulo;
        $this->autor = $autor;
        self::$contadorDocumentos++;
    }

    // Destructor
    public function __destruct()
    {
        self::$contadorDocumentos--;
    }

    // Función abstracta
    abstract public function imprimir(): string;

    // Funciones auxiliares  
    public static function getConteo(): int {
        return self::$contadorDocumentos;
    }
    
    public function __toString(): string {
        return "Documento base: {$this->titulo} (Creado por {$this->autor}).";
    }
}

// Subclase 1: Contrato 
class Contrato extends Documento implements FirmaDigital {

    // Atributos
    private bool $firmado = false;

    // Constructor
    public function __construct(string $titulo, string $autor) {
        parent::__construct($titulo, $autor);
    }

    // Funciones auxiliares  
    public function imprimir(): string {
         $mensaje = "Imprimiendo Contrato: {$this->titulo}. Estado de firma: ";
         
         if ($this->firmado) {
            $mensaje .= "Firmado";
         } else {
            $mensaje .= "Pendiente";
         }

         return $mensaje;
    }

    public function firmar(string $usuario): string {
        if (!$this->firmado) {
            $this->firmado = true;
            return "El Contrato ha sido firmado digitalmente por {$usuario}.";
        }
        return "El Contrato ya estaba firmado.";
    }
}

// Subclase 2: Informe 
class Informe extends Documento {

    private int $paginas;
    private array $eventosDinamicos = [];

    public function __construct(string $titulo, string $autor, int $paginas) {
        parent::__construct($titulo, $autor);
        $this->paginas = $paginas;
    }

    public function imprimir(): string {
        return "Imprimiendo Informe Técnico: {$this->titulo} ({$this->paginas} páginas).";
    }
    
    public function __get(string $nombrePropiedad) {
        if (property_exists($this, $nombrePropiedad)) {
            return $this->$nombrePropiedad;
        } elseif (array_key_exists($nombrePropiedad, $this->eventosDinamicos)) {
            return $this->eventosDinamicos[$nombrePropiedad];
        }
        return "Propiedad no encontrada.";
    }

    public function __set(string $nombrePropiedad, $valor) {
        if ($nombrePropiedad === 'paginas' && is_int($valor) && $valor > 0) {
            $this->paginas = $valor;
        } elseif (!property_exists($this, $nombrePropiedad)) {
            $this->eventosDinamicos[$nombrePropiedad] = $valor;
        }
    }
    
    public function getEventosDinamicos(): array {
        return $this->eventosDinamicos;
    }
}

/**
 * Función que crea los 3 documentos: 1 Informe y 2 Contratos.
 * @return array Contiene todas las instancias de los documentos.
 */
function generarDocumentos(): array {
    
    // 1. Crear el Informe
    $informe = new Informe("Informe de Gastos", "Elena Vidal", 30);
    $informe->fechaRevision = date('Y-m-d'); // Propiedad dinámica con __set
    $informe->paginas = 32; // Uso de __set() para validar y actualizar

    // 2. Crear Contrato FIRMADO
    $contratoFirmado = new Contrato("Contrato de Colaboración", "Javier García");
    $contratoFirmado->firmar("Director General"); // Uso de la Interfaz

    // 3. Crear Contrato PENDIENTE
    $contratoPendiente = new Contrato("Acuerdo de prácticas", "Marta Díaz");

    // Devolver la lista de documentos
    return [
        $informe,
        $contratoFirmado,
        $contratoPendiente
    ];
}