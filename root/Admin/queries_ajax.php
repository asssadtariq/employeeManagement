<?php
session_start();
require_once "../confi.php";

if (isset($_POST['empid']) && isset($_POST['date']) && isset($_POST['att'])) {
    $id = $_POST['empid'];
    $date = $_POST['date'];
    $status = $_POST['att'];

    $queryCheckEmp = "SELECT emp_id FROM employees WHERE(emp_id = '$id' AND activeStatus = '1')";
    $queryCheckEmpResult = mysqli_query($conn, $queryCheckEmp);

    if (@mysqli_num_rows($queryCheckEmpResult) >= 1) {
        $query = "UPDATE attendance SET status = '$status' WHERE (att_date = '$date' AND emp_id = '$id')";
        $query_result = mysqli_query($conn, $query);

        if (mysqli_affected_rows($conn)) {
            echo "Attendance Updated";
        } else {
            echo "Attendance Updation Failed";
        }
    } else {
        echo "Attendance Updation Failed Employees Not Exist";
    }
}

if (isset($_POST['empid']) && isset($_POST['attdate'])) {
    $id = $_POST['empid'];
    $date = $_POST['attdate'];

    $queryCheckEmp = "SELECT emp_id FROM employees WHERE(emp_id = '$id' AND activeStatus = '1')";
    $queryCheckEmpResult = mysqli_query($conn, $queryCheckEmp);
    if (@mysqli_num_rows($queryCheckEmpResult) >= 1) {
        $query = "DELETE FROM attendance WHERE (att_date = '$date' AND emp_id = '$id')";
        $query_result = mysqli_query($conn, $query);

        if (mysqli_affected_rows($conn)) {
            echo "Attendance Deleted";
        } else {
            echo "Attendance Deletion Failed";
        }
    } else {
        echo "Attendance Updation Failed Employees Not Exist";
    }
}

if (isset($_POST['empID']) && isset($_POST['empDelStatus'])) {
    $id = $_POST['empID'];

    $queryCheckEmp = "SELECT emp_id FROM employees WHERE(emp_id = '$id' AND activeStatus = '1')";
    $queryCheckEmpResult = mysqli_query($conn, $queryCheckEmp);
    if (@mysqli_num_rows($queryCheckEmpResult) >= 1) {
        $query = "UPDATE employees SET activeStatus = '0' WHERE (emp_id = '$id')";
        $query_result = mysqli_query($conn, $query);

        if (mysqli_affected_rows($conn)) {
            echo "Employee Record Deleted Successfully";
        } else {
            echo "Employee Record Deletion Failed";
        }
    } else {
        echo "Employee Deletion Failed Employees Not Exist";
    }
}

if (isset($_POST['currMon'])) {
    $query = "SELECT * FROM employees WHERE (activeStatus = '1')  ORDER BY emp_id ASC";
    $query_result = mysqli_query($conn, $query);

    $monthSelected = $_POST['currMon'];
    $tDays = cal_days_in_month(CAL_GREGORIAN, $monthSelected, date('Y'));
    
    echo '
     <table class="table my-3">
    <tr class="table-dark">
        <th rowspan="2" style="width: 100px;">#</th>
        <th rowspan="2" style="width: 180px;">Name</th>
        <th rowspan="2" style="width: 180px;">Employee ID</th>
        <th colspan="'.$tDays.'" class="text-center" style="width: 40px;">Date</th>
    </tr>
    <tr class="table-dark">';
 
    $daysCounter = 1;
    while ($daysCounter <= $tDays) {
        echo '<td style="border-color: whitesmoke; border: 2px solid;">'; echo $daysCounter.'</td>';
        $daysCounter++;
    }
    echo '</tr>' .
        $counter = 1;
    while ($query_data = mysqli_fetch_assoc($query_result)) {
        echo '<tbody>
            <td style="width: 100px;">'; echo $counter.'</td>
            <td style="width: 180px;">' . $query_data['name'];
        echo '</td>
            <td style="width: 180px;">' . $query_data['emp_id'];
        echo '</td>';
        $counter2 = 1;
        $empId = $query_data['emp_id'];
        while ($counter2 <= $tDays) {
            $queryAttendance = "SELECT status FROM attendance WHERE (emp_id = '$empId' AND MONTH(att_date) = '$monthSelected' AND DAY(att_date) = '$counter2')";
            $queryAttendanceResult = mysqli_query($conn, $queryAttendance);
            $status = "-";
            if (@mysqli_num_rows($queryAttendanceResult) >= 1) {
                $queryAttendanceData = mysqli_fetch_assoc($queryAttendanceResult);
                $status = $queryAttendanceData['status'];
            }

            echo '<td style="width:40px; border-color: whitesmoke; border: 2px solid;">' . $status;
            echo '</td>';


            $counter2++;
        }
        echo '</tbody>';

        $counter++;
    }

    echo '</table>';
}
