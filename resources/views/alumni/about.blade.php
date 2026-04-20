@extends('layouts.alumni')

@section('title', 'About MPSU - MPSU Alumni Network')

@section('content')
<!-- About MPSU Section -->
<section id="about" style="background: white; padding: 4rem 0; scroll-margin-top: 100px;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 900; color: var(--primary-color); margin-bottom: 1rem; text-align: center;">About Mountain Province State University</h2>
        <p style="color: var(--text-secondary); font-size: 1.1rem; text-align: center; margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">Excellence in Education Since 1969</p>
        
        <div style="padding: 2rem; background: linear-gradient(135deg, rgba(13, 77, 45, 0.05) 0%, rgba(26, 107, 61, 0.05) 100%); border-radius: 16px; border-left: 4px solid var(--accent-gold); margin-bottom: 2rem;">
            <h3 style="color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem;">
                <i class="fas fa-university"></i> Our Mission
            </h3>
            <p style="color: var(--text-secondary); margin-bottom: 1rem; line-height: 1.8;">
                Mountain Province State University (MPSU) is committed to providing accessible, relevant, and quality higher education through instruction, research, extension, and production services. We aim to transform quality of life and serve as a unique highland university, culturally and innovatively centric, globally recognized.
            </p>
        </div>

        <div class="row align-items-stretch mb-4">
            <div class="col-lg-6 mb-4">
                <div style="padding: 2rem; background: white; border-radius: 16px; box-shadow: var(--shadow-md); border-top: 4px solid var(--primary-color); height: 100%;">
                    <h3 style="color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem;">
                        <i class="fas fa-eye"></i> Vision
                    </h3>
                    <p style="color: var(--text-secondary); line-height: 1.8; font-size: 1.05rem;">
                        A unique highland university, culturally and innovatively centric, globally recognized that transforms quality of life.
                    </p>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div style="padding: 2rem; background: white; border-radius: 16px; box-shadow: var(--shadow-md); border-top: 4px solid var(--secondary-color); height: 100%;">
                    <h3 style="color: var(--primary-color); font-weight: 700; margin-bottom: 1.5rem;">
                        <i class="fas fa-bullseye"></i> Mission
                    </h3>
                    <p style="color: var(--text-secondary); line-height: 1.8; font-size: 1.05rem;">
                        A pioneering university embracing a leadership role in shaping human capital, culturally rooted and innovatively directed.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" style="background: var(--bg-light); padding: 4rem 0; scroll-margin-top: 100px;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 900; color: var(--primary-color); margin-bottom: 1rem; text-align: center;">Alumni Network Features</h2>
        <p style="color: var(--text-secondary); font-size: 1.1rem; text-align: center; margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">Explore what our platform offers to connect you with opportunities</p>
        
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div style="background: white; border-radius: 16px; padding: 2.5rem 2rem; text-align: center; box-shadow: var(--shadow-md); transition: all 0.3s ease; border: 1px solid transparent; height: 100%;">
                    <div style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 1.5rem;">
                        <i class="fas fa-address-book"></i>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">Alumni Directory</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">Search and connect with thousands of MPSU graduates across different batches and courses.</p>
                    <a href="{{ route('alumni.alumni-dir') }}" style="display: inline-block; background: var(--accent-gold); color: var(--primary-color); padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">Browse Directory</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div style="background: white; border-radius: 16px; padding: 2.5rem 2rem; text-align: center; box-shadow: var(--shadow-md); transition: all 0.3s ease; border: 1px solid transparent; height: 100%;">
                    <div style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 1.5rem;">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">Job Opportunities</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">Browse exclusive career opportunities posted by employers and alumni-owned businesses.</p>
                    <a href="{{ route('jobs.index') }}" style="display: inline-block; background: var(--accent-gold); color: var(--primary-color); padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">View Jobs</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4">
                <div style="background: white; border-radius: 16px; padding: 2.5rem 2rem; text-align: center; box-shadow: var(--shadow-md); transition: all 0.3s ease; border: 1px solid transparent; height: 100%;">
                    <div style="font-size: 3rem; color: var(--accent-gold); margin-bottom: 1.5rem;">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3 style="font-size: 1.3rem; font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">Events & Reunions</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">Stay informed about alumni reunions, homecomings, and networking sessions.</p>
                    <a href="{{ route('events.index') }}" style="display: inline-block; background: var(--accent-gold); color: var(--primary-color); padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">View Events</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section id="how-it-works" style="background: white; padding: 4rem 0; scroll-margin-top: 100px;">
    <div class="container">
        <h2 style="font-size: 2.5rem; font-weight: 900; color: var(--primary-color); margin-bottom: 1rem; text-align: center;">How to Get Started</h2>
        <p style="color: var(--text-secondary); font-size: 1.1rem; text-align: center; margin-bottom: 3rem; max-width: 600px; margin-left: auto; margin-right: auto;">Your profile is already set up! Here's what you can do now</p>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div style="background: white; border-radius: 16px; padding: 2.5rem 2rem; text-align: center; box-shadow: var(--shadow-md); border-top: 4px solid var(--accent-gold); height: 100%;">
                    <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 1.5rem; font-weight: 900;">
                        1
                    </div>
                    <h3 style="font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">Complete Your Profile</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">Upload a profile picture and add your current employment information.</p>
                    <a href="{{ route('alumni.profile.edit') }}" style="display: inline-block; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">Update Profile</a>
                </div>
            </div>
            <div class="col-md-4">
                <div style="background: white; border-radius: 16px; padding: 2.5rem 2rem; text-align: center; box-shadow: var(--shadow-md); border-top: 4px solid var(--accent-gold); height: 100%;">
                    <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 1.5rem; font-weight: 900;">
                        2
                    </div>
                    <h3 style="font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">Connect with Alumni</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">Browse the alumni directory and connect with classmates and fellow graduates.</p>
                    <a href="{{ route('alumni.alumni-dir') }}" style="display: inline-block; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">Browse Directory</a>
                </div>
            </div>
            <div class="col-md-4">
                <div style="background: white; border-radius: 16px; padding: 2.5rem 2rem; text-align: center; box-shadow: var(--shadow-md); border-top: 4px solid var(--accent-gold); height: 100%;">
                    <div style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; font-size: 1.5rem; font-weight: 900;">
                        3
                    </div>
                    <h3 style="font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">Explore Opportunities</h3>
                    <p style="color: var(--text-secondary); margin-bottom: 1.5rem;">Apply for jobs, register for events, and stay updated with alumni news.</p>
                    <a href="{{ route('jobs.index') }}" style="display: inline-block; background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); color: white; padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease;">Explore</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Get in Touch Section -->
