<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Donation Registration</title>
    <link rel="stylesheet" href="blood_donation_registration_system.css">
</head>
<body>
<div class="container">
    <h1>Blood Donation Registration</h1>

    <?php
    // Initialize variables
    $nameErr = $addressErr = $bloodGroupErr = $phoneErr = $dateErr = "";
    $name = $address = $bloodGroup = $phone = $date = "";
    $users = [];

    // Form validation and processing
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate name
        if (empty($_POST["name"])) {
            $nameErr = "Name is required";
        } else {
            $name = clean_input($_POST["name"]);
            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                $nameErr = "Only letters and white space allowed";
            }
        }

        // Validate address
        if (empty($_POST["address"])) {
            $addressErr = "Address is required";
        } else {
            $address = clean_input($_POST["address"]);
        }

        // Validate blood group
        if (empty($_POST["bloodGroup"])) {
            $bloodGroupErr = "Blood group is required";
        } else {
            $bloodGroup = clean_input($_POST["bloodGroup"]);
            if (!preg_match("/^(A|B|AB|O)[+-]$/", $bloodGroup)) {
                $bloodGroupErr = "Invalid blood group format";
            }
        }

        // Validate phone number
        if (empty($_POST["phone"])) {
            $phoneErr = "Phone number is required";
        } else {
            $phone = clean_input($_POST["phone"]);
            if (!preg_match("/^[0-9]{10}$/", $phone)) {
                $phoneErr = "Invalid phone number";
            }
        }

        // Validate date
        if (empty($_POST["date"])) {
            $dateErr = "Date is required";
        } else {
            $date = clean_input($_POST["date"]);
        }

        // If no errors, save the user data
        if (empty($nameErr) && empty($addressErr) && empty($bloodGroupErr) && empty($phoneErr) && empty($dateErr)) {
            $user = [
                'name' => $name,
                'address' => $address,
                'bloodGroup' => $bloodGroup,
                'phone' => $phone,
                'date' => $date
            ];
            // In a real application, you would store this in a database.
            $users[] = $user;
        }
    }

    // Clean user input
    function clean_input($data) {
        return htmlspecialchars(stripslashes(trim($data)));
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $name; ?>">
        <span class="error"><?php echo $nameErr; ?></span><br>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo $address; ?>">
        <span class="error"><?php echo $addressErr; ?></span><br>

        <label for="bloodGroup">Blood Group:</label>
        <input type="text" id="bloodGroup" name="bloodGroup" value="<?php echo $bloodGroup; ?>" placeholder="e.g., A+, B-">
        <span class="error"><?php echo $bloodGroupErr; ?></span><br>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" value="<?php echo $phone; ?>">
        <span class="error"><?php echo $phoneErr; ?></span><br>

        <label for="date">Date:</label>
        <input type="date" id="date" name="date" value="<?php echo $date; ?>">
        <span class="error"><?php echo $dateErr; ?></span><br>

        <input type="submit" value="Register">
    </form>

    <h2>Registered Users</h2>
    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Address</th>
            <th>Blood Group</th>
            <th>Phone Number</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($users) > 0) : ?>
            <?php foreach ($users as $index => $user) : ?>
                <tr>
                    <td><?php echo $user['name']; ?></td>
                    <td><?php echo $user['address']; ?></td>
                    <td><?php echo $user['bloodGroup']; ?></td>
                    <td><?php echo $user['phone']; ?></td>
                    <td><?php echo $user['date']; ?></td>
                    <td>
                        <button onclick="editUser(<?php echo $index; ?>)">Edit</button>
                        <button onclick="deleteUser(<?php echo $index; ?>)">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="6">No users registered yet.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
    function editUser(index) {
        alert("Edit functionality not implemented in this version.");
    }

    function deleteUser(index) {
        alert("Delete functionality not implemented in this version.");
    }
</script>

</body>
</html>
