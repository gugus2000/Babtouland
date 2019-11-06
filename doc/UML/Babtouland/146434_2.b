class BDDFactory
!!!239106.php!!!	MysqlConnexion(in dbname :  = 'babtouland')

		$bdd = new \PDO('mysql:host=localhost;dbname='.$dbname.';charset=utf8', 'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
		return $bdd;
