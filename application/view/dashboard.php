<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DASHBOARD</title>
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/application/assets/css/main.css">
</head>
<body>
<h1 class="text-uppercase centered-text">dashboard</h1>
<div class="row">
    <div class="col-md-3">
        <div class="filter">
            <h4 class="text-uppercase">filters:</h4>
            <form id="dashboardFilter" class="center-block">
                <div class="form-group">
                    <input type="radio" name="userName" value="asc" checked> filter by user name (asc) <br>
                    <input type="radio" name="userName" value="desc"> filter by user name (desc) <br>
                </div>
                <div class="form-group">
                    <input type="radio" name="userEmail" value="asc" checked> filter by user email (asc) <br>
                    <input type="radio" name="userEmail" value="desc"> filter by user email (desc) <br>
                </div>
                <div class="form-group">
                    <input type="radio" name="userCreateDate" value="asc" checked> filter by create date (asc) <br>
                    <input type="radio" name="userCreateDate" value="desc"> filter by create date (desc) <br>
                </div>

                <button type="submit" id="filterButton" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <table id="feedbackTable" class="table"></table>
        <div class="nav-bar">
            <button class="btn btn-default" id="nav-bar-prev">Prev</button>
            <button class="btn btn-default" id="nav-bar-next">Next</button>
        </div>
    </div>
    <div class="col-md-1"></div>

    <script src="/vendor/components/jquery/jquery.min.js"></script>
    <script src="/application/assets/js/dashboard.js"></script>

</div>
</body>
</html>