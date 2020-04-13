<style media="screen">
  .navbar .nav-link {
    padding: 1px;
  }
</style>
<nav class="navbar  navbar-default fixed-top bg-dark flex-md-nowrap p-0 shadow">
 <a class="navbar navbar-default col-sm-3 col-md-2 mr-0" href="#">Administrador</a>
 <ul class="navbar-nav px-3">
   <li id="link_session" class="nav-item text-nowrap">
     <?php
       $uriAr = explode("/", $_SERVER['REQUEST_URI']);
       $page = end($uriAr);

       if (isset($_SESSION['admin_id'])) {
         ?>
           <a class="nav-link" href="../admin/admin-logout.php">Sign out</a>
         <?php
       }else{
         if ($page === "login.php") {
           ?>
             <a class="nav-link" href="../admin/register.php">Register</a>
           <?php
         }else{
           ?>
             <a class=" nav-link" href="../admin/login.php">Login</a>
           <?php
         }
       }
     ?>
   </li>
 </ul>
 <div class=" navbar navbar-header ">
   
 </div>
 <div class="collapse navbar-collapse" id="collapse">
   <ul class="nav navbar-nav">

     <li class="nav-item">
       <?php if (isset($_SESSION['admin_id'])): ?>
         <a class="nav-link" href="../admin/admin-logout.php">
           <span data-feather="power"></span>
           Cerrar sesión
         </a>
       <?php endif; ?>
     </li>

     
 </div>
</nav>