<section style="background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%); padding: 4rem 0; color: white;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2 style="font-size: 2.5rem; font-weight: 900; margin-bottom: 1rem; color: white;">Get in Touch with Us</h2>
                <p style="font-size: 1.1rem; opacity: 0.9; margin-bottom: 0;">Have questions or need assistance? We're here to help you connect with the MPSU Alumni Network.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="mailto:mpsu.alumni@gmail.com" style="display: inline-block; background: var(--accent-gold); color: var(--primary-color); padding: 1rem 2rem; border-radius: 8px; text-decoration: none; font-weight: 700; font-size: 1.1rem; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);">
                    <i class="fas fa-envelope"></i> Contact Us
                </a>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-4 mb-3">
                <div style="background: rgba(255, 255, 255, 0.1); padding: 2rem; border-radius: 12px; backdrop-filter: blur(10px);">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4 style="font-weight: 700; margin-bottom: 0.75rem; color: var(--accent-gold);">Email Us</h4>
                    <p style="opacity: 0.9; margin: 0;">mpsu.alumni@gmail.com</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div style="background: rgba(255, 255, 255, 0.1); padding: 2rem; border-radius: 12px; backdrop-filter: blur(10px);">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4 style="font-weight: 700; margin-bottom: 0.75rem; color: var(--accent-gold);">Visit Us</h4>
                    <p style="opacity: 0.9; margin: 0;">Bontoc, Mountain Province, Philippines</p>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div style="background: rgba(255, 255, 255, 0.1); padding: 2rem; border-radius: 12px; backdrop-filter: blur(10px);">
                    <div style="font-size: 2.5rem; margin-bottom: 1rem;">
                        <i class="fas fa-globe"></i>
                    </div>
                    <h4 style="font-weight: 700; margin-bottom: 0.75rem; color: var(--accent-gold);">Website</h4>
                    <p style="opacity: 0.9; margin: 0;">www.mpsu.edu.ph</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
