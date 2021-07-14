<?php
  session_start();
  if(!isset($_SESSION['name'])){
    header("location: /paws/index.php");
  }
  $i=0; //For Pets array
  $j=0; //For vets array
  $pet_names = [];
  $pet_ids = [];
  $vet_names = [];
  $vet_ids = [];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    PAWS Dashboard
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="css/nucleo-icons.css" rel="stylesheet" />
  <link href="css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="css/bootstrapv5.css" rel="stylesheet" />

	<script src="js/jquery-1.10.2.js" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker();
  } );
  </script>
</head>

<body class="g-sidenav-show bg-gray-100">

  <div class="main-content position-relative bg-gray-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
      <div class="container-fluid py-1">
        <nav aria-label="breadcrumb">
          <h6 class="text-dark font-weight-bolder ms-2" onclick="window.location.href='index.php';">PAWS Dashboard</h6>
        </nav>
        <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            <div class="input-group">
              <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
              <input type="text" class="form-control" placeholder="Type here...">
            </div>
          </div>
          <ul class="navbar-nav justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none" onclick="window.location.href='http://pawsveterinary.000webhostapp.com/php/logout.php';">Sign Out</span>
              </a>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid">
      <div class="page-header min-height-200 border-radius-xl mt-4" style="background-position-y: 50%;">
        <span class="mask bg-gradient-success opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="img/login.png" alt="..." class="w-100 border-radius-lg shadow-sm">
              <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                <i class="fa fa-pen top-0" data-bs-placement="top" title="Edit Image" data-bs-toggle="modal" data-bs-target="#updateProfileModal"></i>
              </a>
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
              <h5 class="mb-1">
                <?php echo $_SESSION['name']?>
              </h5>
            </div>
          </div>
          <div class="col-sm-4 col-8 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
            <div class="nav-wrapper position-relative end-0">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="col-12 mt-4">
        <div class="card mb-4">
          <div class="card-header pb-0 p-3">
            <h4 class="mb-1">My Pets</h4>
            
            <button type="button" class="btn btn-outline-dark btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#updatePetModal">Update Pet info</button>
            <button type="button" class="btn btn-outline-dark btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#appointmentModal">Make an Appointment</button>
          </div>
          <div class="card-body p-3">
            <div class="row">
                <?php
                require_once 'php/db_connection.php';
                $conn = OpenCon();
                if(!isset($_SESSION['vet_id'])){
                  $sql_userPets = "SELECT id, pet_name, pet_type, pet_breed, health_status, pet_birthday FROM PETS WHERE owner_id = '$_SESSION[user_id]'";
                  $result_userPets = mysqli_query($conn,$sql_userPets);
                  if (mysqli_num_rows($result_userPets)) {
                    while($row = mysqli_fetch_array($result_userPets)) {
                      array_push($pet_names, $row['pet_name']);
                      array_push($pet_ids, $row['id']);
                      echo '<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                              <div class="card card-blog card-plain">
                                <div class="position-relative">
                                  <a class="d-block shadow-xl border-radius-xl">
                                    <img src="img/grooming.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                  </a>
                                </div>
                                <div class="card-body px-1 pb-0">
                                  <a href="javascript:;">
                                    <h5>
                                      '.$row['pet_name'].'
                                    </h5>
                                  </a>
                                  <p class="mb-4 text-sm">
                                    '.$row['health_status'].'
                                  </p>
                                </div>
                              </div>
                            </div>';
                      $i++;
                    }
                  }
                }else{
                  $sql_vetPets = "SELECT id, pet_name, pet_type, pet_breed, health_status, pet_birthday FROM PETS WHERE vet_id = '$_SESSION[vet_id]'";
                  $result_vetPets = mysqli_query($conn,$sql_vetPets);
                  if (mysqli_num_rows($result_vetPets)) {
                    while($row = mysqli_fetch_array($result_vetPets)) {
                      array_push($pet_names, $row['pet_name']);
                      array_push($pet_ids, $row['id']);
                      echo '<div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                              <div class="card card-blog card-plain">
                                <div class="position-relative">
                                  <a class="d-block shadow-xl border-radius-xl">
                                    <img src="img/grooming.jpg" alt="img-blur-shadow" class="img-fluid shadow border-radius-xl">
                                  </a>
                                </div>
                                <div class="card-body px-1 pb-0">
                                  <a href="javascript:;">
                                    <h5>
                                      '.$row['pet_name'].'
                                    </h5>
                                  </a>
                                  <p class="mb-4 text-sm">
                                    '.$row['health_status'].'
                                  </p>
                                </div>
                              </div>
                            </div>';
                      $i++;
                    }
                  }
                }
                $sql_vets = "SELECT vet_id, first_name_vet, last_name_vet FROM VETS";
                $result_vets = mysqli_query($conn,$sql_vets);
                if (mysqli_num_rows($result_vets)) {
                  while($row = mysqli_fetch_array($result_vets)) {
                    array_push($vet_names, $row['first_name_vet']." ".$row['last_name_vet']);
                    array_push($vet_ids, $row['vet_id']);
                    $j++;
                  }
                }
                CloseCon($conn);
              ?>
              <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                <div class="card h-100 card-plain border">
                  <div class="card-body d-flex flex-column justify-content-center text-center">
                    <a href="javascript:;">
                      <i class="fa fa-plus text-secondary mb-3" data-bs-toggle="modal" data-bs-target="#updatePetModal"></i>
                      <h5 class=" text-secondary" data-bs-toggle="modal" data-bs-target="#addPetModal"> Add New Pet </h5>
                      
                      <!-- Add Pet Modal -->
                        <div class="modal fade" id="addPetModal" tabindex="-1" aria-labelledby="addPetModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="addPetModalLabel">Add New Pet</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
                              </div>
                              <label>Pet Picture</label>
                              <div class="modal-body">
                                <div class="avatar avatar-xl position-relative">
                                  <img src="img/cat.png" alt="..." class="w-100 border-radius-lg shadow-sm">
                                </div>
                                <form action="php/pet_functions.php" method="post">
                                  <div class="form-group">
                                    <input type="file" class="form-control-file" id="FormControlFile1">
                                  </div>
                                  <div class="form-group">
                                    <label for="petNameInput">Name</label>
                                    <input type="text" class="form-control" id="petNameInput" placeholder="Pet Name" name="pet_name">
                                  </div>
                                  <div class="col-auto my-1">
                                    <label>Choose a vet</label>
                                    <select class="custom-select mr-sm-2 form-control" id="inlineFormCustomSelect" name="vet_id">
                                      <?php
                                      $count = 0;
                                        echo '<option value="0">Choose a Vet</option>';
                                        while($count < $j){
                                          echo '<option value="'.$vet_ids[$count].'">'.$vet_names[$count].'</option>';
                                          $count++;
                                        }
                                    ?>
                                    </select>
                                  </div>
                                  <div class="col-auto my-1">
                                    <label>Pet Type</label>
                                    <select class="custom-select mr-sm-2 form-control" id="inlineFormCustomSelect" name="pet_type">
                                      <option selected>None</option>
                                      <option value="1">Dog</option>
                                      <option value="2">Cat</option>
                                      <option value="3">Other</option>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                    <label for="petBreedInput">Breed</label>
                                    <input type="text" class="form-control" id="petBreedInput" placeholder="Pet's Breed" name="pet_breed">
                                  </div>
                                  <div class="form-group">
                                    <label for="petDescriptionInput">Description</label>
                                    <input type="text" class="form-control" id="petDescriptionInput" placeholder="Pet Description" name="health_status">
                                  </div>
                                  <div class="form-group">
                                    <label for="petBirthdayInput">Birthday Month/Year</label>
                                    <input type="date" class="form-control" id="petBirthdayInput" placeholder="Pet Birthday" name="pet_birthday">
                                  </div>
                                  <div class="form-group">
                                    <label for="weight">Weight</label>
                                    <input type="text" class="form-control" id="weight" placeholder="weight" name="weight">
                                  </div>
                                  <div class="modal-footer justify-content-between">
                                    <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn bg-gradient-success" name="pet_add">Add Pet</button>
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>

                      <!-- Update Pet Modal -->
                      <div class="modal fade" id="updatePetModal" tabindex="-1" aria-labelledby="updatePetModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="addPetModalLabel">Update Pet Info</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <label>Pet Picture</label>
                            <div class="modal-body">
                              <div class="avatar avatar-xl position-relative">
                                <img src="img/cat.png" alt="..." class="w-100 border-radius-lg shadow-sm">
                              </div>
                              <form action="php/pet_functions.php" method="post">
                                <div class="form-group">
                                  <input type="file" class="form-control-file" id="FormControlFile1">
                                </div>
                                <div class="form-group">
                                  <label for="petNameInput">Name</label>
                                  <select class="custom-select mr-sm-2 form-control" id="petNameInput" name="petNameInput">
                                    <?php
                                      $count = 0;
                                        echo '<option value="0">Choose a Pet</option>';
                                        while($count < $i){
                                          echo '<option value="'.$pet_ids[$count].'">'.$pet_names[$count].'</option>';
                                          $count++;
                                        }
                                    ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Weight</label>
                                  <input type="number" class="form-control" id="petWeight" placeholder="Pet's Weight" name="petWeight">
                                </div>
                                <div class="form-group">
                                  <label for="petDescriptionInput">Description</label>
                                  <input type="text" class="form-control" id="petDescriptionInput" placeholder="Pet Description" name="petDescriptionInput">
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn bg-gradient-danger" name="pet_delete">Delete Pet</button>
                                  <button type="submit" class="btn bg-gradient-success" name="pet_update">Saves Changes</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Update Profile Modal -->
                      <div class="modal fade" id="updateProfileModal" tabindex="-1" aria-labelledby="updateProfileModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="updateProfileModalLabel">Update Profile Info</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form>
                                <div class="form-group">
                                  <label for="first_name">First Name</label>
                                  <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name">
                                </div>
                                <div class="form-group">
                                  <label for="last_name">Last Name</label>
                                  <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name">
                                </div>
                                <div class="form-group">
                                  <label for="address">Address</label>
                                  <input type="text" class="form-control" id="address" name="address" placeholder="Address">
                                </div>
                                <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                                </div>
                                <div class="form-group">
                                  <label for="psw"><b>Password</b></label>
                                  <input type="password" class="form-control" placeholder="Password" name="psw" required>
                                </div>
                                <div class="form-group">
                                  <label for="psw-repeat"><b>Repeat Password</b></label>
                                  <input type="password" class="form-control" placeholder="Repeat Password" name="psw-repeat" required>
                                </div>
                              </form>
                            </div>
                            <div class="modal-footer justify-content-between">
                              <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Close</button>
                              <button type="button" class="btn bg-gradient-success">Saves Changes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Appointment Modal -->
                      <div class="modal fade" id="appointmentModal" tabindex="-1" aria-labelledby="appointmentModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="updateProfileModalLabel">Make/Update Appointment</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="php/appointment_function.php" method="post">
                                <!-- Form start -->
                                <div class="row">
                                    <!-- Text input-->
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label" for="pname">Pet</label>
                                        <select id="pname" name="pet_id" class="form-control">
                                          <?php 
                                            $count = 0;
                                            while($count < $i){
                                              echo '<option value="'.$pet_ids[$count].'">'.$pet_names[$count].'</option>';
                                              $count++;
                                            }
                                          ?>
                                        </select>
                                      </div>
                                    </div>
                                    <!-- Date input-->
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label" for="app_date">Date:</label><p>
                                        <input type="date" id="app_date" name="app_date"> 
                                      </div>
                                    </div>
                                    <!-- Select Time -->
                                    <div class="col-md-6">
                                          <div class="form-group">
                                              <label class="control-label" for="time">Preferred Time</label>
                                              <select id="time" name="time" class="form-control">
                                                <option value="08:00:00">08:00</option>
                                                <option value="09:00:00">09:00</option>
                                                <option value="10:00:00">10:00</option>
                                                <option value="11:00:00">11:00</option>
                                                <option value="12:00:00">12:00</option>
                                                <option value="13:00:00">01:00</option>
                                                <option value="14:00:00">02:00</option>
                                                <option value="15:00:00">03:00</option>
                                            </select>
                                          </div>
                                    </div>
                                    <!-- Select Service -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label" for="appointmentfor">Appointment For</label>
                                            <select id="appointmentfor" name="app_type" class="form-control">
                                                <option value="1">Pet Hotel</option>
                                                <option value="2">Veterinaty Care</option>
                                                <option value="3">Grooming</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-between">
                                  <button type="button" class="btn bg-gradient-dark" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn bg-gradient-success" onclick="window.location.href='php/appointment_function.php';">Saves Changes</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12 col-xl-4">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <h4 class="mb-0">Upcoming Events</h4>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <?php
                  require_once 'php/db_connection.php';
                  $conn = OpenCon();
                  if(!isset($_SESSION['vet_id'])){
                  $sql_search_apps = "SELECT PETS.pet_name, VET_APPOINTMENTS.app_date, VET_APPOINTMENTS.app_time, VET_APPOINTMENTS.app_type FROM VET_APPOINTMENTS LEFT JOIN PETS ON VET_APPOINTMENTS.pet_id = PETS.id WHERE PETS.owner_id=$_SESSION[user_id]";
                  }else{
                      $sql_search_apps = "SELECT PETS.pet_name, VET_APPOINTMENTS.app_date, VET_APPOINTMENTS.app_time, VET_APPOINTMENTS.app_type FROM VET_APPOINTMENTS LEFT JOIN PETS ON VET_APPOINTMENTS.pet_id = PETS.id WHERE PETS.vet_id=$_SESSION[vet_id]";
                  }
                  $result_search_apps = mysqli_query($conn,$sql_search_apps);
                  if (mysqli_num_rows($result_search_apps)) {
                      $app_type;
                    while($row = mysqli_fetch_array($result_search_apps)) {
                        switch($row[3]){
                            case 1:
                                $app_type="Pet Hotel";
                            break;
                            case 2:
                                $app_type="Veterinary Care";
                            break;
                            case 3:
                                $app_type="Grooming";
                            break;
                            default:
                                $app_type="Error loading type of appointment";
                            break;
                        }
                      echo '<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                              <div class="avatar me-3">
                                <img src="img/care.jpg" alt="kal" class="border-radius-lg shadow">
                              </div>
                              <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">'.$row[0].'</h6>
                                <p class="mb-0 text-xs">'.$app_type.' '.$row[1].' '.$row[2].'</p>
                              </div>
                              
                            </li>';
                    }
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-4">
          <div class="card h-50">
            <div class="card-header pb-0 p-3">
              <h4 class="mb-0">Notification Settings</h4>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Email me for upcoming appointments</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Email me when I missed and appointment</label>
                  </div>
                </li>
                <li class="list-group-item border-0 px-0">
                  <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked>
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Email me Promo and Discounts</label>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-12 col-xl-4">
          <div class="card h-50">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h4 class="mb-0">Profile Information</h4>
                </div>
                <div class="col-md-4 text-right">
                  <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-placement="top" title="Edit Profile" data-bs-toggle="modal" data-bs-target="#updateProfileModal"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <hr class="horizontal gray-light my-1">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; <?php echo $_SESSION['name'] ?></li>
                <?php if(isset($_SESSION['vet_id'])){
                  echo '<li class='.'"list-group-item border-0 ps-0 text-sm"'.'><strong class="text-dark">Vet ID:</strong> &nbsp;'.$_SESSION['vet_id'].'</li>';
                }else{
                  echo '<li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Address:</strong> &nbsp;'.$_SESSION['address'].'</li>';
                }
                ?> 
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?php echo $_SESSION['email'] ?></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    $('.datepicker').datepicker({
        weekStart:1,
        color: 'red'
    });
   </script>
</body>

</html>