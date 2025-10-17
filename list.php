<?php
require_once 'db_connect.php';
if (isset($_GET['msg'])) {
    echo "<div class='alert alert-info alert-dismissible'>" . htmlspecialchars($_GET['msg']) . "</div>";
}
$sql = "select * from user_reg";
$result = $conn->query($sql);

$users = [];
if ($result->num_rows > 0) {
    $users = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>
    <div class="container-mt5">
        <h2 class="mb-4 text-center"><b>Registered Users</b></h2>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>

            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $key => $user): ?>
                        <tr>
                            <td><?php echo $key + 1 ?></td>
                            <td><?php echo $user['name'] ?></td>
                            <td><?php echo $user['email'] ?></td>
                            <td><?php echo $user['phone'] ?></td>
                            <td><?php echo $user['address'] ?></td>
                            <td>
                                <a href="http://localhost/CRUD/update_frontend.php?id= <?php echo $user['id'] ?>" class="btn btn-sm btn-success">Update</a>
                                <a href="http://localhost/CRUD/delete.php?id= <?php echo $user['id'] ?>" class="btn btn-sm btn-danger me-2">Delete</a>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No records found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js" integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous"></script>
</body>

</html>