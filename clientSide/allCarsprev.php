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
    //$allCars = $car->getAllCars();
    $allMake = $car->getAllMake();
    $allModals = $car->getAllModel();
    $allYears = $car->getAllYears();

    $brandImages = $slider->getAllBrandImages();

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

    <div class="fixed-collapse" style="display:flex">

        <a class="nav-link collapsed" style="display:flex; margin-left:15px; background-color:black; width:fit-content;border-radius:15%" href="#" data-bs-toggle="collapse" data-bs-target="#mainPageDetailsCollapse" aria-expanded="false" aria-controls="mainPageDetailsCollapse">
            <button class="sb-nav-link-icon " style="color:white; padding:10px; "><i class="fas fa-filter" style="color:white"></i> Filter</button>

            <div class="sb-nav-link-icon ms-auto"></div>
        </a>
             <div class="input-wrapper">
            <button class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" height="25px" width="25px">
                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"></path>
                    <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5" stroke="#fff" d="M22 22L20 20"></path>
                </svg>
            </button>
            <input placeholder="search.." class="input" id="search-input" name="text" type="text">
        </div>  

    </div>
    <div class="collapse " id="mainPageDetailsCollapse" style="padding-left:15px; padding-right:15px; padding-top:15px">
        <div class="card card-body pl-3 pr-3">
            <!-- Filter Box -->
            <form action="" method="post" id="filterForm">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="filterMake" class="form-label">Make</label>

                        <select class="form-control" name="make" id="filterMake">
                            <?php foreach ($allMake as $make) {
                            ?>
                                <option value="<?php echo ($make['Make']) ?>"><?php echo ($make['Make']) ?> </option>
                            <?php  } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filterModel" class="form-label">Model</label>
                        <select class="form-control" name="model" id="filterModel">
                            <option value="any" selected>Any</option>
                            <?php foreach ($allModals as $model) {

                            ?>
                                <option value="<?php echo ($model['Model']) ?> "><?php echo ($model['Model']) ?> </option>

                            <?php  } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filterYear" class="form-label">Year</label>
                        <select class="form-control" name="year" id="filterYear">
                            <option value="any" selected>Any</option>
                            <?php foreach ($allYears as $year) { ?>
                                <option value="<?php echo ($year['Year']) ?> "><?php echo ($year['Year']) ?> </option>
                            <?php  } ?>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="filterCondition" class="form-label">Condition</label>
                        <select class="form-control" name="condition" id="filterCondition">
                            <option value="any" selected>Any</option>
                            <option value="1">New</option>
                            <option value="0">Used</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filterGear" class="form-label">Gear</label>
                        <select class="form-control" name="gear" id="filterGear">
                            <option value="any" selected>Any</option>
                            <option value="Automatic">Automatic</option>
                            <option value="Manual">Manual</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="filterPrice" class="form-label">Price</label>
                        <select class="form-control" id="filterPrice" name="price">
                            <option value="any" selected>Any</option>
                            <option value="under-20000">Under $20,000</option>
                            <option value="20000-40000">$20,000 - $40,000</option>
                            <option value="40000-60000">$40,000 - $60,000</option>
                            <option value="60000-80000">$60,000 - $80,000</option>
                            <option value="over-80000">Over $80,000</option>
                        </select>
                    </div>
                </div>
                <br>

                <div class="row mb-3">
                    <div class="col-md-4 d-flex align-items-start">
                        <button type="submit" class="btn btn-primary" style="color:white; background-color:black">Apply Filters</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <br>



    <?php
    // Get the current page number from the query parameter, default to 1
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = 10; // Number of cars per page
    $offset = ($page - 1) * $limit;

    // Fetch the total number of cars
    $totalCars = $car->getTotalCarsCount();

    // Calculate total pages
    $totalPages = ceil($totalCars / $limit);

    // Fetch the cars for the current page
    $allCars = $car->getAllCarsUPT($limit, $offset);

    ?>

<div>
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
                                        <div class="btn-group" role="group" >
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

    <div style="text-align: center; margin-top: 20px;">
        <nav aria-label="Page navigation">
            <ul style="display: inline-flex; list-style: none; padding: 0; margin: 0; background-color: #333333; border-radius: 5px;">
                <?php if ($page > 1) : ?>
                    <li style="margin: 0;">
                        <a href="?page=<?php echo $page - 1; ?>" aria-label="Previous" style="display: block; padding: 10px 15px; color: #ffffff; text-decoration: none; border: 1px solid #444444; border-radius: 5px; background-color: #444444;">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li style="margin: 0;">
                        <a href="?page=<?php echo $i; ?>" class="<?php if ($i == $page) echo 'active'; ?>" style="display: block; padding: 10px 15px; color: <?php echo $i == $page ? '#ffffff' : '#cccccc'; ?>; text-decoration: none; border: 1px solid #444444; border-radius: 5px; background-color: <?php echo $i == $page ? '#222222' : '#333333'; ?>;">
                            <?php echo $i; ?>
                        </a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $totalPages) : ?>
                    <li style="margin: 0;">
                        <a href="?page=<?php echo $page + 1; ?>" aria-label="Next" style="display: block; padding: 10px 15px; color: #ffffff; text-decoration: none; border: 1px solid #444444; border-radius: 5px; background-color: #444444;">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
    </div>




    <?php require_once('components/footersub.php'); ?>
    <?php require_once('components/script.php'); ?>
