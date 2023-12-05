<?php require("mainSQL.php"); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- ---- css -----  -->
  <link rel="stylesheet" href="homepage.css" />
  <link rel="stylesheet" href="modal.css" />
  <!--                                -->
  <!-- font  -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Outfit&display=swap" rel="stylesheet" />
  <!--                                   -->
  <!-- ---fontawesome icon------  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- ------------------------------------------------------------  -->
  <title>Home</title>
</head>

<body>
  <div class="grid-container-wrapper">
    <!-- ------------------sidebar------------->

    <nav class="sidebar">
      <div class="user-container">
        <i class="fa-regular fa-circle-user profilepic"></i>
        <span class="user-info">
          <p class="name">Kim Chaewon</p>
          <p class="username">@chaechae</p>
        </span>
      </div>
      <div class="menu">
        <ul class="menu-items">
          <li class="active" id="messages-link">
            <i class="icons fa-regular fa-envelope fa-lg"></i>
            <a href="#">Messages</a>
          </li>
          <li id="contacts-link">
            <i class="icons fa-regular fa-address-book fa-lg"></i>
            <a href="#">Contacts</a>
          </li>
        </ul>
        <div class="bottom-item">
          <li>
            <i class="icons fa-solid fa-right-from-bracket fa-lg"></i>
            <a href="index.php">Logout</a>
          </li>
        </div>
      </div>
    </nav>

    <!-- -------end of sidebar------->
    <!-- ---------------------------------------------------------------------------------  -->
    <!-- -------Main Content------->

    <div class="main-content">
      <!-- --------Messages ----------  -->

      <div class="list" id="message-list">
        <div class="header">
          <h1>Messages</h1>
          <!-- --Button to open group message modal --  -->
          <a href="#group-message"><button class="button">
              <i class="fa-regular fa-pen-to-square fa-lg"></i></button></a>
          <!-- --end of Button  --  -->
        </div>
        <input class="searchbar message-search" type="text" name="" id="" placeholder="Search..." />

        <div class="messages-container">
          <!-- --- messages item ----  -->
          <?php
          $query = "SELECT CONCAT(c.fName, ' ', c.lName) AS fullname, m.datetime, m.msg FROM contacts c INNER JOIN msg m ON c.number = m.receiverNum WHERE m.receiverNum IS NOT NULL AND m.msgID = (SELECT MAX(msgID) FROM msg WHERE receiverNum = c.number);";
          $result = mysqli_query($conn, $query);

          if (mysqli_num_rows($result) != 0) {
            while ($row = mysqli_fetch_assoc($result)) {
          ?>
              <div class="message-item item">
                <i class="fa-regular fa-circle-user profilepic"></i>
                <div class="messeage-info">
                  <div class="message-content">
                    <?php
                    echo "<p class='name'>$row[fullname]</p>";

                    // Add the message content here
                    echo "<div class='message'>";
                    echo $row['msg'];
                    echo "</div>";
                    ?>
                    <p class="time"><?php echo $row['datetime'] ?></p>
                  </div>
                </div>
                <i class="ellipsis-menu fa-solid fa-ellipsis-vertical fa-xl">
                  <div class="more-actions">
                    <i class="fa-regular fa-trash-can"></i><a href="">Delete</a>
                  </div>
                </i>
              </div>
          <?php
            }
          }
          ?>
          <!-- --- end of messages item ----  -->
        </div>
      </div>

      <!-- -- end of message  --  -->
      <!-- ----------------------------------------------------------------------------  -->
      <!-- ------- Contacts ----------  -->

      <div class="list" id="Contact-list">
        <div class="header">
          <h1>Contacts</h1>
          <!-- --Button to open create contact modal --  -->
          <a href="#create-contact"><button class="button">
              <i class="fa-solid fa-plus fa-lg"></i></button></a>
          <!-- --end of Button  --  -->
        </div>
        <input class="searchbar contact-search" type="text" name="" id="" placeholder="Search..." />

        <div class="contact-container">
          <?php 
            $query = "SELECT * FROM contacts";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            if (mysqli_num_rows($result) != 0) {
            
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='contact-item item'>";
                echo "<i class='fa-regular fa-circle-user profilepic'></i>";
                echo "<div class='contact-info'>";
                echo "<div class='contact-content'>";
                echo "<p class=name'>$row[fName] "."$row[lName]"."</p>";
                echo "</div>";
                echo "</div>";
                echo "<i class='ellipsis-menu fa-solid fa-ellipsis-vertical fa-xl'>";
                echo "<div class='more-actions'>";
                echo "<i class='fa-regular fa-trash-can'></i><a href=''>Delete</a>";
                echo "</div>";
                echo "</i>";
                echo "</div>";
              }
            }

            else {
                //Display 'No Contacts'
            }
          ?>

          <!-- --- contact item----  -->
          <div class="contact-item item">
            <i class="fa-regular fa-circle-user profilepic"></i>
            <div class="contact-info">
              <div class="contact-content">
                <p class="name">Kim Chaewon</p>
              </div>
            </div>
            <i class="ellipsis-menu fa-solid fa-ellipsis-vertical fa-xl">
              <div class="more-actions">
                <i class="fa-regular fa-trash-can"></i><a href="">Delete</a>
              </div>
            </i>
          </div>
          <!-- --- end of contact item----  -->

        </div>
      </div>
      <!-- -- end of Contacts --  -->
      <!-- ------------------------------------------------------------------------------  -->

      <!-- -- Chat box area --  -->

      <div class="chatbox">
        <div class="chat-header">
          <i class="fa-regular fa-circle-user profilepic"></i>
          <p class="name">Kim Chaewon</p>
        </div>
        <hr />
        <!-- ------------------------  -->
        <!-- -------- Chat container --------  -->
        <div class="chat-content">
          
          <?php
            $senderNum = "639958751284";
            $receiverNum = "639917909540";

            $query = "SELECT * FROM msg
                      WHERE (senderNum = '$senderNum' AND receiverNum = '$receiverNum')
                        OR (senderNum = '$receiverNum' AND receiverNum = '$senderNum') ORDER BY msg.datetime ASC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) != 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                if ($row['senderNum'] == $senderNum) {
                ?>
                <p class="sender chat-message">
                <?php 
                  echo $row['msg'];
                ?>
                </p>

                <?php
              }
              
              else {
                ?>

                <p class="reciever chat-message">
                <?php 
                  echo $row['msg'];
                ?>
                </p>

                <?php

              }
              }
            }


          ?>
        </div>
        <!-- ------------------ end of Chat container --------------  -->
        <!-- ---- Input message--------  -->
        <div class="chat-input">
          <input class="message-input" type="text" placeholder="Type a message..." />
          <a href=""><button class="button">
              <i class="fa-regular fa-paper-plane fa-lg"></i></button></a>
        </div>
        <!-- ----- end of Input message--------  -->
      </div>
      <!-- ------- end of Chat box area -----  -->
    </div>
    <!-- -----------------------end of Main Content--------------------->
  </div>
  <!-- -------------------------------------------------------------------------------  -->

  <!-- ----------------------- Modals -------------------------------------->

  <!-- -- create contact Modal --  -->

  <div id="create-contact" class="overlay">
    <div class="popup">
      <div class="popup-header">
        <h2>Create Contact</h2>
        <a class="close" href="#"><i class="fa-solid fa-xmark fa-xl"></i> </a>
      </div>
      <div class="content">
        <form method="POST" action="mainSQL.php" class="contact-form">
          <input class="textbox" type="text" name="fName" placeholder="First Name" maxlength="15" required/>
          <input class="textbox" type="text" name="lName" placeholder="Last Name" maxlength="15" required/>
          <input class="textbox" type="number" name="num" placeholder="639*********" maxlength="12" required/>
          <input type="submit" class="modal-button" name="addContact" value="Save"/>
        </form>
      </div>
    </div>
  </div>

  <!-- --end of  create contact Modal --  -->

  <!-- --Group message contact Modal ----------  -->

  <div id="group-message" class="overlay">
    <div class="popup">
      <div class="popup-header">
        <h2>Group Message</h2>
        <a class="close" href="#"><i class="fa-solid fa-xmark fa-xl"></i> </a>
      </div>
      <div class="content">
        <!----------- name of chat members ------- -->
        <div class="chat-members">
          <span>To:</span>
          <!----------- Members name ------- -->
          <span class="chatname">Jung Wheein<i class="remove-name fa-solid fa-xmark fa-sm"></i></span>
          <span class="chatname">Jugn Wheein<i class="remove-name fa-solid fa-xmark fa-sm"></i> </span>
          <span class="chatname">Kim Chaewon<i class="remove-name fa-solid fa-xmark fa-sm"></i> </span>
          <!--------------------------------- -->
        </div>
        <!----------- end name of chat members ------- -->
        <!------------ contacts table ------- -->
        <div class="table-container">
          <table>
            <!-- ----table row-----------  -->
