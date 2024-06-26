<?php
require_once "includes/dbh.inc.php";

try {
    $query = "SELECT id, email FROM users";
    $stmt = $pdo->query($query);
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Query failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <script src="https://kit.fontawesome.com/f3364d5594.js" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</head>
<body>
    <div class="container" id="brightness">
        <div class="navbar">
            <div class="center">
                <div class="logo-container">
                    <img src="../images/n2n.png" alt="n2n logo" />
                </div>
            </div>
            <div class="tabs">
                <button onclick="dashboard_link()">
                    <script>
                        function dashboard_link() {
                            location.href = "../dashboard/index.html";
                        }
                    </script>
                    <i class="fa-solid fa-table-columns" style="color: #ffffff;"></i>
                    <span>Dashboard</span>
                </button>
                <button class="active">
                    <i class="fa-solid fa-user" style="color: #ffffff;"></i>
                    <span>User</span>
                </button>
                <button onclick="inventory_link()">
                    <script>
                        function inventory_link() {
                            location.href = "../inventory/index.php";
                        }
                    </script>
                    <i class="fa-solid fa-dolly" style="color: #ffffff;"></i>
                    <span>Inventory</span>
                </button>
                <button onclick="shipment_link()">
                    <script>
                        function shipment_link() {
                            location.href = "../shipments/index.html";
                        }
                    </script>
                    <i class="fa-solid fa-truck" style="color: #ffffff;"></i>
                    <span>Shipments</span>
                </button>
                <button onclick="reception_link()">
                    <script>
                        function reception_link() {
                            location.href = "../receptions/index.html";
                        }
                    </script>
                    <i class="fa-solid fa-truck-ramp-box" style="color: #ffffff;"></i>
                    <span>Reception</span>
                </button>
            </div>
            <button class="return" onclick="logout_link()">
			<script>
				function logout_link() {
					location.href = "../loginPage/index.php";
				}
			</script>
			<span class="fa-solid fa-arrow-right-to-bracket fa-2xl"></span>
			</button>
        </div>
        <div class="content-container">
            <div class="header"></div>
            <div class="content-header">
                <span>User</span>
                <div class="button-container">
                    <button onclick="userInput_link()">
                        <script>
                            function userInput_link() {
                                location.href = "../userInput/userInput.php";
                            }
                        </script>
                        Add User
                    </button>
					
                </div>
                <div class="arrows">
                    <a href=""><i class="fa-solid fa-arrow-left fa-xl"></i></a>
                    <a href=""><i class="fa-solid fa-arrow-right fa-xl"></i></a>
                </div>
            </div>
            <div class="box-container">
                <table>
                    <tr class="table-header">
                        <th>User ID</th>
                        <th>Email</th>
                        <th>Edit</th>
                    </tr>
                    <?php foreach ($users as $user): ?>
                    <tr class="table-content">
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td class="edit-cell">
                            <button onclick="openUpdateForm('<?= $user['id'] ?>', '<?= htmlspecialchars($user['email'], ENT_QUOTES) ?>'); toggle()" class="edit">
                                <i class="fa-solid fa-gear" style="color: #ffffff;"></i>
                            </button>
                            <form action="includes/user_delete.inc.php" method="POST">
                                <input type="hidden" name="id" value="<?= ($user['id']) ?>">
                                <button name="submit" class="delete">
                                    <i class="fa-solid fa-trash" style="color: #ffffff;"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>

            </div>
        </div>
    </div>
    <div class="modal-content" id="myModal">
        <div class="modal-header">
            <h1>Edit</h1>
            <span class="close" onclick="toggle()">&times;</span>
        </div>
        <form id="updateForm" action="includes/user_update.inc.php" method="post">
            <input type="hidden" name="id" id="id">
            <input type="email" name="email" id="email" placeholder="Email">
            <input type="password" name="pwd" placeholder="Password">
            <button type="submit" onclick="toggle()">Update</button>
        </form>
    </div>    
</body>
</html>
