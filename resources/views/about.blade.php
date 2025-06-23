@extends('layouts.app') {{-- or use layout you have --}}

@section('content')

    <link rel="stylesheet" href="{{ asset('css/aboutus.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}
@include('navbar')
    <div class="about-container">
    <div>
        <h1><span class="about-title">About</span> <span class="highlight-text">Us</span></h1><br>
        <div class="car-slider-wrapper">
            <div class="car-slider">
                <img src="{{ asset('images/rentngo.png') }}" class="about-image">
                <p class="about-description">
                    At RentnGo Car Rentals, we believe that mobility should be simple, flexible, and affordable
                        for everyone. Whether you're a tourist exploring a new city, a business traveler in need of a
                        reliable vehicle, or a local resident requiring a temporary ride, our car rental service is
                        designed to meet your unique needs with convenience and confidence.
                        <br><br>
                        With a diverse fleet ranging from compact economy cars to spacious SUVs and sedans,
                        DriveEasy offers the right vehicle for every occasion. All our cars are well-maintained,
                        insured, and equipped with the latest features to ensure your safety and comfort on the road. We
                        continuously update our inventory to provide modern, fuel-efficient, and environmentally
                        conscious options to our clients.
                        <br><br>
                        Our booking process is quick and hassle-free — reserve your car online in just a few clicks,
                        pick it up at your chosen location, and hit the road. We offer flexible rental periods, from a
                        few hours to long-term leases, as well as one-way rentals for added convenience. Our competitive
                        pricing, transparent policies, and zero hidden charges make us a trusted choice for customers
                        who value fairness and reliability.
                        <br><br>
                        What sets us apart is our customer-first approach. Our friendly support team is available 24/7
                        to assist with reservations, road assistance, and any other inquiries. We also provide optional
                        add-ons like GPS navigation systems, child safety seats, and additional driver coverage to
                        enhance your experience.
                </p>
            </div>
        </div>
    </div>
</div>


    <br><br>

    <!--LIST CAR-->

    <p1 class="text-blue" style="padding: 30px; color: #0f3175; font-weight:bold">LATEST UPDATE</p1><br>

   <div class="car-slider-wrapper">
    <!-- Left Arrow -->
    <button class="slider-arrow left" onclick="scrollSlider(-1)">
        <i class="bi bi-chevron-left"></i>
    </button>

    <!-- Slider -->
    <div class="car-slider" id="promoSlider">
        <!-- Promo Card 1 -->
        <div class="promo-card">
            <div class="promo-img-wrapper">
                <img src="{{ asset('images/poster2.png') }}" class="promo-img">
            </div>
            <h1 class="promo-title">30% PROMOTION</h1>
            <h3 class="promo-subtitle">Valid Until : 22/8/2025</h3>
            <div class="promo-dates" id="selectedDates1"></div>
        </div>

        <!-- Promo Card 2 -->
        <div class="promo-card">
            <div class="promo-img-wrapper">
                <img src="{{ asset('images/poster3.png') }}" class="promo-img">
            </div>
            <h1 class="promo-title">70% PROMOTION</h1>
            <h3 class="promo-subtitle">Valid Until : 1/12/2025</h3>
            <div class="promo-dates" id="selectedDates2"></div>
        </div>

        <!-- Promo Card 3 -->
        <div class="promo-card">
            <div class="promo-img-wrapper">
                <img src="{{ asset('images/poster4.png') }}" class="promo-img">
            </div>
            <h1 class="promo-title">30% MERDEKA PROMOTION</h1>
            <h3 class="promo-subtitle">Valid Until : 31/8/2025</h3>
            <div class="promo-dates" id="selectedDates3"></div>
        </div>

        <!-- Promo Card 4 -->
        <div class="promo-card">
            <div class="promo-img-wrapper">
                <img src="{{ asset('images/poster6.png') }}" class="promo-img">
            </div>
            <h1 class="promo-title">OFFER PROMOTION TODAY, RENT THE CAR NOW!</h1>
            <h3 class="promo-subtitle">Valid Until : 31/9/2025</h3>
            <div class="promo-dates" id="selectedDates4"></div>
        </div>

        <!-- Promo Card 5 -->
        <div class="promo-card">
            <div class="promo-img-wrapper">
                <img src="{{ asset('images/poster9.png') }}" class="promo-img">
            </div>
            <h1 class="promo-title">50% PROMOTION</h1>
            <h3 class="promo-subtitle">Valid Until : 1/11/2025</h3>
            <div class="promo-dates" id="selectedDates5"></div>
        </div>
    </div>

    <!-- Right Arrow -->
    <button class="slider-arrow right" onclick="scrollSlider(1)">
        <i class="bi bi-chevron-right"></i>
    </button>
