<?php
include 'admin-includes/admin-header.php';
if (!$admin->isLoggedIn()) {
    Redirect::to('admin-login.php');
}
?>
<div class='maincontainer'>
    <button class="btn btn-primary" id="addCity">+ Dodaj novi grad</button>
    <input type="text" id="search" class="form-control form-control-lg" placeholder="Pronadji grad"><i class="fas fa-search"></i>
    <div id="cities">
    </div>
</div>
</div> <!-- //maincontainer -->
<script src="js/Classes/UI.js"></script>
<script src="js/address.js"></script>
<?php
include 'admin-includes/admin-footer.php';
?> 