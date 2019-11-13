<!DOCTYPE HTML>
<HTML lang="fr">
	<HEAD>
		<title>Premiers pas avec PDO</title>
		<meta charset="UTF-8">
	</HEAD>
	<BODY>
			<?php 
				$host = 'localhost';
				$port = '3306';
				$db   = 'my_activities';
				$user = 'root';
				$pass = 'root';
				$charset = 'utf8mb4';
				$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
				$options = [
    				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    				PDO::ATTR_EMULATE_PREPARES   => false,
				];
				try {
   					$pdo = new PDO($dsn, $user, $pass, $options);
				} catch (PDOException $e) {
    				throw new PDOException($e->getMessage(), (int)$e->getCode());
				}
				
			?>
		<table>
			<?php   
				$stmt = $pdo->query('SELECT * FROM users U JOIN status S ON S.id = U.status_id ORDER BY username');
				echo '<tr><th>Id</th><th>Username</th><th>email</th><th>Status</th></tr>';
				while ($row = $stmt->fetch())
				{				
    				echo '<tr><td>'.$row['id'].'</td><td>'.$row['username'].'</td><td>'.$row['email'].'</td><td>'.$row['name'].'</td></tr>';
				}
			?>
		</table>
	</BODY>
</HTML>