</div>


    <br><br>
    <!--TEAM-->
    <div class="max-w-8xl mx-auto mt-5 bg-white rounded-1xl shadow-lg text-center">
        <div>
            <h1 style="font-size: 30px; font-weight:bold; color:#0f3175">Our <span style="color:#facc15">Team</span>
            </h1><br>
            <div class="team section-bg">
                <div class="container" data-aos="fade-up" style="margin: 80px">

                    <div class="row">
                        <div class="d-flex flex-row justify-content-center flex-wrap gap-1">
                            <div
                                style="display: flex; justify-content: center; flex-wrap: wrap; gap: 1px; padding: 1px; margin:10px">
                                
                                <div class="member"
                                    style="background: white; padding: 10px; width: 250px; text-align: center;">
                                    <div class="member-img">
                                        <img style="width: 100%;height: 306px" src="{{ asset('images/hafiy.png') }}" class="img-fluid" alt="">
                                        <div class="social">
                                            <a href="https://www.instagram.com/hfy_azfr?igsh=YmZzZHd4NnhucnBt&utm_source=qr"><i class="bi bi-facebook"></i></a>
                                            <a href="https://www.instagram.com/hfy_azfr?igsh=YmZzZHd4NnhucnBt&utm_source=qr"><i class="bi bi-instagram"></i></a>
                                            <a href="https://www.linkedin.com/in/hafiy-azfar-4311982b5?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app"><i class="bi bi-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <h4>Hafiy</h4>
                                        <span>Programmer</span>
                                    </div>
                                </div>

                                <div class="member"
                                    style="background: white; padding: 10px; width: 250px; text-align: center;">
                                    <div class="member-img">
                                        <img style="width: 100%;height: 306px;" src="{{ asset('images/danial.png') }}" class="img-fluid"
                                            alt="">
                                        <div class="social">
                                            <a href="https://www.facebook.com/danial.asyraaf.351"><i
                                                    class="bi bi-facebook"></i></a>
                                            <a href="https://www.instagram.com/danialhamzani/"><i
                                                    class="bi bi-instagram"></i></a>
                                            <a href="https://www.linkedin.com/in/danial-asyraaf-a2413a355/"><i
                                                    class="bi bi-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <h4>Danial</h4>
                                        <span>Programmer</span>
                                    </div>
                                </div>

                                <div class="member"
                                    style="background: white; padding: 10px; width: 250px; text-align: center;">
                                    <div class="member-img">
                                        <img style="width: 100%;height: 306px" src="{{ asset('images/ijad.jpg') }}" class="img-fluid" alt="">
                                        <div class="social">
                                            <a href="https://www.facebook.com/share/1UmQf7BgAm/?mibextid=wwXIfr"><i class="bi bi-facebook"></i></a>
                                            <a href="https://www.instagram.com/_haizadddd?igsh=NjJkMXppbTJkMWlq&utm_source=qr"><i class="bi bi-instagram"></i></a>
                                            <a href="https://www.linkedin.com/in/muhammad-haizad?utm_source=share&utm_campaign=share_via&utm_content=profile&utm_medium=ios_app"><i class="bi bi-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <h4>Haizad</h4>
                                        <span>Chief Executive Officer</span>
                                    </div>
                                </div>


                                <div class="member"
                                    style="background: white; padding: 10px; width: 250px; text-align: center;">
                                    <div class="member-img">
                                        <img style="width: 100%;height:306px;" src="{{ asset('images/yasmin.jpg') }}" class="img-fluid" alt="">
                                        <div class="social">
                                            <a href="https://www.instagram.com/ysmn_ayn?igsh=MXBlZXlxZXRtM3Axdw%3D%3D&utm_source=qr"><i class="bi bi-facebook"></i></a>
                                            <a href="https://www.instagram.com/ysmn_ayn?igsh=MXBlZXlxZXRtM3Axdw%3D%3D&utm_source=qr"><i class="bi bi-instagram"></i></a>
                                            <a href="https://my.linkedin.com/in/yasmin-ayuni-5955a433b"><i class="bi bi-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <h4>Yasmin</h4>
                                        <span>Programmer</span>
                                    </div>
                                </div>

                                <div class="member"
                                    style="background: white; padding: 10px; width: 250px; text-align: center;">
                                    <div class="member-img">
                                        <img style="width: 100%;height:306px;" src="{{ asset('images/sabrina.png') }}" class="img-fluid" alt="">
                                        <div class="social">
                                            <a href=""><i class="bi bi-facebook"></i></a>
                                            <a href=""><i class="bi bi-instagram"></i></a>
                                            <a href=""><i class="bi bi-linkedin"></i></a>
                                        </div>
                                    </div>
                                    <div class="member-info">
                                        <h4>Sabrina</h4>
                                        <span>Programmer</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </section>
            </div>
        </div>
    </div>


    <!-- CONTACT -->
    <div class="contact-container">
        <h1 class="contact-title">
            Contact <span class="highlight-text">Us</span>
        </h1><br>

        <div class="contact-content">
            <div class="contact-box">
                <h2>HOURS OF OPERATION</h2>
                <p>9:00 to 17:00, Mon–Fri<br>(Excluding Holidays)</p>
            </div>

            <div class="contact-box">
                <h2>PHONE</h2>
                <p>+60 13 456 7890</p>
            </div>

            <div class="contact-box">
                <h2>GENERAL INQUIRIES</h2>
                <p>RentnGo@gmail.com</p>
            </div>
        </div>

        <br><br>

        <div class="contact-info-note">
            <p class="note-title">Our customer service team is waiting to assist you</p>
            <p class="note-sub">Please allow up to 2–Business days response time in order for us to fully address your inquiries.</p>
            <p class="note-sub">You can also check your <a href="#" class="order-link">order status</a> through our website.</p>
        </div>
    </div>



    <!-- LOCATION -->
    <div class="location-container">
        <div>
            <h1 class="location-title">
                Our <span class="highlight-text">Location</span>
            </h1><br>

            <div class="map-container">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.2703138539475!2d101.7030556!3d2.999541!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cdca7f18a908b7%3A0xe28aef92d5f28bf4!2sUniversiti%20Putra%20Malaysia!5e0!3m2!1sen!2smy!4v1700000000000!5m2!1sen!2smy"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>




    <!--FOOTER-->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-brand">
                <h2 style="color: #facc15">Rent<span style="color: #ffffff">n</span>Go</h2>
                <p>Your trusted car rental partner in Malaysia.</p>
            </div>

            <div class="footer-links">
                <div>
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4>Support</h4>
                    <ul>
                        <li><a href="#">Contact</a></li>   
                    </ul>
                </div>
                <div>
                    <h4>Follow Us</h4>
                    <ul>
                        <li><a href="#">Facebook</a></li>
                        <li><a href="#">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 RentnGo. All rights reserved.</p>
        </div>
    </footer>



    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/rangePlugin.js"></script>
    <script>
        flatpickr("#dateRangeInput", {
            mode: "range",
            dateFormat: "d M Y",
            minDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                if (selectedDates.length === 2) {
                    document.getElementById('selectedDates').innerText =
                        `Start: ${selectedDates[0].toDateString()} | End: ${selectedDates[1].toDateString()}`;
                }
            }
        });

        function submitDates() {
            alert("Dates Confirmed!");
        }

        function openModal() {
            document.getElementById("carModal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("carModal").style.display = "none";
        }

        // Optional: close when clicking outside the modal
        window.onclick = function(event) {
            const modal = document.getElementById("carModal");
            if (event.target === modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection
