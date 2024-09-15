<!DOCTYPE html>
<html>
<head>
	<title>PHP Test</title>
</head>
<body>

	<!--
		An extremely simple php server for sending messages with an html form.
		Posts are written to the file "thread01.txt".

		Run with: php -S localhost:8000
		Tutorial: https://www.w3schools.com/php/php_forms.asp
	-->
	
	<?php
		$warning = $message = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {

			// fetch post content
			$message = htmlspecialchars($_POST["message"]);

			// if valid post
			if (strlen($message) > 20) {

				// write post into a new line on the thread
				$thread = fopen("thread01.txt", "a") or die("Unable to open file!");
				fwrite($thread, "$message\n");
				fclose($thread);

				// clear form
				$message = "";

			// if invalid post
			} else {
				$warning = "Message must be longer than 20 characters!";
			}

		}
	?>

	<fieldset>
		<legend>Make post</legend>
		<form method="post">
			<input type="text" name="message" placeholder="Message body" value="<?php echo $message; ?>">
			<input type="submit" value="Submit">
		</form>
		<div style="color: red;"><?php echo $warning; ?></div>
	</fieldset>

	<?php
		// display each post in the thread on a new line
		$thread = fopen("thread01.txt", "r") or die("Unable to open file!");
		
		while (!feof($thread)) {
			echo "POST: " . fgets($thread) . "<br>";
		}

		fclose($thread);
	?>

</body>
</html>