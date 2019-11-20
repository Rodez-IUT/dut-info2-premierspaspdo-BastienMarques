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
				
				function get($name) {
					return isset($_GET[$name]) ? $_GET[$name] : null;
					}
			?>
		<form action="all_users.php" method="get">
			Start with letter:
			<input name="start_letter" type="text" value="<?php echo get("start_letter") ?>">
			and status is:
			<select name="status_id">
				<option value="1" <?php if (get("status_id") == 1) echo 'selected' ?>>Waiting for account validation</option>
				<option value="2" <?php if (get("status_id") == 2) echo 'selected' ?>>Active account</option>
			</select>
			<input type="submit" value="OK">
		</form>
		<table>
			<tr>
				<th>Id</th>
				<th>Username</th>
				<th>email</th>
				<th>Status</th>
			</tr>';
			<?php
				$wUser = htmlspecialchars(get("start_letter"));
				$wStatus = $_GET["status"];
				$stmt = $pdo->query("SELECT *
									FROM users U
									JOIN status S
									ON S.id = U.status_id
									WHERE U.username LIKE '$wUser%'
									AND S.id = '$wStatus'
									ORDER BY username");
				while ($row = $stmt->fetch())
				{				
    				echo '<tr><td>'.$row['id'].'</td><td>'.$row['username'].'</td><td>'.$row['email'].'</td><td>'.$row['name'].'</td></tr>';
				}
			?>
		</table>
	</BODY>
</HTML>