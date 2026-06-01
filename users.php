<?php
// Connect to the database
$con = mysqli_connect("localhost", "root", "", "qadochub");
if (!$con) { die("Connection failed: " . mysqli_connect_error()); }

// Handle search
$search = "";
if(isset($_GET['search'])){
    $search = mysqli_real_escape_string($con, $_GET['search']);
}

// Fetch users
$query = "SELECT * FROM user_registration 
          WHERE last_name LIKE '%$search%' 
             OR first_name LIKE '%$search%' 
             OR role LIKE '%$search%' 
             OR department LIKE '%$search%' 
          ORDER BY user_id ASC";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-5xl mx-auto bg-white shadow rounded p-6">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-2xl font-bold">Users Management</h1>
            <div>
                
                <a href="Dashboard.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
            </div>
        </div>

        <!-- Search Form -->
        <form method="get" class="mb-4 flex">
            <input type="text" name="search" placeholder="Search users..." value="<?php echo htmlspecialchars($search); ?>" class="border rounded-l px-4 py-2 w-full">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r hover:bg-blue-600">Search</button>
        </form>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="py-2 px-4 border-b">Lastname</th>
                    <th class="py-2 px-4 border-b">Firstname</th>
                    <th class="py-2 px-4 border-b">Middle Initial</th>
                    <th class="py-2 px-4 border-b">Role</th>
                    <th class="py-2 px-4 border-b">Department</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if(mysqli_num_rows($result) > 0): ?>
                    <?php while($user = mysqli_fetch_assoc($result)): ?>
                        <tr class="text-center hover:bg-gray-100">
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($user['last_name']); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($user['first_name']); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($user['middle_initial']); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($user['role']); ?></td>
                            <td class="py-2 px-4 border-b"><?php echo htmlspecialchars($user['department']); ?></td>
                            <td class="py-2 px-4 border-b">
                                <a href="update_user.php?id=<?php echo $user['user_id']; ?>" class="text-blue-500 hover:underline">Update</a> |
                                <a href="delete_user.php?id=<?php echo $user['user_id']; ?>" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="py-4">No users found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
