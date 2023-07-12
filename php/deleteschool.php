<?php
  require_once '../private/dbconnect.php';
  session_start();

  if (isset($_SESSION['userid'], $_SESSION['userrole']) && ($_SESSION['userrole'] === 'superuser')) { // User has the necessary privileges
    if ($_GET['schoolid'] == '0' || $_GET['schoolid'] == '1') {
      $_SESSION['error'] = 'Deze school mag niet verwijderd worden.';
      header('location: ../index.php?page=scholenlijst');
      exit;
    } else {
      if (isset($_GET['schoolid']) && $_GET['schoolid'] != '') {
        $timestamp = time();
        $date_time = date('Y-m-d H:i:s', $timestamp);

        $archive = 1;
        $deletedBy = $_SESSION['userid'];
        $schoolId = $_GET['schoolid'];

        try {
          // Update users table
          $sqlUsers = "UPDATE users SET archive=:archive, deletedby=:deletedby, deletedat=:deletedat
                       WHERE schoolid=:schoolid";
          $sthUsers = $conn->prepare($sqlUsers);
          $sthUsers->bindParam(':archive', $archive);
          $sthUsers->bindParam(':deletedby', $deletedBy);
          $sthUsers->bindParam(':deletedat', $date_time);
          $sthUsers->bindParam(':schoolid', $schoolId);
          $sthUsers->execute();

          // Insert into logs table for users
          $actionUsers = 3; // 3 = delete
          $tableIdUsers = 6; // 6 = users
          $interactionIdUsers = $schoolId;
          $infoUsers = "Everything from 'users' where schoolid is {$schoolId} has been deleted.";

          $sqlLogsUsers = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, info)
                           VALUES (:userid, :useragent, :action, :tableid, :interactionid, :info)";
          $sthLogsUsers = $conn->prepare($sqlLogsUsers);
          $sthLogsUsers->bindParam(':userid', $_SESSION['userid']);
          $sthLogsUsers->bindParam(':useragent', $_SESSION['useragent']);
          $sthLogsUsers->bindParam(':action', $actionUsers);
          $sthLogsUsers->bindParam(':tableid', $tableIdUsers);
          $sthLogsUsers->bindParam(':interactionid', $interactionIdUsers);
          $sthLogsUsers->bindParam(':info', $infoUsers);
          $sthLogsUsers->execute();


          // Update maintheme table
          $sqlMainTheme = "UPDATE maintheme SET archive=:archive, deletedby=:deletedby, deletedat=:deletedat
                           WHERE schoolid=:schoolid";
          $sthMainTheme = $conn->prepare($sqlMainTheme);
          $sthMainTheme->bindParam(':archive', $archive);
          $sthMainTheme->bindParam(':deletedby', $deletedBy);
          $sthMainTheme->bindParam(':deletedat', $date_time);
          $sthMainTheme->bindParam(':schoolid', $schoolId);
          $sthMainTheme->execute();

          // Insert into logs table for maintheme
          $actionMainTheme = 3; // 3 = delete
          $tableIdMainTheme = 4; // 4 = maintheme
          $interactionIdMainTheme = $schoolId;
          $infoMainTheme = "Everything from 'maintheme' where schoolid is {$schoolId} has been deleted.";

          $sqlLogsMainTheme = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, info)
                               VALUES (:userid, :useragent, :action, :tableid, :interactionid, :info)";
          $sthLogsMainTheme = $conn->prepare($sqlLogsMainTheme);
          $sthLogsMainTheme->bindParam(':userid', $_SESSION['userid']);
          $sthLogsMainTheme->bindParam(':useragent', $_SESSION['useragent']);
          $sthLogsMainTheme->bindParam(':action', $actionMainTheme);
          $sthLogsMainTheme->bindParam(':tableid', $tableIdMainTheme);
          $sthLogsMainTheme->bindParam(':interactionid', $interactionIdMainTheme);
          $sthLogsMainTheme->bindParam(':info', $infoMainTheme);
          $sthLogsMainTheme->execute();


          // Update groups table
          $sqlGroups = "UPDATE groups SET archive=:archive, deletedby=:deletedby, deletedat=:deletedat
                        WHERE schoolid=:schoolid";
          $sthGroups = $conn->prepare($sqlGroups);
          $sthGroups->bindParam(':archive', $archive);
          $sthGroups->bindParam(':deletedby', $deletedBy);
          $sthGroups->bindParam(':deletedat', $date_time);
          $sthGroups->bindParam(':schoolid', $schoolId);
          $sthGroups->execute();

          // Insert into logs table for groups
          $actionGroups = 3; // 3 = delete
          $tableIdGroups = 3; // 3 = groups
          $interactionIdGroups = $schoolId;
          $infoGroups = "Everything from 'groups' where schoolid is {$schoolId} has been deleted.";

          $sqlLogsGroups = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, info)
                            VALUES (:userid, :useragent, :action, :tableid, :interactionid, :info)";
          $sthLogsGroups = $conn->prepare($sqlLogsGroups);
          $sthLogsGroups->bindParam(':userid', $_SESSION['userid']);
          $sthLogsGroups->bindParam(':useragent', $_SESSION['useragent']);
          $sthLogsGroups->bindParam(':action', $actionGroups);
          $sthLogsGroups->bindParam(':tableid', $tableIdGroups);
          $sthLogsGroups->bindParam(':interactionid', $interactionIdGroups);
          $sthLogsGroups->bindParam(':info', $infoGroups);
          $sthLogsGroups->execute();


          // Update disciplines table
          $sqlDisciplines = "UPDATE disciplines SET archive=:archive, deletedby=:deletedby, deletedat=:deletedat
                             WHERE schoolid=:schoolid";
          $sthDisciplines = $conn->prepare($sqlDisciplines);
          $sthDisciplines->bindParam(':archive', $archive);
          $sthDisciplines->bindParam(':deletedby', $deletedBy);
          $sthDisciplines->bindParam(':deletedat', $date_time);
          $sthDisciplines->bindParam(':schoolid', $schoolId);
          $sthDisciplines->execute();

          // Insert into logs table for disciplines
          $actionDisciplines = 3; // 3 = delete
          $tableIdDisciplines = 2; // 2 = disciplines
          $interactionIdDisciplines = $schoolId;
          $infoDisciplines = "Everything from 'disciplines' where schoolid is {$schoolId} has been deleted.";

          $sqlLogsDisciplines = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, info)
                                 VALUES (:userid, :useragent, :action, :tableid, :interactionid, :info)";
          $sthLogsDisciplines = $conn->prepare($sqlLogsDisciplines);
          $sthLogsDisciplines->bindParam(':userid', $_SESSION['userid']);
          $sthLogsDisciplines->bindParam(':useragent', $_SESSION['useragent']);
          $sthLogsDisciplines->bindParam(':action', $actionDisciplines);
          $sthLogsDisciplines->bindParam(':tableid', $tableIdDisciplines);
          $sthLogsDisciplines->bindParam(':interactionid', $interactionIdDisciplines);
          $sthLogsDisciplines->bindParam(':info', $infoDisciplines);
          $sthLogsDisciplines->execute();


          // Get beewayid values from beeway table
          $sqlBeewayIds = "SELECT beewayid FROM beeway WHERE schoolid=:schoolid";
          $sthBeewayIds = $conn->prepare($sqlBeewayIds);
          $sthBeewayIds->bindParam(':schoolid', $schoolId);
          $sthBeewayIds->execute();
          $beewayIds = $sthBeewayIds->fetchAll(PDO::FETCH_COLUMN);

          if (!empty($beewayIds)) {
            $beewayIdList = implode(',', $beewayIds);

            // Update beewayplanning table
            $sqlBeewayPlanning = "UPDATE beewayplanning SET archive=:archive, deletedby=:deletedby, deletedat=:deletedat
                                  WHERE beewayid IN ({$beewayIdList})";
            $sthBeewayPlanning = $conn->prepare($sqlBeewayPlanning);
            $sthBeewayPlanning->bindParam(':archive', $archive);
            $sthBeewayPlanning->bindParam(':deletedby', $deletedBy);
            $sthBeewayPlanning->bindParam(':deletedat', $date_time);
            $sthBeewayPlanning->execute();

            // Update beewayobservation table
            $sqlBeewayObservation = "UPDATE beewayobservation SET archive=:archive, deletedby=:deletedby, deletedat=:deletedat
                                     WHERE beewayid IN ({$beewayIdList})";
            $sthBeewayObservation = $conn->prepare($sqlBeewayObservation);
            $sthBeewayObservation->bindParam(':archive', $archive);
            $sthBeewayObservation->bindParam(':deletedby', $deletedBy);
            $sthBeewayObservation->bindParam(':deletedat', $date_time);
            $sthBeewayObservation->execute();

            // Update beeway table
            $sqlBeeway = "UPDATE beeway SET archive=:archive, deletedby=:deletedby, deletedat=:deletedat
                          WHERE beewayid IN ({$beewayIdList})";
            $sthBeeway = $conn->prepare($sqlBeeway);
            $sthBeeway->bindParam(':archive', $archive);
            $sthBeeway->bindParam(':deletedby', $deletedBy);
            $sthBeeway->bindParam(':deletedat', $date_time);
            $sthBeeway->execute();

            // Insert into logs table for beewayplanning and beewayobservation
            $actionBeeway = 3; // 3 = delete
            $tableIdBeeway = 1; // 1 = beeway
            $interactionIdBeeway = $schoolId;
            $infoBeeway = "Everything from 'beewayplanning' and 'beewayobservation' where beewayid is in ({$beewayIdList}) has been archived where beeway.schoolid is {$schoolId}.";

            $sqlLogsBeeway = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, info)
                              VALUES (:userid, :useragent, :action, :tableid, :interactionid, :info)";
            $sthLogsBeeway = $conn->prepare($sqlLogsBeeway);
            $sthLogsBeeway->bindParam(':userid', $_SESSION['userid']);
            $sthLogsBeeway->bindParam(':useragent', $_SESSION['useragent']);
            $sthLogsBeeway->bindParam(':action', $actionBeeway);
            $sthLogsBeeway->bindParam(':tableid', $tableIdBeeway);
            $sthLogsBeeway->bindParam(':interactionid', $interactionIdBeeway);
            $sthLogsBeeway->bindParam(':info', $infoBeeway);
            $sthLogsBeeway->execute();
          }

          // Update schools table
          $sqlSchools = "UPDATE schools SET archive=:archive, deletedby=:deletedby, deletedat=:deletedat
                         WHERE schoolid=:schoolid";
          $sthSchools = $conn->prepare($sqlSchools);
          $sthSchools->bindParam(':archive', $archive);
          $sthSchools->bindParam(':deletedby', $deletedBy);
          $sthSchools->bindParam(':deletedat', $date_time);
          $sthSchools->bindParam(':schoolid', $schoolId);
          $sthSchools->execute();

          // Insert into logs table for schools
          $actionSchools = 3; // 3 = delete
          $tableIdSchools = 5; // 5 = schools
          $interactionIdSchools = $schoolId;
          $infoSchools = "School with schoolid {$schoolId} has been archived.";

          $sqlLogsSchools = "INSERT INTO logs (userid, useragent, action, tableid, interactionid, info)
                             VALUES (:userid, :useragent, :action, :tableid, :interactionid, :info)";
          $sthLogsSchools = $conn->prepare($sqlLogsSchools);
          $sthLogsSchools->bindParam(':userid', $_SESSION['userid']);
          $sthLogsSchools->bindParam(':useragent', $_SESSION['useragent']);
          $sthLogsSchools->bindParam(':action', $actionSchools);
          $sthLogsSchools->bindParam(':tableid', $tableIdSchools);
          $sthLogsSchools->bindParam(':interactionid', $interactionIdSchools);
          $sthLogsSchools->bindParam(':info', $infoSchools);
          $sthLogsSchools->execute();

          $_SESSION['info'] = 'School succesvol gearchiveerd.';
          header('Location: ../index.php?page=scholenlijst');
        } catch (\Exception $e) {
          $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 3, 5, 0, 5)';
          $sth = $conn->prepare($sql);
          $sth->bindValue(':useragent', $_SESSION['useragent']);
          $sth->execute();

          $_SESSION['error'] = $e->getMessage();
          header('Location: ../index.php?page=scholenlijst');
          exit;
        }
      }
    }
  } else {
    $sql = 'INSERT INTO logs (userid, useragent, action, tableid, interactionid, error) VALUES ("9999", :useragent, 3, 6, "0", "1")';
    $sth = $conn->prepare($sql);
    $sth->bindValue(':useragent', $_SESSION['useragent']);
    $sth->execute();

    $_SESSION['error'] = 'U heeft geen toegang tot deze pagina';
    header('Location: ../index.php');
    exit;
  }
?>