</body>
<script>
    $(document).ready(function() {
        $('#filterForm').on('submit', function(event) {
            event.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: 'actions/filter.php', // Update this with your backend URL
                type: 'POST',
                data: $(this).serialize() + '&page=' + ($('#currentPage').val() || 1), // Serialize form data and add page number
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        let html = '';
                        response.data.forEach(car => {

                            html += `
                            <div class='grid-item'>
                                <div class='panel panel-default custom-card'>
                                    <div class='custom-card-img'>
                                        <img src='../adminPanel/assets/img/allCars/${car.ImageName}' class='imgg img-responsive' alt='${car.Make}-${car.Model}'>
                                    </div>
                                    <div class='custom-card-body'>
                                        <div class='panel-body'>
                                            <small>${car.Year} | ${car.gear}</small>
                                            <h4>${car.Make} ${car.Model}</h4>
                                            <p>${car.Description}</p>
                                            <div class='custom-card-footer'>
                                                <div class='price-mpg'>
                                                    <span class='price'>$${parseFloat(car.Price).toFixed(2)}</span>
                                                </div>
                                                <div class='btn-group btn-group-justified' role='group'>
                                                    <div class='btn-group' role='group'>
                                                        <button type='button' class='explore'>Explore</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                        });

                        $('#contentContainer').html(html); // Update results container with response

                        // Handle pagination
                        let paginationHtml = '';
                        if (response.currentPage > 1) {
                            paginationHtml += `<a href="#" data-page="${response.currentPage - 1}">Previous</a>`;
                        }
                        for (let i = 1; i <= response.totalPages; i++) {
                            paginationHtml += `<a href="#" data-page="${i}" class="${i === response.currentPage ? 'active' : ''}">${i}</a>`;
                        }
                        if (response.currentPage < response.totalPages) {
                            paginationHtml += `<a href="#" data-page="${response.currentPage + 1}">Next</a>`;
                        }
                        $('#paginationContainer').html(paginationHtml);
                    } else {
                        // Use SweetAlert for informational messages
                        Swal.fire({
                            icon: 'info',
                            title: 'Info',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    // Use SweetAlert for AJAX errors
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred while processing your request.'
                    });
                }
            });
        });

        // Handle pagination click events
        $(document).on('click', '#paginationContainer a', function(event) {
            event.preventDefault();
            const page = $(this).data('page');
            $('#currentPage').val(page); // Update current page
            $('#filterForm').submit(); // Trigger form submission
        });
    });


    document.addEventListener('DOMContentLoaded', () => {
        const contentContainer = document.getElementById('contentContainer');
        const paginationContainer = document.getElementById('paginationContainer');

        function fetchContent(query, page = 1) {
            fetch(`actions/search.php?query=${query}&page=${page}`)
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Debugging: Log the fetched data
                    if (data.status === 'success') {
                        contentContainer.innerHTML = data.data.map(car => `
                        <div class='grid-item'>
                            <div class='panel panel-default custom-card'>
                                <div class='custom-card-img'>
                                    <img src='../adminPanel/assets/img/allCars/${car.ImageName}' class='imgg img-responsive' alt='${car.Make}-${car.Model}'>
                                </div>
                                <div class='custom-card-body'>
                                    <div class='panel-body'>
                                        <small>${car.Year} | ${car.gear}</small>
                                        <h4>${car.Make} ${car.Model}</h4>
                                        <p>${car.Description}</p>
                                        <div class='custom-card-footer'>
                                            <div class='price-mpg'>
                                                <span class='price'>$${parseFloat(car.Price).toFixed(2)}</span>
                                            </div>
                                            <div class='btn-group btn-group-justified' role='group'>
                                                <div class='btn-group' role='group'>
                                                    <button type='button' class='explore'>Explore</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `).join('');

                        paginationContainer.innerHTML = '';
                        if (data.currentPage > 1) {
                            paginationContainer.innerHTML += `<a href="#" data-page="${data.currentPage - 1}">Previous</a>`;
                        }
                        for (let i = 1; i <= data.totalPages; i++) {
                            paginationContainer.innerHTML += `<a href="#" data-page="${i}" class="${i === data.currentPage ? 'active' : ''}">${i}</a>`;
                        }
                        if (data.currentPage < data.totalPages) {
                            paginationContainer.innerHTML += `<a href="#" data-page="${data.currentPage + 1}">Next</a>`;
                        }
                    } else {
                        contentContainer.innerHTML = `<p>${data.message}</p>`;
                    }
                })
                .catch(error => {
                    console.error('Error fetching content:', error);
                });
        }

        $('#search-input').on('input', function() {
            const query = $(this).val();
            fetchContent(query);
        });

        paginationContainer.addEventListener('click', (e) => {
            if (e.target.tagName === 'A') {
                e.preventDefault();
                const page = parseInt(e.target.getAttribute('data-page'), 10);
                const query = document.getElementById('search-input').value;
                fetchContent(query, page);
            }
        });
    });
</script>

</html>