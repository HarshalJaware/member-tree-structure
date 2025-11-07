<?php
    require_once 'autoload.php';

    $member = new Member();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Member Tree Structure</title>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <h2>Member Tree Structure</h2>

            <!-- Show Member tree -->
            <div id="tree">
                <?php echo $member->createTree(); ?>
            </div>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" id="addMemberBtn">
            Add Member
            </button>

            <!-- Modal Start-->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="addForm"> <!-- move form to wrap footer -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Add New Member</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="parent_id" class="col-form-label">Parent Member:</label>
                                    <select class="form-control" id="parent_id" name="parent_id">
                                        <option value="">-- None --</option>
                                        <?php
                                        foreach ($member->getAllMembers() as $m) {
                                            echo "<option value='{$m['id']}'>{$m['name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name" class="col-form-label">Name:</label>
                                    <input type="text" name="name" id="name" placeholder="Enter name" class="form-control">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button> <!-- type="submit" -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Modal End-->
        </div>

        <script src="assets/js/index.js"></script>
    </body>
</html>
