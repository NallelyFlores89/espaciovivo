DROP TABLE IF EXISTS `catalogue_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalogue_states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(2) NOT NULL,
  `name` varchar(45) NOT NULL,
  `abrev` varchar(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=utf8 COMMENT='Tabla de Estados de la República Mexicana';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estados`
--

LOCK TABLES `catalogue_states` WRITE;
/*!40000 ALTER TABLE `catalogue_states` DISABLE KEYS */;
INSERT INTO `catalogue_states` VALUES (1,'01','Aguascalientes','Ags.'),(2,'02','Baja California','BC'),(3,'03','Baja California Sur','BCS'),(4,'04','Campeche','Camp.'),(5,'05','Coahuila de Zaragoza','Coah.'),(6,'06','Colima','Col.'),(7,'07','Chiapas','Chis.'),(8,'08','Chihuahua','Chih.'),(9,'09','Distrito Federal','DF'),(10,'10','Durango','Dgo.'),(11,'11','Guanajuato','Gto.'),(12,'12','Guerrero','Gro.'),(13,'13','Hidalgo','Hgo.'),(14,'14','Jalisco','Jal.'),(15,'15','México','Mex.'),(16,'16','Michoacán de Ocampo','Mich.'),(17,'17','Morelos','Mor.'),(18,'18','Nayarit','Nay.'),(19,'19','Nuevo León','NL'),(20,'20','Oaxaca','Oax.'),(21,'21','Puebla','Pue.'),(22,'22','Querétaro','Qro.'),(23,'23','Quintana Roo','Q. Roo'),(24,'24','San Luis Potosí','SLP'),(25,'25','Sinaloa','Sin.'),(26,'26','Sonora','Son.'),(27,'27','Tabasco','Tab.'),(28,'28','Tamaulipas','Tamps.'),(29,'29','Tlaxcala','Tlax.'),(30,'30','Veracruz de Ignacio de la Llave','Ver.'),(31,'31','Yucatán','Yuc.'),(32,'32','Zacatecas','Zac.');
/*!40000 ALTER TABLE `catalogue_states` ENABLE KEYS */;
UNLOCK TABLES;