@extends('components.front-office')

@section('content')

    <x-navbars.Navbar activePage="charities"></x-navbars.Navbar>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charity List</title>
<!-- Bootstrap JavaScript and jQuery (needed for modal functionality) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Font Awesome CDN (latest version) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-LQjbQ1R/BNeX99hrzujfR72t39u56bD8gSkpX8z9HIe8IH+GPmB36Ju7B+0xDk1FfWyFr1BoQcoNUVZKHzUTsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Bootstrap CDN for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        /* Container styles */
        .container {
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
            background: #4CAF50;
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
        h1 {
  position: relative;
  padding: 0;
  margin: 0;
  font-family: "Raleway", sans-serif;
  font-weight: 300;
  font-size: 40px;
  color: #080808;
  -webkit-transition: all 0.4s ease 0s;
  -o-transition: all 0.4s ease 0s;
  transition: all 0.4s ease 0s;
}

h1 span {
  display: block;
  font-size: 0.5em;
  line-height: 1.3;
}
h1 em {
  font-style: normal;
  font-weight: 600;
}
.two h1 {
  text-transform: capitalize;
}
.two h1:before {
 margin-top:20px;
  position: absolute;
  left: 0;
  bottom: 0;
  width: 60px;
  height: 2px;
  content: "";
  background-color: #4CAF50;
}

.two h1 span {
  font-size: 20px;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 4px;
  line-height: 3em;
  padding-left: 0.25em;
  color: rgba(0, 0, 0, 0.4);
  padding-bottom: 10px;
  margin-top:100px;
}
.alt-two h1 {
  text-align:center;
}
.alt-two h1:before {
  left:50%; margin-left:-30px;
}


/* Slide-in Transition Effect */
.page-container {
    position: relative;
    overflow: hidden;
}

.page-slide {
    transform: translateX(100%);
    transition: transform 0.5s ease-in-out;
}

.page-slide.active {
    transform: translateX(0);
}
/* Floating Circle Button on Bottom Right */
.floating-button {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background-color: #4CAF50; /* Button color */
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    transition: transform 0.3s ease;
    cursor: pointer;
}

.floating-button:hover {
    transform: scale(1.1); /* Slight grow effect on hover */
}

.btn-light {
    color: #66BB6A;
    background-color: white;
    border: 1px solid #66BB6A;
}

.btn-light:hover {
    background-image: linear-gradient(195deg, #66BB6A 0%, #43A047 100%);;
    color: white;
}
.current {
    background-color: #66BB6A; /* Primary color */
    color: white; /* Text color */
    border: 1px solid #66BB6A; /* Border matching the button */
}

    </style>
</head>

<body>
    <div class="two">
        <h1><span>Our Charities</span></h1>
    </div>

    <div class="mt-5">
        <div class="row">
            @foreach($charities as $charity)
            <div class="col-md-3 mb-4">
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
                                $rating = $charity->charity_rating;
                                $fullStars = floor($rating);
                                $halfStar = $rating - $fullStars >= 0.5 ? 1 : 0;
                                $emptyStars = 5 - ($fullStars + $halfStar);
                            @endphp
                            @for ($i = 0; $i < $fullStars; $i++)
                            <i class="fas fa-star" style="color: gold;"></i>
                            @endfor
                            @if ($halfStar)
                            <i class="fas fa-star-half-alt" style="color: gold;"></i>
                            @endif
                            @for ($i = 0; $i < $emptyStars; $i++)
                            <i class="far fa-star" style="color: gold;"></i>
                            @endfor
                            <strong style="color: gold;">{{ number_format($rating, 2) }}</strong>
                        </div>

                        <a class="btn bg-gradient-dark mb-0 mt-3 w-100" style="text-transform: none;" href="{{ route('charities.frontdetails', $charity->id) }}">
    <i class="fas fa-circle-info"></i> View Details
</a>
                     
                    </div>
                </div>
            </div>
            @endforeach
        </div>

      

<!-- Pagination Links -->
  
<div class="d-flex justify-content-center ">
    <!-- Previous Page Link -->
    @if ($charities->onFirstPage())
        <span class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <button class="btn btn-light" disabled>Previous</button>
        </span>
    @else
        <a href="{{ $charities->previousPageUrl() }}" rel="prev" class="btn btn-light">Previous</a>
    @endif

    <!-- Page Number Links -->
    @for ($i = 1; $i <= $charities->lastPage(); $i++)
        @if ($i == $charities->currentPage())
            <span class="current btn btn-primary mx-1">{{ $i }}</span> <!-- Current page style -->
        @else
            <a href="{{ $charities->url($i) }}" class="btn btn-light mx-1">{{ $i }}</a>
        @endif
    @endfor

    <!-- Ellipsis for pages in the middle -->
    @if ($charities->currentPage() < $charities->lastPage() - 1)
        <span class="disabled mx-1">...</span>
        <a href="{{ $charities->url($charities->lastPage()) }}" class="btn btn-light mx-1">{{ $charities->lastPage() }}</a>
    @endif

    <!-- Next Page Link -->
    @if ($charities->hasMorePages())
        <a href="{{ $charities->nextPageUrl() }}" rel="next" class="btn btn-light">Next</a>
    @else
        <span class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <button class="btn btn-light" disabled>Next</button>
        </span>
    @endif
</div>




@endsection
