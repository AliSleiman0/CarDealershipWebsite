<!doctype html>
<html lang="en">

<head>
    <?php session_start(); ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php require_once('components/header.php'); ?>
    <?php require_once "../adminPanel/class/index.class.php"; ?>
    <?php require_once "../adminPanel/class/cars.class.php"; ?>

    <?php
    $slider = new sliders();
    $car = new Car();
    
 
    
    // Fetch filter options
    $allMake = $car->getAllMake();
    $allModals = $car->getAllModel();
    $allYears = $car->getAllYears();

    // Initialize variables for filters and pagination
    $make = $_GET['make'] ?? 'any';
    $model = $_GET['model'] ?? 'any';
    $year = $_GET['year'] ?? 'any';
    $condition = $_GET['condition'] ?? 'any';
    $gear = $_GET['gear'] ?? 'any';
    $price = $_GET['price'] ?? 'any';
    $search = $_GET['search'] ?? ''; // Initialize search variable
    $page = $_GET['page'] ?? 1;
    $itemsPerPage = 10;

    // Construct SQL query with filters
    $sql = "SELECT * FROM cars WHERE 1=1";

    if ($make !== 'any') {
        $sql .= " AND Make = '$make'";
    }
    if ($model !== 'any') {
        $sql .= " AND Model = '$model'";
    }
    if ($year !== 'any') {
        $sql .= " AND Year = '$year'";
    }
    if ($condition !== 'any') {
        $sql .= " AND Condition = '$condition'";
    }
    if ($gear !== 'any') {
        $sql .= " AND Gear = '$gear'";
    }
    if ($price !== 'any') {
        switch ($price) {
            case 'under-20000':
                $sql .= " AND Price < 20000";
                break;
            case '20000-40000':
                $sql .= " AND Price BETWEEN 20000 AND 40000";
                break;
            case '40000-60000':
                $sql .= " AND Price BETWEEN 40000 AND 60000";
                break;
            case '60000-80000':
                $sql .= " AND Price BETWEEN 60000 AND 80000";
                break;
            case 'over-80000':
                $sql .= " AND Price > 80000";
                break;
        }
    }
    if (!empty($search)) {
        $sql .= " AND (Make LIKE '%$search%' OR Model LIKE '%$search%' OR Description LIKE '%$search%')";
    }

    // Get the total count of filtered cars for pagination
    $totalCars = count($car->getdata($sql));
    $totalPages = ceil($totalCars / $itemsPerPage);

    // Apply pagination
    $offset = ($page - 1) * $itemsPerPage;
    $sql .= " LIMIT $itemsPerPage OFFSET $offset";
    $allCars = $car->getdata($sql);
    ?>

    <link href="components/allCarsStyle.css" rel="stylesheet">
    <style>
        body {
            background-color: #333;
        }

        .custom-card:hover {
            transform: scale(1.025);
            box-shadow: 0 4px 8px black;
            transform: translateY(-10px);
        }

        .custom-card-img img {
            transition: transform 0.3s ease;
        }

        .custom-card:hover .custom-card-img img {
            transform: scale(1.025);
        }

        .sb-nav-link-icon i {
            color: black;
        }

        .input-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            position: relative;
        }

        .input {
            border-style: none;
            height: 50px;
            width: 50px;
            padding: 10px;
            outline: none;
            border-radius: 50%;
            transition: .5s ease-in-out;
            background-color: black;
            box-shadow: 0px 0px 3px #f3f3f3;
            padding-right: 40px;
            color: black;
        }

        .input::placeholder,
        .input {
            font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            font-size: 17px;
        }

        .input::placeholder {
            color: black;
        }

        .icon {
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            right: 0px;
            cursor: pointer;
            width: 50px;
            height: 50px;
            outline: none;
            border-style: none;
            border-radius: 50%;
            pointer-events: painted;
            background-color: transparent;
            transition: .2s linear;
        }

        .icon:focus~.input,
        .input:focus {
            box-shadow: none;
            width: 250px;
            border-radius: 0px;
            background-color: transparent;
            border-bottom: 3px solid black;
            transition: all 500ms cubic-bezier(0, 0.110, 0.35, 2);
        }

        @media (max-width: 600px) {
            .grid-container {
                display: flex;
                flex-direction: column;
            }

            .grid-item {
                width: 100%;
            }

            .custom-card {
                display: flex;
                flex-direction: column;
            }

            .custom-card-img,
            .custom-card-body {
                width: 100%;
            }

            .custom-card-img img {
                width: 100%;
                height: auto;
            }

            .custom-card-body {
                padding: 10px;
            }
        }

        @media (max-width: 1092px) {
            .grid-container {
                display: flex;
                flex-direction: column;
            }

            .grid-item {
                width: 100%;
            }

            .custom-card {
                display: flex;
                flex-direction: column;
            }

            .custom-card-img,
            .custom-card-body {
                width: 100%;
            }

            .custom-card-img img {
                width: 100%;
                height: auto;
            }

            .custom-card-body {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <?php require_once('components/navSubPages.php'); ?>

    <br>
    <br>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <div class="fixed-collapse" style="display:flex;gap:10px; margin-bottom: 10px;">
        <a class="nav-link collapsed" style="display:flex; margin-left:15px; background-color:black; width:fit-content;border-radius:15%" href="#" data-bs-toggle="collapse" data-bs-target="#mainPageDetailsCollapse" aria-expanded="false" aria-controls="mainPageDetailsCollapse">
            <button class="sb-nav-link-icon " style="color:white; padding:10px; "><i class="fas fa-filter" style="color:white"></i> Filter</button>

            <div class="sb-nav-link-icon ms-auto"></div>
        </a>

        <!-- Add search form wrapper -->
        <form id="searchForm" method="GET" action="" class="input-wrapper">
            <button type="submit" class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="25px" width="25px">
                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" />
                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M22 22L20 20" />
                </svg>
            </button>
            <input id="searchInput" name="search" class="input" placeholder="search" autocomplete="off" value="<?php echo htmlspecialchars($search); ?>">
        </form>

    </div>

    <div class="collapse" id="mainPageDetailsCollapse" style="padding-left:15px; padding-right:15px; padding-top:15px">
        <div class="card card-body pl-3 pr-3 pb-5">
            <!-- Filter Box -->
            <form action="" method="get" id="filterForm">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="filterMake" class="form-label">Make</label>
                        <select class="form-control" name="make" id="filterMake">
                            <option value="any" selected>Any</option>
                            <?php foreach ($allMake as $makeOption) { ?>
                                <option value="<?php echo $makeOption['Make']; ?>" <?php if ($makeOption['Make'] == $make) echo 'selected'; ?>><?php echo $makeOption['Make']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filterModel" class="form-label">Model</label>
                        <select class="form-control" name="model" id="filterModel">
                            <option value="any" selected>Any</option>
                            <?php foreach ($allModals as $modelOption) { ?>
                                <option value="<?php echo $modelOption['Model']; ?>" <?php if ($modelOption['Model'] == $model) echo 'selected'; ?>><?php echo $modelOption['Model']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filterYear" class="form-label">Year</label>
                        <select class="form-control" name="year" id="filterYear">

                            <option value="any" <?php echo ($year === 'any') ? 'selected' : ''; ?>>Any</option>
                            <?php
                            $currentYear = 2024; // Change this to the current year if needed
                            $startYear = 2000;

                            for ($year = $currentYear; $year >= $startYear; $year--) {
                                echo '<option value="' . $year . '" ' . ($year == htmlspecialchars($_GET['year']) ? 'selected' : '') . '>' . $year . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="filterCondition" class="form-label">Condition</label>
                        <select class="form-control" name="condition" id="filterCondition">
                            <option value="any" selected>Any</option>
                            <option value="new" <?php if ($condition == 'new') echo 'selected'; ?>>New</option>
                            <option value="used" <?php if ($condition == 'used') echo 'selected'; ?>>Used</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filterGear" class="form-label">Gear</label>
                        <select class="form-control" name="gear" id="filterGear">
                            <option value="any" selected>Any</option>
                            <option value="automatic" <?php if ($gear == 'automatic') echo 'selected'; ?>>Automatic</option>
                            <option value="manual" <?php if ($gear == 'manual') echo 'selected'; ?>>Manual</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filterPrice" class="form-label">Price</label>
                        <select class="form-control" name="price" id="filterPrice">
                            <option value="any" selected>Any</option>
                            <option value="under-20000" <?php if ($price == 'under-20000') echo 'selected'; ?>>Under $20,000</option>
                            <option value="20000-40000" <?php if ($price == '20000-40000') echo 'selected'; ?>>$20,000 - $40,000</option>
                            <option value="40000-60000" <?php if ($price == '40000-60000') echo 'selected'; ?>>$40,000 - $60,000</option>
                            <option value="60000-80000" <?php if ($price == '60000-80000') echo 'selected'; ?>>$60,000 - $80,000</option>
                            <option value="over-80000" <?php if ($price == 'over-80000') echo 'selected'; ?>>Over $80,000</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary" style="margin-bottom:10px">Apply Filters</button>
                    </div>
                </div>
            </form>
            <!-- End Filter Box -->
        </div>
    </div>


    <div class="container">
        <div id="contentContainer" class="grid-container">
            <?php foreach ($allCars as $car) {
                $image = $slider->getRandomImagesByID($car['CarID']);
            ?>
                <div class="grid-item">
                    <div class="panel panel-default custom-card">
                        <div class="custom-card-img">
                            <img src='../adminPanel/assets/img/allCars/<?php echo $image[0]['ImageName']; ?>' class="imgg img-responsive" alt="<?php echo $car['Make'] ?>-<?php echo $car['Model'] ?>">
                        </div>
                        <div class=" custom-card-body">
                            <div class="panel-body">
                                <small><?php echo $car['Year'] ?> | <?php echo $car['gear'] ?></small>
                                <h4><?php echo $car['Make'] ?> <?php echo $car['Model'] ?></h4>
                                <p><?php echo $car['Description'] ?></p>
                                <div class="custom-card-footer">
                                    <div class="price-mpg">
                                        <span class="price">$<?php echo number_format($car['Price']); ?></span>
                                    </div>
                                    <div class="btn-group btn-group-justified" style="margin-top:15px" role="group">
                                        <div class="btn-group" role="group">
                                            <button type="button" class="explore" onclick="window.location.href='car.php?id=<?php echo $car['CarID'] ?>'">Explore</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation" style="display: block; text-align: center;">
        <ul class="pagination justify-content-center" style="background: linear-gradient(90deg, #333, #555); border-radius: 10px; padding: 10px;">
            <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page - 1])); ?>" style="color: white; background-color: #444; border: none; margin: 0 5px;">Previous</a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>" style="margin: 0 5px;">
                    <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $i])); ?>" style="color: <?php echo $i == $page ? 'black' : 'white'; ?>; background-color: <?php echo $i == $page ? '#ffffff' : '#444444'; ?>; border: none;"><?php echo $i; ?></a>
                </li>
            <?php } ?>
            <li class="page-item <?php if ($page == $totalPages) echo 'disabled'; ?>">
                <a class="page-link" href="?<?php echo http_build_query(array_merge($_GET, ['page' => $page + 1])); ?>" style="color: white; background-color: #444; border: none; margin: 0 5px;">Next</a>
            </li>
        </ul>


      
    </nav>

    <?php require_once('components/footer.php'); ?>
    <?php require_once('components/script.php'); ?>


</body>

</html>