<<<<<<< Updated upstream
            <tr>
              <td><i class="fa-regular fa-circle-user profilepic"></i></td>
              <td>Kim Chaewon</td>
              <td>
                <button class="button add-contact">
                  <i class="fa-solid fa-plus fa-sm"></i>
                </button>
              </td>
            </tr>
=======
            <?php
            $query = "SELECT * FROM `contacts`";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) != 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $contactName = $row['fName'] . " " . $row['lName'];
            ?><tr data-contactid="<?php echo $contactName; ?>">
                  <td><i class="fa-regular fa-circle-user profilepic"></i></td>
                  <td><?php
                      echo $contactName;
                      ?></td>
                  <td>
                    <input type="text" id="number" name="number" value="<?php echo $row['number']; ?>">
                  </td>
                  <td>
                    <button class="button add-contact" , onclick="addContactNumber('<?= $contactName ?>')">
                      <i class="fa-solid fa-plus fa-sm"></i>
                    </button>
                  </td>
                </tr>
            <?php
              }
            }
            ?>
>>>>>>> Stashed changes
            <!-- -------end of table row-------  -->
          </table>
        </div>
        <!------------ end of contacts table ------- -->
        <input class="message-input" type="text" name="" id="" placeholder="Type a message..." />

        <a href="#" class=""><input type="button" class="modal-button" value="Send" /></a>
      </div>
    </div>
  </div>

  <!-- ------------------end of Group message contact Modal -------------------------  -->

  <script src="main.js"></script>
</body>

</html>