<?php $__env->startSection('styles'); ?>
    <style>

        html {
            scroll-behavior: smooth;
        }

        :root {
            --transition-speed: 0.3s;
        }

        .form-container {
            display: flex;
            min-height: 100vh;
        }

        .form-section {
            width: 50%;
            background-color: #000;
            padding: 2rem;
            display: flex;
            flex-direction: column;
        }

        .form-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            max-width: 28rem;
            width: 100%;
            margin: 0 auto;
        }

        h1 {
            color: white;
            font-size: 2.5rem;
            font-weight: 300;
            /*margin-bottom: 2.5rem;*/
        }



        label {
            display: block;
            /*color: white;*/
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }




        .feature-text{

            font-weight: 300;
        }

        .image-section {
            width: 50%;
            position: relative;
            background-image: url(<?php echo e(asset('cover.jpeg')); ?>);
            background-size: cover;
            background-position: center;
        }

        .image-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, #000000 0%, rgb(0 0 0) 15%, rgba(10, 15, 26, 0) 100%);
        }


        span{
            /*color: white;*/
        }


        .stepBtn {
            position: relative;
            background-color: transparent;
            color: white;
            border: 1px solid white;
            border-radius: 0.25rem;
            padding: 0;
            font-size: 1rem;
            cursor: pointer;
            overflow: hidden;
            margin: auto;
            margin-top: 3rem;
        }

        .stepBtn span {
            position: relative;
            display: block;
            padding: 0.75rem 2rem;
            z-index: 1;
            transition: color 0.3s ease;
        }

        .stepBtn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background-color: white;
            transition: transform 0.5s ease;
        }

        .stepBtn:hover::before {
            transform: translateX(100%);
        }

        .stepBtn:hover span {
            color: #0a0f1a;
        }


        .faq-container {
            width: 90%;
            max-width: 800px;
            margin: 2rem auto;
        }

        .faq-item {
            margin-bottom: 1rem;
            border-bottom: 1px solid rgb(128 119 119 / 10%);
        }

        .faq-toggle {
            display: none;
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 0;
            cursor: pointer;
            font-size: 1.3rem;
            font-weight: 700;
            transition: color var(--transition-speed);
        }

        .faq-question:hover {
            color: rgba(47, 47, 47, 0.73);
        }

        .arrow-icon {
            width: 24px;
            height: 24px;
            transition: transform 0.3s ease;
        }

        .faq-item.active .arrow-icon {
            transform: rotate(180deg);
        }

        /* Rotate arrow when FAQ is open */
        .faq-toggle:checked + .faq-question .arrow::before {
            transform: rotate(-135deg);
            top: 8px;
        }
        .arrow {
            width: 20px;
            height: 20px;
            position: relative;
            transition: transform var(--transition-speed);
        }

        .arrow::before {
            content: '';
            position: absolute;
            width: 8px;
            height: 8px;
            border-right: 2px solid white;
            border-bottom: 2px solid white;
            transform: rotate(45deg);
            top: 2px;
            left: 6px;
            transition: transform var(--transition-speed);
        }


        .arrow::before {
            left: 50%;
            transform: rotate(45deg);
        }

        .arrow::after {
            right: 50%;
            transform: rotate(-45deg);
        }

        .faq-answer {
            color: black;;
            max-height: 0;
            overflow: hidden;
            transition: max-height var(--transition-speed), padding var(--transition-speed);
            padding: 0 1rem;
            margin: 0;
            font-size: 1rem;
            opacity: 0;
            transform: translateY(-10px);
            transition: all var(--transition-speed);
            font-weight: 100;
        }

        .faq-toggle:checked + .faq-question .arrow::before {
            transform: rotate(-45deg);
        }

        .faq-toggle:checked + .faq-question .arrow::after {
            transform: rotate(45deg);
        }

        .faq-toggle:checked ~ .faq-answer {
            max-height: 500px;
            padding: 1rem;
            opacity: 1;
            transform: translateY(0);
        }

        .navbar-top.navbar-dark::before {
            background-color: transparent;
        }
        /* Responsive Design */
        @media (max-width: 768px) {

            .form-section {
                width: 100%;
                min-height: 100vh;
                padding: 1.5rem;
                background-image: url(<?php echo e(asset('fading.gif')); ?>);

            }

            /*.form-section::before {*/
                /*content: '';*/
                /*position: absolute;*/
                /*top: 0;*/
                /*left: 0;*/
                /*width: 100%;*/
                /*height: 100%;*/
                /*background: linear-gradient(to top, #000000 0%, rgb(0 0 0 / 85%) 70%, rgba(10, 15, 26, 0) 23%)*/
            /*}*/



            .image-section {
                display: none;
            }

            h1 {
                font-size: 2rem;
                margin-bottom: 2rem;
            }

            h3{
                font-size: 2.5rem !important;
            }

            .form-content {
                padding: 1rem 0;
            }


            .faq-container {
                width: 95%;
                margin: 1rem auto;
            }

            .faq-question {
                font-size: 1rem;
            }


            .interactive-links .nav-link {

                font-size: 2rem;
            }

            .join-icon{
                display: none;
            }

            .feature-body p {

                font-size: 1.1em;
            }

        }

        @media (max-width: 480px) {
            .form-section {
                padding: 1rem;
            }


        }

    </style>

    <style>
        .hero {
            position: relative;
            height: 80vh;
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)),
            url(<?php echo e(asset('cover.jpg')); ?>);
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .gradient-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 50%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 1) 100%);
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            max-width: 800px;
            padding: 2rem;
            z-index: 1;
        }

        .center-logo {
            margin-bottom: 2rem;
            animation: fadeInDown 1s ease-out;
        }

        h1 {
            font-size: 4rem;
            font-weight: 300;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease-out 0.3s both;
        }

        .subtitle {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            opacity: 0.9;
            animation: fadeInUp 1s ease-out 0.6s both;
        }

        .cta-button {
            display: inline-block;
            padding: 1rem 3rem;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            transition: all var(--transition-speed);
            animation: fadeInUp 1s ease-out 0.9s both;
        }

        .cta-button:hover {
            background-color: white;
            color: black;
            transform: translateY(-2px);
        }

        .info-section {
            padding: 6rem 2rem;
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        h2 {
            font-size: 2.5rem;
            font-weight: 300;
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeInUp 1s ease-out forwards;
            animation-play-state: paused;
        }

        .info-text {
            font-size: 1.2rem;
            opacity: 0;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 1s ease-out 0.3s forwards;
            animation-play-state: paused;
        }

        .info-section.visible h2,
        .info-section.visible .info-text {
            animation-play-state: running;
        }

        em {
            font-style: normal;
            text-decoration: underline;
        }

        @keyframes  fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes  fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            .subtitle {
                font-size: 1.1rem;
            }

            h2 {
                font-size: 2rem;
            }

            .info-text {
                font-size: 1rem;
            }
        }

    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <main class="hero">
        <div class="gradient-overlay"></div>
        <div class="hero-content">
            <h1>Tab4Six</h1>
            <p class="subtitle text-white">Dinners for Young Adults (20s-30s) to Connect Over Hobbies</p>
            <a href="<?php echo e(route('start')); ?>" class="cta-button">Sign up</a>
        </div>

    </main>

    <div class="pb-160" style="background: #000">
        <div class="container">
            <h3 class="display-5 pt-20 mb-60 pb-30 text-center text-white">How it works</h3>
            <div class="row gh-1 gv-3 text-white">
                <div class="col-md-4 col-lg-4 show-on-scroll" data-show-duration="500" data-show-distance="20" data-show-delay="50">
                    <div class="text-center">
                        <div class="feature-body">
                            <h4 class="feature-title text-white">1- Share about you</h4>
                            <p class="feature-text">Answer personality questions to help with group placement.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 show-on-scroll" data-show-duration="500" data-show-distance="20" data-show-delay="150">
                    <div class="text-center">
                        <div class="feature-body">
                            <h4 class="feature-title text-white">2- Group creation</h4>
                            <p class="feature-text">Be placed in groups of 4-6 people and receive info about the attendees.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 show-on-scroll" data-show-duration="500" data-show-distance="20" data-show-delay="250">
                    <div class="text-center">
                        <div class="feature-body">
                            <h4 class="feature-title text-white">3- Dinner</h4>
                            <p class="feature-text">Grab dinner at an assigned time and restaurant.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="py-130  overflow-hidden shape-parent" >
        <h3 class="display-5 mb-60 pb-30 text-center ">What to expect</h3>
        <div class="container">
            <div class="row gh-1 gv-xs mt-n30">
                <div class="col-12 col-md-6 col-lg-4 show-on-scroll" data-show-duration="650" data-show-distance="20" data-show-delay="50">
                    <div class="row gh-xs mt-25">
                        <div class="col text-center">
                            <h4 class=" mb-5  font-weight-bolder">What It's About</h4>
                            <span style="font-weight: 300" class="font-size-16 text-dark">We host dinners for 21-35 year olds to meet 5 new friends every week.</span>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-4 show-on-scroll" data-show-duration="650" data-show-distance="20" data-show-delay="150">
                    <div class="row gh-xs mt-25">
                        <div class="col text-center">
                            <h4 class=" mb-5  font-weight-bolder">Your First Dinner</h4>
                            <span style="font-weight: 300" class="font-size-16 text-dark ">It's a casual hangout to enjoy food and connect over shared hobbies.</span>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-6 col-lg-4  show-on-scroll" data-show-duration="650" data-show-distance="20" data-show-delay="250">
                    <div class="row gh-xs mt-25">
                        <div class="col text-center">
                            <h4 class=" mb-5  font-weight-bolder">After the Dinner</h4>
                            <span style="font-weight: 300" class="font-size-16  text-dark ">Tell us who you'd like to see again, and we'll connect mutual matches.</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-container">
        <div class="form-section">
            <div class="form-content">
                <h3 class="display-5" style="font-weight: 500; color: white!important;z-index: 1">Why Tab4Six?</h3>

                <div class="text-white">
                    <p class="mb-12 show-on-scroll show-on-scroll-ready" data-show-duration="500" data-show-distance="10" data-show-delay="150" style="transform: translateY(0px); transition-duration: 500ms; opacity: 1;"><b>• Engineered for chemistry:</b> We create each group, considering not just commonalities but also complementary differences that spark engaging conversations and lasting bonds.</p>
                    <p class="mb-12 show-on-scroll show-on-scroll-ready" data-show-duration="500" data-show-distance="10" data-show-delay="150" style="transform: translateY(0px); transition-duration: 500ms; opacity: 1;"><b>• Meet your close friends:</b> This initiative is about creating a space where you can meet your close friends, forming friendships that go beyond surface-level interactions.</p>
                    <p class="mb-12 show-on-scroll show-on-scroll-ready" data-show-duration="500" data-show-distance="10" data-show-delay="150" style="transform: translateY(0px); transition-duration: 500ms; opacity: 1;"><b>• Let's end loneliness:</b> Tab4Six is not just about dinners; it's a movement to combat global loneliness. We bring people together to create meaningful relationships that inspire, energize, and transform lives. This is your chance to be part of something bigger, building a world where no one feels alone..</p>
                </div>
            </div>
        </div>
        <div class="image-section" style=" background-image: url(<?php echo e(asset('fading.jpeg')); ?>)"></div>
    </div>

    <div id="faqSection" class="py-130  overflow-hidden  shape-parent p-20">
        <h3 class="display-5 mb-60 pb-30 text-center ">FAQ</h3>
        <div class="faq-container">
            <div class="faq-item">
                <input type="checkbox" id="faq1" class="faq-toggle">
                <label for="faq1" class="faq-question">
                    Is Tab4Six a dating service?
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                </label>
                <div class="faq-answer">
                    <p>No, we prioritize building authentic friendships. While romantic connections may happen naturally, our main goal is to create an environment for strong, lasting friendships.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq2" class="faq-toggle">
                <label for="faq2" class="faq-question">
                    Who should I expect to see at the dinners?
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </label>
                <div class="faq-answer">
                    <p>Tab4Six is a welcoming community where everyone, regardless of their background, can feel included and valued. Our mission is to foster connections and combat the global loneliness epidemic.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq3" class="faq-toggle">
                <label for="faq3" class="faq-question">
                    What if I don't "click" with anyone at my dinner?
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </label>
                <div class="faq-answer">
                    <p>We carefully curate each group for compatibility, but instant friendships aren't guaranteed. Approach each dinner with an open mind – even without a perfect match, you'll likely enjoy a good meal and interesting conversation. Your feedback helps us improve our curation for future dinners.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq4" class="faq-toggle">
                <label for="faq4" class="faq-question">
                    How much would this service cost?
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </label>
                <div class="faq-answer">
                    <p>The signup fee is currently $16. This fee is covered by the attendees.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq5" class="faq-toggle">
                <label for="faq5" class="faq-question">
                    How long do the dinners typically last?
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </label>
                <div class="faq-answer">
                    <p>The dinners usually last between 1hr to 2hrs.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq6" class="faq-toggle">
                <label for="faq6" class="faq-question">
                    What will I know before the dinner?
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </label>
                <div class="faq-answer">
                    <p>You'll receive the restaurant location a day before the dinner, along with the niches (e.g., tech, art) of each attendee.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq7" class="faq-toggle">
                <label for="faq7" class="faq-question">
                    How are the dinner groups curated?
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </label>
                <div class="faq-answer">
                    <p>After receiving your application, we carefully curate each group, aiming to optimize group chemistry. This is a unique blend of shared interests, complementary personalities, and diverse perspectives designed to spark engaging conversations and lasting friendships.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq8" class="faq-toggle">
                <label for="faq8" class="faq-question">
                    What happens after the dinner?
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </label>
                <div class="faq-answer">
                    <p>After the event, we'll send a survey to gather your feedback so you can let us know who you'd like to connect with further. If there's mutual interest, we'll facilitate the connection.</p>
                </div>
            </div>

            <div class="faq-item">
                <input type="checkbox" id="faq9" class="faq-toggle">
                <label for="faq9" class="faq-question">
                    What are the perks and expectations of being a Tab4Six Ambassador?
                    <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7 10L12 15L17 10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </label>
                <div class="faq-answer">
                    <p>As a Tab4Six Ambassador, you'll get free weekly dinner tickets and discounted ticket to share with two close friends. You'll also have a chance to shape the strategy, give feedback on app features, and influence how Tab4Six grows.
                        We just ask that you show up to at least one dinner per month and share your honest thoughts on how we can improve. It's a laid-back, collaborative way to help make Tab4Six even better.
                        Sounds like fun? Shoot us an email at info@tab4six.com with a little about yourself (your background, leadership experience, availability, and why you're interested).
                        We'd love to hear from you!</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center text-md-start d-none" style="background:black">
        <div class="container">
            <div class="row gv-1 align-items-center justify-content-center justify-content-md-between">
                <div class="col-md-10 me-md-auto">
                    <div class="interactive-links">
                        <a href="https://forms.gle/7A5uBhZeexdj783o9" class="nav-link display-1 text-white"><u>Join Our Team</u></a>
                    </div>
                </div>
                <div class="col-auto join-icon">
                    <a href="#" class="btn btn-clean me-xl-100 text-white">
                        <svg class="icon-arrow icon-arrow-right" width="69" height="30" viewBox="0 0 69 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M54 2L67 15L54 28" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M17 15L67 15" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer text-white shape-parent overflow-hidden text-center pt-10 pb-60" style="background-color: #000">
        <div class="container pt-40">
            <ul class="nav nav-social nav-gap-sm align-items-center justify-content-center mb-30 text-white">

                <li class="nav-item">
                    <a style="padding: 7px 26px;font-size: 15px" class="theme-button d-sm-inline-block" href="<?php echo e(route('start')); ?>"> Sign up </a>

                </li>
            </ul>
            <ul class="nav nav-social nav-gap-sm align-items-center justify-content-center mb-30 text-white">
                <li class="nav-item">
                    <a href="https://instagram.com/tab4six" class="nav-link">
                        <svg width="15" height="15" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.2827 5.3166C8.24087 5.3166 5.78732 7.8148 5.78732 10.912C5.78732 14.0092 8.24087 16.5074 11.2827 16.5074C14.3245 16.5074 16.7781 14.0092 16.7781 10.912C16.7781 7.8148 14.3245 5.3166 11.2827 5.3166ZM11.2827 14.5497C9.31698 14.5497 7.70998 12.9183 7.70998 10.912C7.70998 8.90563 9.3122 7.27425 11.2827 7.27425C13.2532 7.27425 14.8554 8.90563 14.8554 10.912C14.8554 12.9183 13.2484 14.5497 11.2827 14.5497ZM18.2846 5.08772C18.2846 5.81331 17.7107 6.39282 17.0029 6.39282C16.2902 6.39282 15.7211 5.80844 15.7211 5.08772C15.7211 4.36699 16.295 3.78261 17.0029 3.78261C17.7107 3.78261 18.2846 4.36699 18.2846 5.08772ZM21.9243 6.4123C21.843 4.66404 21.4508 3.11545 20.1929 1.83956C18.9399 0.563678 17.419 0.164355 15.7019 0.0766992C13.9323 -0.0255664 8.62827 -0.0255664 6.85865 0.0766992C5.14643 0.159486 3.62552 0.558809 2.36766 1.83469C1.10979 3.11058 0.722392 4.65917 0.636302 6.40743C0.535865 8.20925 0.535865 13.6098 0.636302 15.4117C0.717609 17.1599 1.10979 18.7085 2.36766 19.9844C3.62552 21.2603 5.14165 21.6596 6.85865 21.7473C8.62827 21.8495 13.9323 21.8495 15.7019 21.7473C17.419 21.6645 18.9399 21.2652 20.1929 19.9844C21.446 18.7085 21.8382 17.1599 21.9243 15.4117C22.0247 13.6098 22.0247 8.21412 21.9243 6.4123ZM19.6381 17.345C19.2651 18.2995 18.5429 19.0348 17.6007 19.4195C16.1898 19.9893 12.8419 19.8578 11.2827 19.8578C9.72352 19.8578 6.37081 19.9844 4.96469 19.4195C4.02727 19.0397 3.30507 18.3043 2.92724 17.345C2.36766 15.9084 2.49679 12.4995 2.49679 10.912C2.49679 9.32443 2.37244 5.91071 2.92724 4.47899C3.30029 3.52451 4.02248 2.78917 4.96469 2.40446C6.37559 1.83469 9.72352 1.96618 11.2827 1.96618C12.8419 1.96618 16.1946 1.83956 17.6007 2.40446C18.5381 2.7843 19.2603 3.51964 19.6381 4.47899C20.1977 5.91558 20.0686 9.32443 20.0686 10.912C20.0686 12.4995 20.1977 15.9133 19.6381 17.345Z" fill="currentColor"></path>
                        </svg>
                    </a>
                </li>
            </ul>
            <div class="footer-copyright mb-5">Copyright © <?php echo date('Y');?>  Tab4Six - All Rights Reserved.</div>
        </div>
    </footer>

<?php $__env->stopSection(); ?>



<?php $__env->startSection('scripts'); ?>

    <script>
        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', () => {
                const faqItem = question.parentElement;
                const isActive = faqItem.classList.contains('active');

                // Close all FAQ items
                document.querySelectorAll('.faq-item').forEach(item => {
                    item.classList.remove('active');
                });

                // If the clicked item wasn't active, open it
                if (!isActive) {
                    faqItem.classList.add('active');
                }
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.web.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Laravel pros\hingeApp\resources\views/web/index.blade.php ENDPATH**/ ?>