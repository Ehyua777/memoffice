<script src="../../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css">
<ul id="MenuBar1" class="MenuBarVertical">
  <li><a class="MenuBarItemSubmenu" href="#">Elément 1</a>
    <ul>
      <li><a href="#">Elément 1.1</a></li>
      <li><a href="#">Elément 1.2</a></li>
      <li><a href="#">Elément 1.3</a></li>
    </ul>
  </li>
  <li><a href="#">Elément 2</a></li>
  <li><a class="MenuBarItemSubmenu" href="#">Elément 3</a>
    <ul>
      <li><a class="MenuBarItemSubmenu" href="#">Elément 3.1</a>
        <ul>
          <li><a href="#">Elément 3.1.1</a></li>
          <li><a href="#">Elément 3.1.2</a></li>
        </ul>
      </li>
      <li><a href="#">Elément 3.2</a></li>
      <li><a href="#">Elément 3.3</a></li>
    </ul>
  </li>
  <li><a href="#">Elément 4</a></li>
</ul>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
