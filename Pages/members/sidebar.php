<ul>
  <li>
  <?php include('side-up.php'); ?>
  </li>
  <?php if (LLibrary\Entities\User::checkAccessRights(LLibrary\Entities\User::MODO)) { ?>
  <li><?php include('side-middle.php'); ?></li>
  <?php } ?>
  <li>
  <?php include('side-down.php'); ?>
  </li>
</ul>