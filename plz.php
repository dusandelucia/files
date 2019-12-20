<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
?>
<div class='maincontainer'>
    <button class="btn btn-primary" id="addPlz">+ Dodaj novi plz</button>
    <input type="text" id="search" class="form-control form-control-lg" placeholder="Pronadji plz"><i class="fas fa-search"></i>
    <div id="plz">
    </div>
</div>
</div> <!-- //maincontainer -->
<script src="js/Classes/UI.js"></script>
<script src="js/plz.js"></script>
<?php
include 'admin-includes/admin-footer.php';
?> 