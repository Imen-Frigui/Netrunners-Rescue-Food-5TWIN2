<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusher Test</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
</head>
<body>

<form method="POST" action="{{ route('logout') }}" class="d-none" id="logout-form">
    @csrf
</form>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="navbar-nav justify-content-between w-100">
                <li>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $titlePage }}</li>
                        </ol>
                        <h6 class="font-weight-bolder mb-0">{{ $titlePage }}</h6>
                    </nav>
                </li>
                <li class="nav-item pe-2 d-flex align-items-center ms-auto">
                    <a href="javascript:;" class="nav-link text-body p-0" id="notificationButton" data-bs-toggle="modal" data-bs-target="#lowStockModal">
                        <i class="fas fa-bell cursor-pointer" style="font-size: 1.5rem;"></i>
                        <span id="notificationBadge" class="badge bg-danger" style="display: none; font-size: 0.8rem; position: relative; top: -10px; right: -5px;">!</span>
                    </a>
                </li>
                <li class="nav-item pe-2 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body font-weight-bold px-0">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Modal -->
    <div class="modal fade" id="lowStockModal" tabindex="-1" aria-labelledby="lowStockModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="lowStockModalLabel">Low Stock Items</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="lowStockItems">
                        <p class="text-sm">No low stock items</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        Pusher.logToConsole = true;

        const pusher = new Pusher('210177bd803d422ab0e8', {
            cluster: 'eu',
            encrypted: true
        });

        const channel2 = pusher.subscribe('Rescue_Food');
        channel2.bind('notification', async function(data) {
            console.log('Received data:', data);
            const lowStockItemsDiv = document.getElementById('lowStockItems');
            const notificationBadge = document.getElementById('notificationBadge');
            
            notificationBadge.style.display = 'inline-block';
            lowStockItemsDiv.innerHTML = ''; 

            if (data.items.length === 0) {
                lowStockItemsDiv.innerHTML = '<p class="text-sm">No low stock items</p>';
            } else {
                let itemsHTML = '';
                const fetchPromises = data.items.map(item => 
                    fetch(`/api/get-details?food_id=${item.food_id}&restaurant_id=${item.restaurant_id}`)
                        .then(response => response.json())
                        .then(details => {
                            itemsHTML += `
                                <div class="d-flex justify-content-between">
                                    <span class="text-sm">
                                        ${details.restaurant_name} - ${details.food_name} (Quantity on hand: ${item.quantity_on_hand})
                                    </span>
                                    <span class="text-xs text-danger">${item.minimum_quantity} minimum</span>
                                </div>`;
                        })
                        .catch(error => console.error('Error fetching details:', error))
                );

                await Promise.all(fetchPromises);
                lowStockItemsDiv.innerHTML = itemsHTML;
            }
        });

        document.getElementById('notificationButton').addEventListener('click', function() {
            document.getElementById('notificationBadge').style.display = 'none';
        });

        document.getElementById('logoutButton').addEventListener('click', function() {
            console.log('Logout button clicked');
            window.location.href = '/logout'; // Adjust this URL to your actual logout endpoint
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
</body>
</html>
