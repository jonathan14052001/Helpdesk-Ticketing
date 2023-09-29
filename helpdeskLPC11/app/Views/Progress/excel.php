<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Progress.xls");
?>

<html>
    <body>
    <table border="1">
                <thead>
                    <tr>
                        <th>Id Progress</th>
                        <th>Id Ticket</th>
                        <th>Persen Progress</th>
                        <th>Solusi</th>
                        <th>status Ticket</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach($progress as $row) :  ?>
                        <tr>
                            <td scope="row"><?= $i; ?></td>
                            <td><?= $row['id_ticket']; ?></td>
                            <td><?= $row['persen_progress']; ?></td>
                            <td><?= $row['solution']; ?></td>
                            <td><?= $row['status_ticket']; ?></td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
    </body>
</html>