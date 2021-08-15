<aside class="left-sidebar">
   <div class="scroll-sidebar">
      <nav class="sidebar-nav">
         <ul id="sidebarnav">
            <?php
            $role_id = $this->session->userdata('role_id');
            $get_group_menu = $this->accesscontrol->getGroupMenuByRole($role_id);
            if ($get_group_menu->num_rows() > 0) {
               foreach ($get_group_menu->result() as $group_menu) {
                  $get_menu = $this->accesscontrol->getMenuByGroup($group_menu->group_menu_id, $role_id);
                  if ($get_menu->num_rows() == 1) {
                     $menu = $get_menu->row();
            ?>
                     <li <?php echo ($menu->menu_id == $menu_id ? 'class = "active"' : ''); ?>>
                        <a href="<?php echo $menu->menu_status_id == 3 ? 'javascript:void(0);' : base_url($menu->menu_link); ?>">
                           <i class="<?php echo $group_menu->group_menu_icon ?>"></i> <span class="hide-menu"><?php echo $group_menu->group_menu_name; ?></span>
                        </a>
                     </li>
                  <?php
                  } else if ($get_menu->num_rows() >= 2) {
                  ?>
                     <li <?php echo ($group_menu->group_menu_id == $group_id ? 'class="active"' : ''); ?>>
                        <a class="has-arrow" href="#" aria-expanded="false"><i class="<?php echo $group_menu->group_menu_icon ?>"></i><span class="hide-menu"><?php echo $group_menu->group_menu_name; ?></span></a>
                        <ul aria-expanded="false" class="collapse">
                           <?php
                           if ($get_menu->num_rows() > 0) {
                              foreach ($get_menu->result() as $menu) {
                           ?>
                                 <li <?php echo $menu->menu_id == $menu_id ? 'class = "active"' : ''; ?>>
                                    <a <?php echo $menu->menu_openlink == 1 ? 'target="_blank"' : ''; ?> href="<?php echo $menu->menu_status_id == 3 ? 'javascript:void(0);' : base_url($menu->menu_link); ?>" <?php echo $menu->menu_id == $menu_id ? 'class="active"' : ''; ?>>
                                       <?php echo $menu->menu_name; ?>
                                    </a>
                                 </li>
                           <?php
                              }
                           }
                           ?>
                        </ul>
                     </li>
            <?php
                  }
               }
            }
            ?>
            <!--
            <li>
               <a href="#" target="_blank"><i class="fa fa-file-pdf-o"></i><span class="hide-menu">เอกสารคู่มือ</span></a>                  
            </li>
            -->
         </ul>
      </nav>
   </div>
</aside>

<div class="page-wrapper">
   <div class="container-fluid">