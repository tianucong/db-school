<?php

include 'config.php';
include 'auth.php';

$query = "SELECT s.id, s.nim, s.name, m.name AS major_name 
          FROM students s 
          JOIN majors m ON s.major_id = m.id 
          ORDER BY s.id DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html> 
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <?php
        if(isset($_GET['msg'])&&$_GET['msg']=='deleted'){
            echo '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Berhasil!</strong> Data mahasiswa sukses dihapus.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }?>
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Student Management</h4>
                <div>
                    <a href="create.php" class="btn btn-success btn-sm">+ Add Student</a>
                    <a href="export.php" class="btn btn-info btn-sm text-white">Export Excel</a>
                    <a href="logout.php">Keluar</a>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Name</th>
                                <th>Major</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>
                                    <td>{$no}</td>
                                    <td>{$row['nim']}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['major_name']}</td>
                                    <td class="text-center">
                                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                    
                                    <?php if (is_admin()): ?>
                                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this student?')">Delete</a>
                                    <?php endif; ?>
                                    
                                </td>
                                </tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>