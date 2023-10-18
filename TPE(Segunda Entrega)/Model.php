<?php
require_once 'config.php';

class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO(
        "mysql:host=".MYSQL_HOST .
        ";dbname=".MYSQL_DB.";charset=utf8", 
        MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql = "
            -- Estructura de tabla para la tabla `marcas`
            CREATE TABLE `marcas` (
              `id` int(2) NOT NULL,
              `nombre` varchar(20) NOT NULL,
              `origen` varchar(20) NOT NULL,
              `año_fundacion` int(4) NOT NULL,
              `cant_empleados` int(5) NOT NULL,
              `produccion_anual` int(8) NOT NULL,
              `facturacion_M_USD` int(6) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    
            -- Volcado de datos para la tabla `marcas`
            INSERT INTO `marcas` (`id`, `nombre`, `origen`, `año_fundacion`, `cant_empleados`, `produccion_anual`, `facturacion_M_USD`) VALUES
            (4, 'kawasaki', 'japon', 1946, 36000, 4000000, 13000),
            (134, 'honda', 'japon', 1949, 220, 14000000, 68),
            (135, 'yamaha', 'japon', 1955, 74000, 6, 22000);
    
            -- Estructura de tabla para la tabla `modelos`
            CREATE TABLE `modelos` (
              `id` int(2) NOT NULL,
              `id_marca` int(2) NOT NULL,
              `nombre` varchar(20) NOT NULL,
              `cilindrada_cm3` int(4) NOT NULL,
              `tipo` varchar(20) NOT NULL,
              `potencia_hp` int(3) NOT NULL,
              `peso_kg` int(3) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    
            -- Volcado de datos para la tabla `modelos`
            INSERT INTO `modelos` (`id`, `id_marca`, `nombre`, `cilindrada_cm3`, `tipo`, `potencia_hp`, `peso_kg`) VALUES
            (11, 4, 'Ninja', 998, 'deportiva', 310, 216),
            (12, 4, 'Ninja ZX-10R', 998, 'deportiva', 200, 202),
            (13, 4, 'Z900', 948, 'naked', 125, 212),
            (43, 135, 'YZF-R1', 998, 'deportiva', 200, 200),
            (44, 135, 'MT-09', 889, 'naked', 119, 193),
            (45, 135, 'XSR900 Retro', 889, 'retro', 119, 193),
            (46, 134, 'CBR1000RR-R', 999, 'deportiva', 217, 198),
            (47, 134, 'CB650R', 649, 'naked', 95, 199),
            (48, 134, 'CB500F', 471, 'naked', 47, 190);
    
            -- Estructura de tabla para la tabla `usuarios`
            CREATE TABLE `usuarios` (
              `id` int(11) NOT NULL,
              `mail` varchar(100) NOT NULL,
              `password` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
    
            -- Volcado de datos para la tabla `usuarios`
            INSERT INTO `usuarios` (`id`, `mail`, `password`) VALUES
            (1, 'webadmin', '$2y$10$foMxsHfqnLSb9B/MSfy3jOPVX/plsRSgws3bv6kMP/H.rZkK0IDwm');
    
            -- Índices para tablas volcadas
    
            -- Indices de la tabla `marcas`
            ALTER TABLE `marcas`
              ADD PRIMARY KEY (`id`);
    
            -- Indices de la tabla `modelos`
            ALTER TABLE `modelos`
              ADD PRIMARY KEY (`id`),
              ADD KEY `id_marca` (`id_marca`);
    
            -- Indices de la tabla `usuarios`
            ALTER TABLE `usuarios`
              ADD PRIMARY KEY (`id`);
    
            -- AUTO_INCREMENT de las tablas volcadas
    
            -- AUTO_INCREMENT de la tabla `marcas`
            ALTER TABLE `marcas`
              MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;
    
            -- AUTO_INCREMENT de la tabla `modelos`
            ALTER TABLE `modelos`
              MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
    
            -- AUTO_INCREMENT de la tabla `usuarios`
            ALTER TABLE `usuarios`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
    
            -- Restricciones para tablas volcadas
    
            -- Filtros para la tabla `modelos`
            ALTER TABLE `modelos`
              ADD CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
            ";
            $this->db->exec($sql);
        }
    }
    

}

?>