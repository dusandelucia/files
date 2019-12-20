<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
	Redirect::to('admin-login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin</title>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.18.0/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
	<link rel="stylesheet" href="css/admin-styles.css">
</head>
<body>
	<div id="admin-board">
		<div id="hours-graphic">
			<canvas id="hoursChart"></canvas>
		</div>
		<div id="months-graphic">
			<div id="currentStats">
				<div id="month"></div>
				<div id="today"></div>
			</div>
			<canvas id="monthsChart"></canvas>
		</div>
		<div>
			<div id="statistics">
				<div class="form-field">
					<h4>Pocetni datum:</h4>
					<input value="yyyy-mm-dd" type="date" name="startingDate" id="startingDate">
				</div>
				<div class="form-field">
					<h4>Zavrsni datum:</h4>
					<input type="date" name="endingDate" id="endingDate">
				</div>
				<div class="form-field">
					<h4>Izaberite vozaca:</h4>
					<select id="drivers">
						<option value="">-- Svi vozaci --</option>
					</select>
				</div>
				<button type="submit" id="submit">Potvrdi</button>
			</div>
			<div id="custom-results">
				<div>Ukupni pazar: <span class="total-earnings"></span></div>
				<div>Kilometara odvozeno: <span class="distance-traveled"></span></div>
				<div>Broj voznji: <span class="num-of-rides"></span></div>
			</div>
		</div>
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" id="token">
	<script src="js/Classes/UI.js"></script>
	<script src="js/admin-board.js"></script>
	<script src="js/charts.js"></script>
<?php
include 'admin-includes/admin-footer.php';
?>
