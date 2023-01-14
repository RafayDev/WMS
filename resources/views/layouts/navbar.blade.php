<style>
.dropbtn {
  background-color: white;
  color: black;
  border: none;
}

.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: white;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {}
</style>
<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
<div class="container"> 
    <div class="row">
        <div class="col-md-10">
        </div>
        <div class="col-md-2">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="/home">Overview</a>
      </li>
      <li class="nav-item dropdown dropdown">
                <a id="navbarDropdown" class="nav-link dropdown dropbtn" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false" >
                     Inventory
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-content" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="/add-product">
                        Add Products
                  </a>
                  <a class="dropdown-item" href="/list-products">
                        Listed Products
                  </a>
               </div>
        </li>
    </ul>
</div>
    <!-- <div class="col-md-4">
        </div> -->
  </div>
  </div>
</div>
</nav>
