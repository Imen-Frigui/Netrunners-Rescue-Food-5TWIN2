<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity List</title>
    <!-- Font Awesome CDN (latest version) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-LQjbQ1R/BNeX99hrzujfR72t39u56bD8gSkpX8z9HIe8IH+GPmB36Ju7B+0xDk1FfWyFr1BoQcoNUVZKHzUTsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CDN for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        /* From Uiverse.io by satyamchaudharydev */ 
        .card {
            --bg: #f7f7f8;
            --hover-bg: #77DD77;
            --hover-text: #E50087;
            max-width: 40ch;
            text-align: center;
            background: var(--bg);
            padding: 1.5em;
            padding-block: 1.8em;
            border-radius: 5px;
            position: relative;
            overflow: hidden;
            transition: .3s cubic-bezier(.6,.4,0,1), transform .15s ease;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1em;
        }

        .card__body {
            color: #464853;
            line-height: 1.5em;
            font-size: 1em;
        }

        .card > :not(span) {
            transition: .3s cubic-bezier(.6,.4,0,1);
        }

        .card > strong {
            display: block;
            font-size: 1.4rem;
            letter-spacing: -.035em;
        }

        .card span {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--hover-text);
            border-radius: 5px;
            font-weight: bold;
            top: 100%;
            transition: all .3s cubic-bezier(.6,.4,0,1);
        }

        .card:hover span {
            top: 0;
            font-size: 1.2em;
        }

        .card:hover {
            background: var(--hover-bg);
        }

        .card:hover > div, .card:hover > strong {
            opacity: 0;
        }

        /* Icon Style */
        .card .icon {
            width: 48px; /* Adjust the width */
            height: 48px; /* Adjust the height */
            margin-bottom: 10px; /* Space between icon and name */
            fill: #000; /* Icon color */
        }

        /* Pagination Styles */
        .pagination {
            justify-content: center; /* Center the pagination */
            margin-top: 20px; /* Space above pagination */
        }

        .pagination li {
            margin: 0 5px; /* Spacing between pagination items */
        }

        .pagination li a {
            display: block; /* Make the entire area clickable */
            padding: 8px 12px; /* Padding for links */
            border: 1px solid #E50087; /* Border color */
            border-radius: 5px; /* Rounded corners */
            color: #E50087; /* Text color */
            text-decoration: none; /* No underline */
            transition: background 0.3s, color 0.3s; /* Smooth transition */
        }

        .pagination li a:hover {
            background: #E50087; /* Background color on hover */
            color: white; /* Change text color on hover */
        }

        .pagination .active a {
            background: #E50087; /* Active page background color */
            color: white; /* Active page text color */
            border: 1px solid #E50087; /* Keep the border the same */
        }

        .pagination .disabled a {
            color: #ccc; /* Color for disabled links */
            pointer-events: none; /* Disable clicking */
            background: none; /* No background for disabled */
            border: 1px solid transparent; /* No border */
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            @foreach($charities as $charity)
                <div class="col-md-3 mb-4"> <!-- 4 cards in a row -->
                    <div class="card">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" width="48" height="48">
                                <path d="M163.9 136.9c-29.4-29.8-29.4-78.2 0-108s77-29.8 106.4 0l17.7 18 17.7-18c29.4-29.8 77-29.8 106.4 0s29.4 78.2 0 108L310.5 240.1c-6.2 6.3-14.3 9.4-22.5 9.4s-16.3-3.1-22.5-9.4L163.9 136.9zM568.2 336.3c13.1 17.8 9.3 42.8-8.5 55.9L433.1 485.5c-23.4 17.2-51.6 26.5-80.7 26.5L192 512 32 512c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l36.8 0 44.9-36c22.7-18.2 50.9-28 80-28l78.3 0 16 0 64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0-16 0c-8.8 0-16 7.2-16 16s7.2 16 16 16l120.6 0 119.7-88.2c17.8-13.1 42.8-9.3 55.9 8.5zM193.6 384c0 0 0 0 0 0l-.9 0c.3 0 .6 0 .9 0z"/>
                            </svg>
                        </div>
                        <strong>{{ \Illuminate\Support\Str::limit($charity->charity_name, 7, '...') }}</strong>
                        <div class="card__body">
                            {{ $charity->contact_info['email'] ?? '' }}
                        </div>
                        <span>
                            <a rel="tooltip" class="" href="{{ route('charities.details', $charity->id) }}" title="View Details">View Details</a>
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Custom Pagination Links -->
        <div class="d-flex justify-content-center mt-4">
            @if ($charities->onFirstPage())
                <span class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <button class="btn btn-light" disabled>Previous</button>
                </span>
            @else
                <a href="{{ $charities->previousPageUrl() }}" rel="prev" class="btn btn-light">Previous</a>
            @endif

            @if ($charities->hasMorePages())
                <a href="{{ $charities->nextPageUrl() }}" rel="next" class="btn btn-light">Next</a>
            @else
                <span class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                    <button class="btn btn-light" disabled>Next</button>
                </span>
            @endif
        </div>
    </div>
</body>
</html>
