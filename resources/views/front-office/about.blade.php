@extends('components.front-office')

@section('content')
<x-navbars.Navbar activePage='about'></x-navbars.Navbar>

<div class="container mx-auto py-12 px-4">
    <div class="text-center mb-8">
        <h1 class="text-4xl font-bold text-green-600">About Us</h1>
        <p class="text-gray-600 mt-4">Rescue Food Company - Committed to Reducing Food Waste</p>
    </div>

    <div class="flex flex-wrap items-center">
        <div class="w-full md:w-1/2 p-4">
            <h2 class="text-2xl font-semibold text-green-500">Who We Are</h2>
            <p class="text-gray-700 mt-4">
                At Rescue Food Company, we believe that perfectly good food shouldn't go to waste.
                Our mission is to rescue surplus food from restaurants, grocery stores, and local farmers, 
                and redirect it to those in need. By reducing food waste, we help create a more sustainable environment 
                while supporting our local communities.
            </p>
            <p class="text-gray-700 mt-4">
                We are a team of passionate individuals who work tirelessly to connect excess food with people 
                who can use it. Our goal is to bring together businesses, volunteers, and communities to tackle 
                the growing issue of food waste and hunger.
            </p>
        </div>

        <div class="w-full md:w-1/2 p-4">
            <div class="relative w-full h-56 overflow-hidden rounded-lg shadow-lg">
                <img src="{{ asset('assets/img/about3.jpg') }}" alt="Rescue Food Company" class="absolute inset-0 w-full h-full object-cover">
            </div>
        </div>
    </div>

    <div class="mt-12">
        <h2 class="text-2xl font-semibold text-green-500">Our Impact</h2>
        <p class="text-gray-700 mt-4">
            Since our founding, we have rescued thousands of pounds of food, reducing greenhouse gas emissions 
            and providing meals to countless individuals in need. By working with local partners, we ensure that 
            the food reaches those who can benefit the most.
        </p>
        <p class="text-gray-700 mt-4">
            We are proud to be a part of the food rescue movement, and we aim to grow our efforts to make a 
            significant impact on food sustainability. Together, we can create a world where food is valued and 
            waste is minimized.
        </p>
    </div>
    <div class="w-full md:w-1/2 p-4">
            <div class="relative w-full h-56 overflow-hidden rounded-lg shadow-lg">
                <img src="{{ asset('assets/img/about2.jpg') }}" alt="Rescue Food Company" class="absolute inset-0 w-full h-full object-cover">
            </div>
        </div>
    </div>
    <div class="mt-12 text-center">
        <a href="/contact" class="inline-block bg-green-500 text-white py-2 px-6 rounded hover:bg-green-600">
            Get Involved
        </a>
    </div>
</div>

@endsection
