<div class="card w-50">
    <?php
    if (isset($_SESSION["message_error"])) {
    ?>
        <div class="alert alert-danger">
            <p><?= $_SESSION["message_error"]; ?></p>
        </div>
    <?php
        unset($_SESSION["message_error"]);
    } elseif (isset($_SESSION["message_success"])) {
    ?>
        <div class="alert alert-success">
            <p><?= $_SESSION["message_success"]; ?></p>
        </div>
    <?php
        unset($_SESSION["message_success"]);
    }
    ?>
    <div class="card-header text-center">
        <h3>Change Password</h3>
    </div>
    <div class="card-body">
        <form action="index.php?action=change_password" method="post">
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></div>
                    <input class="form-control" name="current" type="password" placeholder="Current Password">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                    <input class="form-control" name="new" type="password" placeholder="New Password">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-addon"><span class="glyphicon glyphicon-log-in"></span></div>
                    <input class="form-control" name="new2" type="password2" placeholder="Confirm new Password">
                </div>
            </div>
            <center>
                <button name="submit" class="btn btn-md btn-danger">Change</button>
            </center>
        </form>
    </div>
</div>