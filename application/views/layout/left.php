<div class="sidebar-left">
  <h4>menu</h4>
  <ul class="menu_link">
      <li <?php echo (!isset($menu_item) || $menu_item == 'index' ? 'class="active"' : '') ?>><?php echo anchor('dashboard', 'dashboard');?></li>
      <li <?php echo (isset($menu_item) && $menu_item == 'profile' ? 'class="active"' : '') ?>><?php echo anchor('profile', 'my profile');?></li>
      <li <?php echo (isset($menu_item) && $menu_item == 'friends' ? 'class="active"' : '') ?>><?php echo anchor('friends', 'friends');?></li>
      <li <?php echo (isset($menu_item) && $menu_item == 'notifications' ? 'class="active"' : '') ?>><?php echo anchor('notifications', 'notifications');?></li>
      <li <?php echo (isset($menu_item) && $menu_item == 'messages' ? 'class="active"' : '') ?>><?php echo anchor('messages', 'messages');?></li>
      <li><a href="#">Favorite stops</a></li>
      <li><a href="#">truckers lounge</a></li>
      <li><a href="#">career center</a></li>
  </ul>
    <form>
    	<input type="search" value="SEARCH ZIP"/>
    	<button type="button"> </button>
     </form>
</div>