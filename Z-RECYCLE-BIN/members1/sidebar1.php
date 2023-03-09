<ul>
   <li id="search">
	   <h2>Search</h2>
        <?php include('../../Templates/default/middle/search-form.php'); ?>
   </li>
   <?php if ($id!=0){ include('../../Pages/members/side-up.php'); } ?>
   <?php if (User::checkAccessRights(User::MODO)) { ?>
   <?php include('../../Pages/members/side-middle.php'); ?>
   <?php } ?>
   <li>
				<h2>faucibus lobortis </h2>
				<ul>
					<li><a href="#">Nec metus sed donec</a></li>
					<li><a href="#">Magna lacus bibendum mauris</a></li>
					<li><a href="#">Velit semper nisi molestie</a></li>
					<li><a href="#">Eget tempor eget nonummy</a></li>
					<li><a href="#">Nec metus sed donec</a></li>
					<li><a href="#">Magna lacus bibendum mauris</a></li>
					<li><a href="#">Velit semper nisi molestie</a></li>
				</ul>
			</li>
		</ul>
	