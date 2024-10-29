@extends('components.front-office')

@section('content')

<x-navbars.Navbar activePage='charities'></x-navbars.Navbar>

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
        /* Container styles */
        .container {
            background-color: #77DD77;
            background-size: cover;
            width: 100%;
            background-position: center;
            background-repeat: no-repeat;
            padding: 20px;
            border-radius: 10px;
        }

        /* Title styles */
        .title {
            padding: 10px 60px 20px 10px;
            text-align: center;
            background-color: #f0f0f0;
            border-radius: 5px;
        }

        /* Card styles */
        .cardcharity {
            width: 100%; /* Make it responsive */
            background: white;
            border-radius: 30px;
            box-shadow: 15px 15px 30px #bebebe, -15px -15px 30px #ffffff;
            transition: 0.2s ease-in-out;
            overflow: hidden;
            height: 200px; /* or any suitable fixed height */

        }

        .img {
            height: 30%;
            background: linear-gradient(#e66465, #9198e5);
            display: flex;
            align-items: flex-start;
            justify-content: flex-end;
            position: relative;
            height: 50px; /* Set a fixed height */

        }

        .save {
            transition: 0.2s ease-in-out;
            border-radius: 10px;
            margin: 20px;
            width: 30px;
            height: 30px;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: 10px;
            right: 10px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .text {
            margin: 20px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .rating {
            display: flex;
            align-items: center;
        }

        .icon-box {
            margin-top: 1px;
            width: 100%;
            padding: 10px;
            background-color: #e3fff9;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .text .h3 {
            font-family: 'Lucida Sans', sans-serif;
            font-size: 15px;
            font-weight: 600;
            color: black;
        }

        .text .p {
            font-family: 'Lucida Sans', sans-serif;
            color: #999999;
            font-size: 13px;
        }

        .icon-box .span {
            margin-left: 10px;
            font-family: 'Lucida Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: #9198e5;
        }

        .cardcharity:hover {
            cursor: pointer;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .save:hover {
            transform: scale(1.1) rotate(10deg);
        }

        /* Pagination Styles */
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a {
            display: block;
            padding: 8px 12px;
            border: 1px solid #E50087;
            border-radius: 5px;
            color: #E50087;
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }

        .pagination li a:hover {
            background: #E50087;
            color: white;
        }

        .pagination .active a {
            background: #E50087;
            color: white;
            border: 1px solid #E50087;
        }

        .pagination .disabled a {
            color: #ccc;
            pointer-events: none;
            background: none;
            border: 1px solid transparent;
        }
    </style>
</head>

<body>
    <h1 class="mt-7 title text-capitalize">Our Charities</h1>
    <div class=" mt-5">
        <div class="row">
            @foreach($charities as $charity)
            <div class="col-md-3 mb-4"> <!-- 4 cards in a row -->
                <div class="cardcharity">
                    <div class="img">
                        <div class="save">
                            <i class="fas fa-solid fa-hand-holding-heart"></i>
                        </div>
                    </div>

                    <div class="text">
                        <p class="h3">{{ \Illuminate\Support\Str::limit($charity->charity_name, 20, '...') }}</p>
                        <div class="rating">
                            @php
                                $rating = $charity->charity_rating; // Assuming charity_rating is between 0-5
                                $fullStars = floor($rating); // Full stars
                                $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0; // 1 if a half star is needed
                                $emptyStars = 5 - ($fullStars + $halfStar); // Remaining empty stars
                            @endphp

                            <!-- Full Stars -->
                            @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fas fa-star" style="color: gold;"></i>
                            @endfor

                            <!-- Half Star if applicable -->
                            @if ($halfStar)
                            <i class="fas fa-star-half-alt" style="color: gold;"></i>
                            @endif

                            <!-- Empty Stars -->
                            @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="far fa-star" style="color: gold;"></i>
                            @endfor

                            <!-- Rating Number -->
                            <strong style="color: gold;">{{ number_format($rating, 2) }}</strong>
                        </div>

                        <div class="icon-box">
                            <p class="span">
                                <a rel="tooltip" href="{{ route('charities.frontdetails', $charity->id) }}" title="View Details">View Details</a>
                            </p>
                        </div>
                    </div>
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

@endsection
