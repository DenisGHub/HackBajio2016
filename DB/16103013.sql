CREATE TABLE coordenada
(
    id_coordenada BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre_coordenada VARCHAR(100),
    latitud_coordenada DOUBLE,
    longitud_coordenada DOUBLE,
    hora_coordenada DATETIME DEFAULT CURRENT_TIMESTAMP,
    id_usuario BIGINT(20)
);
CREATE TABLE historial
(
    id_historial BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    id_usuario BIGINT(20),
    latitud_historial DOUBLE,
    longitud_historial DOUBLE,
    hora_historial DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE usuario
(
    id_usuario BIGINT(20) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nombre_usuario VARCHAR(100),
    pass_usuario VARCHAR(255),
    nivel_usuario INT(11)
);

INSERT INTO gpsandroid.usuario (nombre_usuario, pass_usuario, nivel_usuario) VALUES ('Posicion Actual', 'cachu', 1);
INSERT INTO gpsandroid.usuario (nombre_usuario, pass_usuario, nivel_usuario) VALUES ('Camion', null, 2);
INSERT INTO gpsandroid.usuario (nombre_usuario, pass_usuario, nivel_usuario) VALUES ('Parada', null, 2);

INSERT INTO gpsandroid.coordenada (nombre_coordenada, latitud_coordenada, longitud_coordenada, hora_coordenada, id_usuario) VALUES ('Posicion Actual', 21.166411, -101.715622, '2016-06-04 00:57:59', 1);
INSERT INTO gpsandroid.coordenada (nombre_coordenada, latitud_coordenada, longitud_coordenada, hora_coordenada, id_usuario) VALUES ('Camion', 21.1661, -101.71603, '2016-10-29 18:59:21', 3);
INSERT INTO gpsandroid.coordenada (nombre_coordenada, latitud_coordenada, longitud_coordenada, hora_coordenada, id_usuario) VALUES ('Parada', 21.173108, -101.716875, '2016-10-29 20:41:00', 2);
INSERT INTO gpsandroid.coordenada (nombre_coordenada, latitud_coordenada, longitud_coordenada, hora_coordenada, id_usuario) VALUES ('Parada2', 21.170284, -101.683255, '2016-10-30 12:36:20', 2);

