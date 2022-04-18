CREATE TABLE "roles" (
	"id" serial NOT NULL PRIMARY KEY,
	"rol" varchar(200) NOT NULL
);

CREATE TABLE "empresas" (
	"id" serial NOT NULL PRIMARY KEY,
	"nombre" varchar(255) NOT NULL,
	"telefono" varchar(100) NOT NULL,
	"cantidad" integer NOT NULL,
	"email" varchar(100) NOT NULL UNIQUE,
	"precio" float(10) NOT NULL,
	"propietario" varchar(100) NOT NULL,
	"direccion" varchar(200) NULL
);

CREATE TABLE "usuarios" (
	"id" serial NOT NULL PRIMARY KEY,
	"nombre" varchar(100) NOT NULL,
	"apellido" varchar(100) NOT NULL,
	"email" varchar(200) NOT NULL UNIQUE,
	"password" varchar(100) NOT NULL,
	"telefono" varchar(100) NOT NULL,
	"id_rol" integer NOT NULL,
	"id_empresa" integer NULL,
	FOREIGN KEY ("id_rol") REFERENCES "roles" ("id"),
	FOREIGN KEY ("id_empresa") REFERENCES "empresas" ("id")
);

CREATE TABLE "parameters" (
  "id" serial NOT NULL PRIMARY KEY,
  "name" varchar(100) NOT NULL,
  "parameter" varchar(100) NOT NULL
);

--CREACION DE COLUMNA GEOMTRICA--
SELECT AddGeometryColumn('','empresas','the_geom','4326','POINT',2);

--CREACION DE ROLES POR DEFECTO--

INSERT INTO "roles" ("rol") VALUES ('admin');
INSERT INTO "roles" ("rol") VALUES ('empresa');
INSERT INTO "roles" ("rol") VALUES ('usuario');

--CREACION DE TABLAS DE CANCHAS--

INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('UEFA FUTBOL 5','3173211920','2','a1@algo.com',50000,'Juan1Perez1','C 70 N # 5N-22',ST_GeomFromText('POINT(-76.521828225700000 3.493761510930000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('WEMBLEY','3006554960','3','a2@algo.com',65000,'Juan2Perez2','A 3B N # 58-48',ST_GeomFromText('POINT(-76.511644086499900 3.487735301250000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('LA COPA FUTBOL 5','3105006627','2','a3@algo.com',70000,'Juan3Perez3','C 56 # 5N -120',ST_GeomFromText('POINT(-76.504595183199900 3.482440365920000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('SOCCER PLAY','3175130630','1','a4@algo.com',50000,'Juan4Perez4','K 1B # 59-00',ST_GeomFromText('POINT(-76.497301150499900 3.477274531310000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('CAMP NOU NORTE','3749535000','2','a5@algo.com',50000,'Juan5Perez5','C 69  #  4A-22',ST_GeomFromText('POINT(-76.487004600999900 3.468690458190000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('LA BOMBONERA','3162703434','5','a6@algo.com',70000,'Juan6Perez6','K 5 N  # 25-25',ST_GeomFromText('POINT(-76.505902800200000 3.479176501860000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('BERNABEU','3155912593','4','a7@algo.com',75000,'Juan7Perez7','K 5 N  # 52-25',ST_GeomFromText('POINT(-76.504773152599900 3.478804178620000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('CHIPIFUTBOL','3146641643','3','a8@algo.com',60000,'Juan8Perez8','C 40 N  # 6-45',ST_GeomFromText('POINT(-76.526839153200000 3.479321114840000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('FUTBOL 5 LA PRIMERA','3207052901','2','a9@algo.com',80000,'Juan9Perez9','K 1  # 46-00',ST_GeomFromText('POINT(-76.508223753600000 3.471678135300000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('LA CALDERA','3148880595','2','a10@algo.com',56000,'Juan10Perez10','A 4 # 30N - 67',ST_GeomFromText('POINT(-76.527004474899900 3.472370401520000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('MARACANA NORTE','3173265421','3','a11@algo.com',60000,'Juan11Perez11','C 33A N # 2N . 01',ST_GeomFromText('POINT(-76.520015236999900 3.469877969360000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('PARQUE DEL AVION','3158393695','3','a12@algo.com',70000,'Juan12Perez12','A 2 # 35A - 04',ST_GeomFromText('POINT(-76.517658526199900 3.469029586540000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('CAMPO VERDE','3007513271','3','a13@algo.com',60000,'Juan13Perez13','K 7U  # 43-149',ST_GeomFromText('POINT(-76.473004440200000 3.453161822090000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('LA CANCHA RIO CAUCA','3105023765','2','a14@algo.com',60000,'Juan14Perez14','C 75 B # 20-170',ST_GeomFromText('POINT(-76.477916174599900 3.442054319770000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('PASCUALITO NORTE','3148906433','3','a15@algo.com',70000,'Juan15Perez15','K 8 -3 39 - 01',ST_GeomFromText('POINT(-76.506199511899900 3.453764441330000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('PASION FUTBOL','3117864619','4','a16@algo.com',60000,'Juan16Perez16','C 27 # 2 - 70',ST_GeomFromText('POINT(-76.519343953299900 3.459437996760000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('FORZA AZZURRI F.C','4832820000','3','a17@algo.com',60000,'Juan17Perez17','C 21 # 2- 74',ST_GeomFromText('POINT(-76.525721693099900 3.456958205900000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('PASCUAL OBRERO','3218881808','1','a18@algo.com',60000,'Juan18Perez18','K 12 # 22A - 51',ST_GeomFromText('POINT(-76.519897665900000 3.446968411660000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('SINDICAL','4452579000','1','a19@algo.com',60000,'Juan19Perez19','K 28C # 44 - 80',ST_GeomFromText('POINT(-76.502705192999900 3.430490297670000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('EL PASCUAL','3841790000','2','a20@algo.com',60000,'Juan20Perez20','K 36 # 5B - 04',ST_GeomFromText('POINT(-76.540214243099900 3.426932398620000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('JAC EL DORADO','3106448231','1','a21@algo.com',50000,'Juan21Perez21','C 13 # 37 - 00',ST_GeomFromText('POINT(-76.531166428000000 3.421570901520000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('MBOMBELA','3017502001','2','a22@algo.com',70000,'Juan22Perez22','K 41 # 31B - 40',ST_GeomFromText('POINT(-76.512377230200000 3.416007910340000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('PASCUALITO SUR','3128430779','2','a23@algo.com',60000,'Juan23Perez23','C 5E # 38 - 28',ST_GeomFromText('POINT(-76.542703494799900 3.423682751940000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('CARIOCA','3174309213','2','a24@algo.com',70000,'Juan24Perez24','C 9 # 42 - 81',ST_GeomFromText('POINT(-76.539053059300000 3.418133101010000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('MEGALASTRA','3154110859','3','a25@algo.com',90000,'Juan25Perez25','C 9 # 42 - 156',ST_GeomFromText('POINT(-76.540343996399900 3.417253340990000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('COMPLEJO DEPORTIVO 5-0','3206249543','3','a26@algo.com',80000,'Juan26Perez26','C 9B # 46 - 103',ST_GeomFromText('POINT(-76.539123781800000 3.414056108180000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('FUERA DE LUGAR','3218032289','2','a27@algo.com',70000,'Juan27Perez27','C 16 #  52 - 15',ST_GeomFromText('POINT(-76.527117516299900 3.404888595760000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('EUFORIA','3956619000','2','a28@algo.com',60000,'Juan28Perez28','K 56 # 12A . 01',ST_GeomFromText('POINT(-76.536378687799900 3.405765573830000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('PRIMERO DE MAYO','3177793391','2','a29@algo.com',50000,'Juan29Perez29','K 57 # 13F - 00',ST_GeomFromText('POINT(-76.533018628299900 3.402692741780000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('MARACAN SUR','3174326390','3','a30@algo.com',90000,'Juan30Perez30','C 16 # 53 - 163',ST_GeomFromText('POINT(-76.527041739900000 3.402940959140000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('UNIDAD RECREATIVA CAÃAVERAL','3317683000','1','a31@algo.com',60000,'Juan31Perez31','K 61 # 18A - 35',ST_GeomFromText('POINT(-76.524057639099900 3.400321718540000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('USC EUFORIA','3137325750','1','a32@algo.com',70000,'Juan32Perez32','C 5 # 62 - 05',ST_GeomFromText('POINT(-76.548648886799900 3.402881719300000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('LA TOKATA','3012057532','1','a33@algo.com',60000,'Juan33Perez33','C 6A # 63A - 15',ST_GeomFromText('POINT(-76.544997770699900 3.400820845830000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('ZATHURA','3136398153','2','a34@algo.com',60000,'Juan34Perez34','K 66 # 18 - 00',ST_GeomFromText('POINT(-76.525389469999900 3.397499368740000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('OLIMPICO F.C','3113141477','2','a35@algo.com',60000,'Juan35Perez35','C 13 A 1 # 68 - 99',ST_GeomFromText('POINT(-76.535502059099900 3.395062553100000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('MORUMBI','3145228465','5','a36@algo.com',80000,'Juan36Perez36','C13 A  1 # 69-99',ST_GeomFromText('POINT(-76.535674151600000 3.393856767220000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('CAMP NOU  SUR','3749535000','2','a37@algo.com',70000,'Juan37Perez37','K 79 # 14 - 200',ST_GeomFromText('POINT(-76.531394123699900 3.392576689050000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('TIRO DE ESQUINA','3113933830','2','a38@algo.com',60000,'Juan38Perez38','C 13 # 70 - 00',ST_GeomFromText('POINT(-76.537862154300000 3.393120668360000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('CALDERON','3156456691','3','a39@algo.com',70000,'Juan39Perez39','K 80 # 28 - 16',ST_GeomFromText('POINT(-76.522337018700000 3.387049027820000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('DIABLO AZTECA','3130443000','3','a40@algo.com',70000,'Juan40Perez40','K 80 # 13 -20',ST_GeomFromText('POINT(-76.538006650699900 3.386568623720000)',4326));
INSERT INTO "empresas" ("nombre", "telefono", "cantidad", "email", "precio","propietario", "direccion","the_geom") VALUES('LOS DELFINES','3045880275','1','a41@algo.com',50000,'Juan41Perez41','K 41H # 39 - 09',ST_GeomFromText('POINT(-76.511554573100000 3.412532550620000)',4326));

--TABLAS POR DEFECTO USADAS--

--CREACION DE ADMIN--
INSERT INTO "usuarios" ("nombre", "apellido", "email", "password", "telefono", "id_rol") 
VALUES ('admin', 'admin', 'admin@admin.com', md5('admin'), '1234455', (select "id" from "roles" where "rol" = 'admin'));

--CREACION DEL USER--
INSERT INTO "usuarios" ("nombre", "apellido", "email", "password", "telefono", "id_rol") 
VALUES ('usuario', 'usuario', 'usuario@usuario.com', md5('user'), '1234455', (select id from "roles" where "rol" = 'usuario'));

--CREACION DEL USER ADMIN EMPRESA--
INSERT INTO "usuarios" ("nombre", "apellido", "email", "password", "telefono", "id_rol", "id_empresa") 
VALUES ('empresa', 'empresa', 'empresa@empresa.com', md5('empresa'), '1234455', (select "id" from "roles" where "rol" = 'empresa'), (select "id" from "empresas" where "email" = 'cancha@cancha.com'));

INSERT INTO "parameters" ("name", "parameter") VALUES ('ID_ADMIN', (select "id" from "roles" where "rol" = 'admin'));
INSERT INTO "parameters" ("name", "parameter") VALUES ('ID_EMPRESA', (select "id" from "roles" where "rol" = 'empresa'));
INSERT INTO "parameters" ("name", "parameter") VALUES ('ID_USER', (select "id" from "roles" where "rol" = 'usuario'));
INSERT INTO "parameters" ("name", "parameter") VALUES ('COMPANY_NAME', 'SIG CANCHAS');
INSERT INTO "parameters" ("name", "parameter") VALUES ('COMPANY_ABBREVIATION', 'SC');