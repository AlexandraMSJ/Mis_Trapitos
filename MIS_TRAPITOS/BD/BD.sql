-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS MisTrapitosDB;
USE MisTrapitosDB;

-- 1. Tabla: Proveedor [cite: 356]
-- No tiene dependencias foráneas.
CREATE TABLE Proveedor (
    id_proveedor INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    correo VARCHAR(100),
    direccion VARCHAR(255) -- Corregido de 'direcion' en el diagrama 
);

-- 2. Tabla: Cliente [cite: 396]
-- No tiene dependencias foráneas.
CREATE TABLE Cliente (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    correo VARCHAR(100)
);

-- 3. Tabla: Empleado [cite: 362]
-- No tiene dependencias foráneas.
CREATE TABLE Empleado (
    id_empleado INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    usuario VARCHAR(50) NOT NULL UNIQUE,
    contrasena VARCHAR(255) NOT NULL, -- Se recomienda usar HASH en una implementación real
    rol VARCHAR(50)
);

-- 4. Tabla: Producto [cite: 378]
-- Depende de Proveedor.
CREATE TABLE Producto (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    id_proveedor INT NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    categoria VARCHAR(50),
    talla VARCHAR(10),
    color VARCHAR(30),
    precio DECIMAL(10, 2) NOT NULL, -- DECIMAL es mejor para dinero que FLOAT
    stock_actual INT DEFAULT 0,
    CONSTRAINT fk_producto_proveedor FOREIGN KEY (id_proveedor) 
        REFERENCES Proveedor(id_proveedor) ON DELETE RESTRICT
);

-- 5. Tabla: Inventario [cite: 349]
-- Historial de movimientos. Depende de Producto.
CREATE TABLE Inventario (
    id_inventario INT AUTO_INCREMENT PRIMARY KEY,
    id_producto INT NOT NULL,
    tipo_movimiento VARCHAR(50) NOT NULL, -- Ejemplo: 'Entrada', 'Salida', 'Ajuste'
    cantidad INT NOT NULL,
    fecha_movimiento DATETIME DEFAULT CURRENT_TIMESTAMP,
    observaciones TEXT,
    CONSTRAINT fk_inventario_producto FOREIGN KEY (id_producto) 
        REFERENCES Producto(id_producto) ON DELETE CASCADE
);

-- 6. Tabla: Venta [cite: 388]
-- Depende de Cliente y Empleado.
CREATE TABLE Venta (
    id_venta INT AUTO_INCREMENT PRIMARY KEY,
    id_cliente INT, -- Puede ser NULL si es venta a público general sin registro
    id_empleado INT NOT NULL,
    fecha DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10, 2) NOT NULL,
    CONSTRAINT fk_venta_cliente FOREIGN KEY (id_cliente) 
        REFERENCES Cliente(id_cliente) ON DELETE SET NULL,
    CONSTRAINT fk_venta_empleado FOREIGN KEY (id_empleado) 
        REFERENCES Empleado(id_empleado) ON DELETE RESTRICT
);

-- 7. Tabla: Detalle_Venta 
-- Tabla intermedia n:m. Depende de Venta y Producto.
CREATE TABLE Detalle_Venta (
    id_detalle INT AUTO_INCREMENT PRIMARY KEY,
    id_venta INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    CONSTRAINT fk_detalle_venta FOREIGN KEY (id_venta) 
        REFERENCES Venta(id_venta) ON DELETE CASCADE,
    CONSTRAINT fk_detalle_producto FOREIGN KEY (id_producto) 
        REFERENCES Producto(id_producto) ON DELETE RESTRICT
);