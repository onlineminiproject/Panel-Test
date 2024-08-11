@extends('admin.layouts.master')

@section('content')
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #ffffff;
            color: #333;
        }

        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            padding: 2rem;
            text-align: center;
        }

        .header-section {
            padding: 2rem 0;
            background-color: #ffffff;
        }

        .header-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
        }

        .header-text {
            flex: 1;
            text-align: center;
            padding: 1rem;
        }

        .badge-custom {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-transform: none;
            display: inline-block;
            margin-bottom: 1rem;
            font-size: 0.875rem;
        }

        .subheading {
            font-size: 1.25rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }

        .main-heading {
            font-size: 3rem;
            font-weight: bold;
            margin-bottom: 2rem;
            color: #333;
            line-height: 1.2;
        }

        .text-gradient {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .button-group {
            margin-top: 1.5rem;
        }

        .button-group a {
            text-decoration: none;
            font-size: 1rem;
            font-weight: bold;
            padding: 0.75rem 1.5rem;
            border-radius: 0.25rem;
            display: inline-block;
            margin-right: 1rem;
            margin-bottom: 1rem;
        }

        .button-group .btn-primary {
            background-color: #2575fc;
            color: #fff;
            border: none;
        }

        .button-group .btn-outline {
            background-color: transparent;
            color: #333;
            border: 2px solid #333;
        }

        .header-image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            padding: 1rem;
        }

        .profile-wrapper {
            position: relative;
            display: inline-block;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            padding: 1rem;
            border-radius: 2rem;
            /* Rounded rectangle */
            overflow: hidden;
            width: 100%;
            max-width: 350px;
            /* Adjusted for a wider background */
            /* height: 450px; Adjusted for a taller background */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-img {
            width: 100%;
            max-width: 300px;
            border-radius: 0.5rem;
            position: relative;
            top: -15px;
            /* Slightly less offset to ensure the head is in proper shape */
            z-index: 1;
        }

        .profile-wrapper::before {
            content: '';
            position: absolute;
            top: -15px;
            /* Adjusted to match the new image positioning */
            left: 0;
            right: 0;
            height: 50px;
            background-color: #ffffff;
            z-index: 0;
            border-top-left-radius: 2rem;
            border-top-right-radius: 2rem;
        }

        .about-section {
            background-color: #f8f9fa;
            padding: 5rem 0;
            text-align: center;
        }

        .about-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .about-title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            color: #333;
        }

        .about-lead {
            font-size: 1.25rem;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        .about-description {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 2rem;
        }

        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
        }

        .social-link {
            font-size: 1.5rem;
            color: #6a11cb;
            text-decoration: none;
        }

        .footer-section {
            background-color: #fff;
            padding: 1rem 0;
            border-top: 1px solid #dee2e6;
            text-align: center;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .footer-left,
        .footer-right {
            font-size: 0.875rem;
            color: #6c757d;
        }

        .footer-link {
            color: #6a11cb;
            text-decoration: none;
            margin: 0 0.5rem;
        }

        .footer-link:hover {
            text-decoration: underline;
        }




        .about-title {
            color: #2575fc;
            /* Dark blue color for the title */
        }

        .about-lead {
            color: #43878d;
            /* Slightly lighter blue for the lead text */
        }

        .about-description {
            color: #7f8c8d;
            /* Grayish color for the description */
        }

        .social-link {
            color: #2980b9;
            /* Blue color for social links */
        }

        .social-link:hover {
            color: #1abc9c;
            /* Light green color on hover */
        }




        @media (max-width: 768px) {
            .header-container {
                flex-direction: column-reverse;
                text-align: center;
            }

            .header-text {
                padding: 1rem 0;
            }

            .profile-wrapper {
                margin-bottom: 2rem;
            }

            .main-heading {
                font-size: 2.5rem;
            }
        }
    </style>
    <main class="main-content">
        <!-- Header -->
        <header class="header-section">
            <div class="container header-container">
                <div class="header-text">
                    <!-- Header text content-->
                    <div class="text-content">
                        <div class="badge-custom">
                            Welcome
                            @auth
                               <span style="font-size: 20px; font-weight: bold;  color: #ffffff; padding: 5px 10px; margin-left: 10px;">
                                   {{ auth()->user()->name }}
                               </span>
                            @endauth
                        </div>



                        <div class="subheading">To Our Admin Panel</div>
                        <h1 class="main-heading">
                            <span class="text-gradient">Do it in easiest way!</span>
                        </h1>
                        {{-- <div class="button-group">
                            <a class="btn-primary" href="resume.html">Resume</a>
                            <a class="btn-outline" href="projects.html">Projects</a>
                        </div> --}}
                    </div>
                </div>
                <div class="header-image">
                    <!-- Header profile picture-->
                    <div class="profile-wrapper">
                        <img class="profile-img" src="{{ asset('pic/image_without_back.png') }}" alt="Profile Image" />
                    </div>
                </div>
            </div>
        </header>

        <!-- About Section -->
        <section class="about-section">
            <div class="container about-container">
                <div class="about-content">
                    <h2 class="about-title">About Me</h2>
                    <p class="about-lead">Plaban Das</p>
                    <p class="about-description">Kuet CSE 2K20</p>
                </div>
            </div>
        </section>
    </main>

    <script>
        // Custom JS if needed
        document.addEventListener("DOMContentLoaded", function() {
            // Add any interactive functionality here if needed
        });
    </script>
@endsection
