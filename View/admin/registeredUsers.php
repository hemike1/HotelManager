
<div class="m-3 ms-5 ">
	<div>
		<!--buttons-->
	</div>
	<div>
		<table class="table">
			<thead>
			<tr>
				<th scope="col">ID</th>
                <th scope="col">Vezetéknév</th>
                <th scope="col">Keresztnév</th>
				<th scope="col">Email</th>
				<th scope="col">Jogosultság</th>
			</tr>
			</thead>
			<tbody>
				<?php
                    foreach($getuser as $users) {
						echo '<tr>
                        <td>' . $users['id'] . '</td>
                        <td>' . $users['ln'] . '</td>
					    <td>' . $users['fn'] . '</td>
                        <td>' . $users['email'] . '</td>
                        <td>' . $users['perm'] . '</td>
					    </tr>';
					}
                    ?>
			</tbody>
		</table>
	</div>
</div>
