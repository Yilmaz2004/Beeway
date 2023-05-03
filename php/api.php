<?php
  header("Access-Control-Allow-Origin: *");
  header('Access-Control-Allow-Methods: POST GET');
  require ("./dbconnect.php");

  if (isset($_POST['test'])) // test
  {
    $sql = "SELECT name FROM users";
    $result = $conn->query($sql);

    if ($result !== false && $result -> num_rows > 0) {
      $text = "<table border=1> <tr><th>naam</th></tr>";

      while ($row = $result->fetch_assoc()) {
          $text = $text . "<tr><td>".$row['name']."</td></tr>";
      }
      echo $text = $text . "</table>";
    } else {
      echo "string";
    }
  }

  if (isset($_POST['Login'])) // login
  {
    $json = $_POST['Login'];
          $json = json_decode($json, true);
          $school = $json['School'];
          $email = $json['Email'];
          $psw = $json['Psw'];

          if ($school === '0' )
          {
            $sql = "SELECT userid, firstname FROM users where email = ? and password = ? and role = '2' and archive <> '1'";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $email, $psw);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result !== false && $result -> num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $userid = $row['userid'];
                $voornaam = $row['firstname'];

                $token = SetSession($conn, $userid);
                $jsonArrayObject = (array('Token' => $token,
                                          'Voornaam' => $voornaam));
               $json_array = json_encode($jsonArrayObject);
                   echo $json_array;
              }
            } else {
              echo "NOK1"; // error
            }
          }
          else
          {
            $sql = "SELECT u.userid, u.firstname FROM users as u where u.email = ? and u.password = ? and u.role <> '2' and u.archive <> '1' and u.schoolid = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $email, $psw, $school);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result !== false && $result -> num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $userid = $row['userid'];
                $voornaam = $row['firstname'];

                $token = SetSession($conn, $userid);
                $jsonArrayObject = (array('Token' => $token,
                                          'Voornaam' => $voornaam));
               $json_array = json_encode($jsonArrayObject);
                   echo $json_array;
              }
            } else {
              echo "NOK1"; // error
            }          }
  }

  function SetSession($conn, $userid) // set a session when user logs in
    {
        $number = generateRandomNumber();
        $token = RandomString($number);

        $now = new datetime();

        if (isset($rememberme)) {
          $now->modify('+7 day');
        } else {
          $now->modify('+8 hour');
        }

        $dt = strtotime($now->format('y-m-d h:i:s'));

        $sql = "INSERT INTO session (stmp, token, userid) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $dt, $token, $userid);
        $stmt->execute();
        $result = $stmt->get_result();

        return $token;
    }



  function RandomString($length) // set random string
  {
      $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $string = '';

      for ($i = 0; $i < $length; $i++)
      {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
      }

      return $string;
  }

    function generateRandomNumber()
  { // Generate a random number between 50 and 100
      $randomNumber = rand(50, 100);
      return $randomNumber;
  }
?>
