<div class="col-sm-12">
          <div class="white-box">
            <h3 class="box-title m-b-0">Student Data Table</h3>
            <p class="text-muted m-b-30">Click button above table to export to Copy, CSV, Excel, PDF & Print</p>
            <div class="table-responsive">
                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Ic</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>City</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Student Name</th>
                            <th>Ic</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>City</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    <?php
                        // require "../models/studentlist.php";
                    require "../../config/database.php";

                    /* Your database table goes here */
                    $mysql_table = "student_info";
                    $mysql_table_join = "student";
                    $mysql_table_parent = "parent";
                    $mysql_table_address = "address";

                    try{
                        $pdo = new PDO("pgsql:host=".REG_SERVER.";dbname=".REG_DATABASE."", REG_USER, REG_PASSWORD);

                        $query = $pdo->prepare("SELECT s.id, s.student_id, s.parent_id, std.name, std.ic, std.phone_no , p.address_id, std.email, std.created_date, a.address, a.city
                            FROM ". $mysql_table . " AS s 
                            JOIN ". $mysql_table_join . " AS std 
                            ON s.student_id = std.id 
                            JOIN ". $mysql_table_parent . " AS p 
                            ON s.parent_id = p.id 
                            LEFT JOIN ". $mysql_table_address . " AS a 
                            ON p.address_id = a.id" ) ;
                        
                        $query->execute();


                        while($row = $query->fetch()){
                            print '<tr>';
                            print '<td>';
                            print '<a href="student_info.php?student_id='.$row["id"].'">'.$row["name"].'</a></td>';
                            print '<td>'.$row["ic"].'</td>';
                            print '<td>'.$row["phone_no"].'</td>';
                            print '<td>'.$row["email"].'</td>';
                            print '<td>'.$row["address"].'</td>';
                            print '<td>'.$row["city"].'</td>';
                            print '</tr>';
                        }
                            /* Close connection */
                            $pdo = null;
                        }
                        catch(PDOException $e){
                                $error_exists = true;
                                $error_pdo =  "Database error: " . $e->getMessage();
                                echo $error_pdo;
                        }
                    ?>
                    </tbody>
                </table>
            </div>
          </div>
        </div>