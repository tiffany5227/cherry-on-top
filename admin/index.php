<!-- This allows you to take parts into your page -->
<?php include('partials/menu.php'); ?>

    <!-- Main Section Starts -->
    <div class="main-section">
        <div class="wrapper">
            <h1>DASHBOARD</h1>
            <br>

            <?php
                if(isset($_SESSION['login'])){
                        echo $_SESSION['login'];
                        unset($_SESSION['login']); //removing session message
                    }
            ?>

            <br><br>

            <div class="col-4">
                <h1>5</h1>
                </br>
                Categories
            </div>
            <div class="col-4">
                <h1>5</h1>
                </br>
                Categories
            </div>
            <div class="col-4">
                <h1>5</h1>
                </br>
                Categories
            </div>
            <div class="col-4">
                <h1>5</h1>
                </br>
                Categories
            </div>

            <div class="clearfix"></div>
        </div>
    </div>

</body>
</html>