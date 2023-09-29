<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Ticket.xls");
?>

<style type="text/css">
div {
  text-align: justify;
  text-justify: inter-word;
}
    .satu {
   font-size: 12px;
   }
   .dua {
   font-size: 18px;
   }
   .tiga {
   font-size: 10px;
   }
   .empat {
   font-size: 11px;
   }
</style>

<html>
    <body>
        <center><h1>Ticket Perjalanan PT. Lima Pilar Cakrawala</h1></center>
        <center><h3>Grand Galaxy City Blok RRG 3 No.75 Jakasetia Kota Bekasi Jawa Barat 17147</h3></center>   
    <table border="1">
                <thead>
                    <tr>
                        <th>No Ticket</th>
                        <th>Id User</th>
                        <th>Date Register</th>
                        <th>Urgency</th>
                        <th>Name Company</th>
                        <th>Name PIC</th>
                        <th>Position PIC</th>
                        <th>Problem Company</th>
                        <th>Problem Details</th>
                        <th>Date Problem</th>
                        <th>Image Ticket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($ticket as $row) :  ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row['no_ticket']; ?></td>
                            <td><?= $row['user_id']; ?></td>
                            <td><?= $row['date_register']; ?></td>
                            <td><?= $row['urgency']; ?></td>
                            <td><?= $row['name_company']; ?></td>
                            <td><?= $row['name_pic']; ?></td>
                            <td><?= $row['position_pic']; ?></td>
                            <td><?= $row['problem_company']; ?></td>
                            <td><?= $row['problem_details']; ?></td>
                            <td><?= $row['date_problem']; ?></td>
                            <td><?= $row['image_ticket']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </body>
</html>