 <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <div class="nav-link">
                <div class="profile-image">
                  <img src="images/org.png" alt="image"/>
                  <span class="online-status online"></span> <!--change class online to offline or busy as needed-->
                </div>
                <div class="profile-name">
                  <p class="name">
                    <?php echo $getuserdata['orgid'];?>
                  </p>
                  <p class="designation">
                    <?php echo $getuserdata['role']; ?>
                  </p>
                </div>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="home">
                <i class="icon-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>                
              </a>
            </li>
              <?php
     if($getuserdata['role']=="Webteam")
       {
          ?>
           
    
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#organizers" aria-expanded="false" aria-controls="page-layouts">
                <i class="icon-people  menu-icon"></i>
                <span class="menu-title">Organizers</span>
              </a>
              <div class="collapse" id="organizers">
                <ul class="nav flex-column sub-menu">
              <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="addorganizer">Add Organizer</a></li>
              <li class="nav-item"><a class="nav-link" href="manageorganizerdetails" '>Manage Organizer Details</a></li>
                  
                </ul>
              </div>
            </li>
                  

            <li class="nav-item">
              <a class="nav-link" href="managesitesettings">
                <i class="icon-settings menu-icon"></i>
                <span class="menu-title">Manage Site Settings</span>                
              </a>
            </li>
                       
    
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#eventdetails" aria-expanded="false" aria-controls="page-layouts">
                <i class="icon-notebook menu-icon"></i>
                <span class="menu-title">Event Details</span>
              </a>
              <div class="collapse" id="eventdetails">
                <ul class="nav flex-column sub-menu">
              <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="addevent" >Add Event</a></li>
              <li class="nav-item d-none d-lg-block"> <a class="nav-link" href="editevent" >Edit Event</a></li>
              <li class="nav-item"><a class="nav-link" href="addfilestoeventdetails">Add files to event</a></li>
              <!--li class="nav-item"><a class="nav-link" href="manageeventdetails">Manage Event Details</a></li-->
                  
                </ul>
              </div>
            </li>

      <?php
       }
      ?>

          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#eventreg" aria-expanded="false" aria-controls="page-layouts">
                <i class="icon-graduation  menu-icon"></i>
                <span class="menu-title">Event Registrations</span>
              </a>
              <div class="collapse" id="eventreg">
                <ul class="nav flex-column sub-menu">             
                  <li class="nav-item d-none d-lg-block"><a class="nav-link" href="eventregistrations" >Get Event Registration Data</a></li>
                  <li class="nav-item"> <a class="nav-link" href="searchreg_user">Search Reg Users data</a></li>
                   <li class="nav-item"> <a class="nav-link" href="stopeventregistrations">Stop Event Registrations</a></li>
                 </ul>
               </div>
             </li>
                  


          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#notices" aria-expanded="false" aria-controls="page-layouts">
                <i class="icon-bell  menu-icon"></i>
                <span class="menu-title">Notices</span>
              </a>
              <div class="collapse" id="notices">
                <ul class="nav flex-column sub-menu">             
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="addnotice">Add Notice</a></li>
                <li class="nav-item"> <a class="nav-link" href="managenotices">Manage Notice</a></li>
                <!--li class="nav-item"> <a class="nav-link" href="deletenotices">Delete Notice</a></li-->
                 </ul>
               </div>
             </li>
                
          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#usermsg" aria-expanded="false" aria-controls="page-layouts">
                <i class=" icon-speech  menu-icon"></i>
                <span class="menu-title">User Messages</span>
              </a>
              <div class="collapse" id="usermsg">
                <ul class="nav flex-column sub-menu">             
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="evemessages">Event Messages</a></li>
                <?php
     if($getuserdata['role']=="Webteam")
       {
          ?>
                <li class="nav-item"> <a class="nav-link" href="webteammsgs">Webteam Messages</a></li>
                <?php
              }
              ?>
                 </ul>
               </div>
             </li>
                
          <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#uploads" aria-expanded="false" aria-controls="page-layouts">
                <i class="icon-cloud-upload menu-icon"></i>
                <span class="menu-title">Uploading</span>
              </a>
              <div class="collapse" id="uploads">
                <ul class="nav flex-column sub-menu">             
                <li class="nav-item d-none d-lg-block"><a class="nav-link" href="manageuploadoption">Manage Upload Option</a></li>
                <!--li class="nav-item"> <a class="nav-link" href="removeuploadoption">Remove Uploaad Option</a></li-->
                <li class="nav-item"> <a class="nav-link" href="getuploadsdata">Get Uploads data</a></li>
                 </ul>
               </div>
             </li>
                
            
          </ul>
        </nav>
        <!-- partial -->