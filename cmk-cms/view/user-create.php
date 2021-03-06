<?php
if ( !isset($view_files) )
{
	require '../config.php';
	$include_path = '../' . $include_path;
}
?>

	<div class="page-title">
	<span class="title">
		<?php
		// Get icon and title from Array $files, defined in config.php
		echo $view_files['user-create']['icon'] . ' ' . $view_files['user-create']['title']
		?>
	</span>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="card-title">
				<div class="title"><?php echo CREATE_ITEM ?></div>
			</div>
		</div>

		<div class="card-body">
			<form method="post" data-page="user-create">
				<?php
				// Save variables with empty values, to be used in the forms input values
				$name = $email = $role = $password_required_label = '';
				$password_required = 'required';

				// If the form has been submitted
				if ( isset($_POST['save_item']) )
				{
					// Escape inputs and save values to variables defined before with empty value
					$name	= $mysqli->escape_string($_POST['name']);
					$email	= $mysqli->escape_string($_POST['email']);
					$role	= intval($_POST['role']);

					// If one of the required fields is empty, show alert
					if ( empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password']) || empty($_POST['role']) )
					{
						alert('warning', REQUIRED_FIELDS_EMPTY);
					}
					// If all required fields is not empty, continue
					else
					{
						// Match users with this email
						$query =
							"SELECT 
							user_id 
						FROM 
							users 
						WHERE 
							user_email = '$email'";
						$result = $mysqli->query($query);

						// If result returns false, use the function query_error to show debugging info
						if (!$result)
						{
							query_error($query, __LINE__, __FILE__);
						}

						// If any rows was found, the email is not available, so show alert
						if ($result->num_rows > 0)
						{
							alert('warning', EMAIL_NOT_AVAILABLE);
						}
						// If email is available, continue
						else
						{
							// If the typed password isn't the same, show alert
							if ($_POST['password'] != $_POST['confirm_password'])
							{
								alert('warning', PASSWORD_MISMATCH);
							}
							// If the password matched, continue
							else
							{
								// Use password_hash with the algorithm from the predefined constant PASSWORD_DEFAULT, and default cost
								$password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);

								// Insert the user to the database
								$query =
									"INSERT INTO 
									users (user_name, user_email, user_password, fk_role_id) 
								VALUES ('$name', '$email', '$password_hash', $role)";
								$result = $mysqli->query($query);

								// If result returns false, use the function query_error to show debugging info
								if (!$result)
								{
									query_error($query, __LINE__, __FILE__);
								}

								// Get the newly created user id
								$user_id = $mysqli->insert_id;

								// Use function to insert event in log
								create_event('create', 'af brugeren <a href="index.php?page=user-edit&id=' . $user_id . '" data-page="user-edit" data-params="id='. $user_id . '">' . $name . '</a>', 100);

								alert('success', ITEM_CREATED . ' <a href="index.php?page=users" data-page="users">' . RETURN_TO_OVERVIEW . '</a>');
							}
						} // Closes else to: if ($result->num_rows > 0)
					} // Closes: ( empty($_POST['name']) || empty($_POST['email'])...
				} // Closes: if ( isset($_POST['save_item']) )

				include $include_path . 'form-user.php'
				?>
			</form>
		</div>
	</div>

<?php
if (DEVELOPER_STATUS) { show_developer_info(); }
