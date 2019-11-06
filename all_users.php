<!DOCTYPE HTML>
<HTML lang="fr">
	<HEAD>
		<title>Premiers pas avec PDO</title>
		<meta charset="UTF-8">		
	</HEAD>
	<BODY>
		<table>
			<?php 
				$host = 'localhost';
				$db   = 'my_activities';
				$user = 'root';
				$pass = 'root';
				$charset = 'utf8mb4';
				$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
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
				<tr>
					<td>
						<?php   
							$stmt = $pdo->query('SELECT id FROM users');
							while ($row = $stmt->fetch())
							{
    							echo $row['id'] . "\n";
							}
						?>
					</td>
					<td>
						<?php
							$stmt = $pdo->query('SELECT username FROM users');
							while ($row = $stmt->fetch())
							{
    							echo $row['username'] . "\n";
							}						
						?>
					</td>
					<td>
						<?php
							$stmt = $pdo->query('SELECT email FROM users');
							while ($row = $stmt->fetch())
							{
    							echo $row['email'] . "\n";
							}						
						?>
					</td>
				</tr>
			<?php ?>
		</table>
	</BODY>
</HTML>