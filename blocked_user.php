<?php
include("components/db/db_connection.php");
include("components/header.php");
include("components/navbar.php");

// Check if the current user is an admin
$is_admin = false;

// Retrieve the current user's information
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $query = "SELECT * FROM users WHERE id = $user_id";
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die('Error querying database: ' . mysqli_error($connection));
    }

    $user = mysqli_fetch_assoc($result);

    if ($user && $user['is_admin'] == 1) {
        $is_admin = true;
    }
}

// Retrieve a list of all users
$users = array();

$query = "SELECT * FROM users";
$result = mysqli_query($connection, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
}

// Debugging output
var_dump(isset($_SESSION['user_id']));
var_dump($result);
var_dump(mysqli_fetch_assoc($result));
var_dump(isset($user));
var_dump($is_admin);
var_dump(isset($user['is_admin']) ? $user['is_admin'] : null);
?>



<div class="container mx-auto py-8">

    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold">Blocked Users</h1>
        <a href="dashboard_admin.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Dashboard</a>
    </div>

    <table class="w-full border-collapse">
        <thead>
            <tr class="bg-gray-100">
                <th class="border text-left px-8 py-4">#</th>
                <th class="border text-left px-8 py-4">Name</th>
                <th class="border text-left px-8 py-4">IC Number</th>
                <th class="border text-left px-8 py-4">Blocked</th>
                <th class="border text-left px-8 py-4">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            mysqli_data_seek($result, 0);
            foreach ($users as $user) :
            ?>
                <?php if ($user['is_blocked'] == 1) : ?>
                    <tr>
                        <td class="border px-4 py-2"><?php echo $user['id']; ?></td>
                        <td class="border px-4 py-2"><?php echo $user['name']; ?></td>
                        <td class="border px-4 py-2"><?php echo $user['ic']; ?></td>
                        <td class="border px-4 py-2"><?php echo $user['is_blocked'] ? '<span class="bg-red-500 text-white px-2 rounded">Blocked</span>' : '<span class="bg-green-500 text-white px-2 rounded">Active</span>'; ?></td>
                        <td class="border px-4 py-2">
                            <?php if ($is_admin) : ?>
                                <form action="unblock_user.php" method="post" class="inline">
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Unblock</button>
                                </form>
                            <?php else : ?>
                                <span class="text-gray-500">Not Available</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </tbody>
    </table>


</div>

<?php include("components/footer.php"); ?>